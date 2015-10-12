<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if($mode=='manage'){
	
	$auth = & $_SESSION['auth'];
	$child_shop_status=fn_mcs_get_child_sync_status_from_parent();

	if($auth['is_root']=='Y' && $child_shop_status == 'A'){
		if (!empty($_REQUEST['sync_mode'])){
			$sync_mode = $_REQUEST['sync_mode'];
			if($sync_mode=='check'){
				$sync_result=fn_mcs_get_products_to_sync();
				if(!empty($sync_result['return_msg'])){
					fn_set_notification($sync_result['msg_type'], __('notice'), $sync_result['return_msg']);
				}
				list($products_to_sync,$products_to_sync_ids)=$sync_result;
				$products_to_sync_ids=json_encode($products_to_sync_ids);
				Registry::get('view')->assign('mcs_products_to_sync',$products_to_sync);
				Registry::get('view')->assign('mcs_products_to_sync_ids',$products_to_sync_ids);
			}elseif($sync_mode=='new'){
				$pids = (!empty($_REQUEST['product_ids'])) ? $_REQUEST['product_ids'] : array();
				if(!empty($pids)){
					$sync_result=fn_mcs_sync_selected_products($pids);
					if(!empty($sync_result['return_msg'])){
						fn_set_notification($sync_result['msg_type'], __('notice'), $sync_result['return_msg']);
					}
					if(!empty($sync_result['sync_result'])){
						Registry::get('view')->assign('mcs_sync_result',$sync_result['sync_result']);
					}				
				}
				if(!empty($_REQUEST['unsynced_products'])){
					$unsynced_products=fn_mcs_update_unsynced_table($_REQUEST['unsynced_products'],$pids);
					Registry::get('view')->assign('mcs_unsynced_products',$unsynced_products);
				}
			}elseif($sync_mode=='all'){
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

if($mode=='sync_log'){
	
	$sync_log=array();
	$fname=(isset($_REQUEST['fname']))?$_REQUEST['fname']:'';
	$dir='var/mcs_child_shop/';
	$files=fn_get_dir_contents($dir,true,true,'','',true);
	
	if(empty($files)){
		return false;
	}
	if($fname!=''){
		$sync_log=fn_get_contents($dir.$files[$fname]);
		$sync_log=json_decode($sync_log,true);
	}
	
	Registry::get('view')->assign('mcs_files',$files);
	Registry::get('view')->assign('mcs_fname',$fname);
	Registry::get('view')->assign('mcs_sync_log',$sync_log);
	
	
}

if($mode=='test'){

}