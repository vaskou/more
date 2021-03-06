<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if($mode=='manage'){
	
//	$auth = & $_SESSION['auth'];
	$child_shop_status=fn_mcs_get_child_sync_status_from_parent();
	$addons=Registry::get('addons');
	
//	if($auth['is_root']=='Y' && $child_shop_status == 'A'){
	if($addons['mcs_child_shop']['mcs_general_child_secret_key']==$_REQUEST['secret_key'] && $child_shop_status == 'A'){
		if (!empty($_REQUEST['product_id'])){
			$pid = $_REQUEST['product_id'];
			if($pid=='new'){
				$sync_result=fn_mcs_sync_all_products();
				if(!empty($sync_result['return_msg'])){
					fn_set_notification($sync_result['msg_type'], __('notice'), $sync_result['return_msg']);
				}
				if(!empty($sync_result['sync_result'])){
					Registry::get('view')->assign('mcs_sync_result',$sync_result['sync_result']);
				}
			}
			if($pid=='all'){
				$sync_categ = (!empty($_REQUEST['mcs_sync_categ']) ? $_REQUEST['mcs_sync_categ'] : false);
				$sync_products_enabled = (!empty($_REQUEST['mcs_sync_products_enabled']) ? $_REQUEST['mcs_sync_products_enabled'] : false);
				$sync_result=fn_mcs_sync_all_products(true,$sync_categ,$sync_products_enabled);
				if(!empty($sync_result['return_msg'])){
					fn_set_notification($sync_result['msg_type'], __('notice'), $sync_result['return_msg']);
				}
				if(!empty($sync_result['sync_result'])){
					Registry::get('view')->assign('mcs_sync_result',$sync_result['sync_result']);
				}
			}
		}
	}
	
	$last_sync_timestamp=fn_mcs_get_timestamp_of_sync();
	Registry::get('view')->assign('mcs_timestamp',$last_sync_timestamp);
	Registry::get('view')->assign('mcs_child_shop_status',$child_shop_status);
}

if($mode=='error_log'){
	
	if (!empty($_REQUEST['clear'])){
		if($_REQUEST['clear']==true){
			$result=fn_mcs_clear_log();
			if($result['status']==true){
				fn_set_notification('N', __('notice'), $result['message']);
				return true;
			}
		}
	}
	
	$error_log=fn_mcs_read_log();
	if(!empty($error_log['return_msg'])){
		fn_set_notification($error_log['msg_type'], __('notice'), $error_log['return_msg']);
	}else{
		Registry::get('view')->assign('mcs_error_log',$error_log);
	}
	
}

if ($mode == 'product') {

	if (!empty($_REQUEST['product_id'])) {
        $pid = $_REQUEST['product_id'];
		if($pid=='all'){
			$pdata=fn_mcs_sync_all_products(true,true);
			/*if(!empty($pdata['return_msg'])){
				fn_set_notification($pdata['msg_type'], __('notice'), $pdata['return_msg']);
			}*/
		}else{
			$pdata = fn_mcs_sync_product($pid);
			if(!empty($pdata['return_msg'])){
				fn_set_notification($pdata['msg_type'], __('notice'), $pdata['return_msg']);
			}
		}

        //return array(CONTROLLER_STATUS_REDIRECT, "products.update?product_id=$pid");
		//print_r($pdata);
    }
}

if($mode=='test'){	
			
}