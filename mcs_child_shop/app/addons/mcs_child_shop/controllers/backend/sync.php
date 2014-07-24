<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if($mode=='manage'){
	
	if (!empty($_REQUEST['product_id'])){
		$pid = $_REQUEST['product_id'];
		if($pid=='new'){
			$sync_result=fn_mcs_sync_all_products();
			if(!empty($sync_result['return_msg'])){
				fn_set_notification($sync_result['msg_type'], __('notice'), $sync_result['return_msg']);
			}
			if(!empty($sync_result['sync_result'])){
				Registry::get('view')->assign('mcs_sync_result',$sync_result['sync_result']);
				//var_dump($sync_result['sync_result']);
			}
		}
		if($pid=='all'){
			$sync_result=fn_mcs_sync_all_products(true,true);
			if(!empty($sync_result['return_msg'])){
				fn_set_notification($sync_result['msg_type'], __('notice'), $sync_result['return_msg']);
			}
			if(!empty($sync_result['sync_result'])){
				Registry::get('view')->assign('mcs_sync_result',$sync_result['sync_result']);
				//var_dump($sync_result['sync_result']);
			}
		}
	}
	
	$last_sync_timestamp=fn_mcs_get_timestamp_of_sync();
	Registry::get('view')->assign('mcs_timestamp',$last_sync_timestamp);
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

if ($mode == 'options'){

	fn_mcs_db_connect_parent();
	$data=fn_mcs_get_all_product_options();
	fn_mcs_db_connect_child();
	$result=fn_mcs_put_all_product_options($data);
	
	fn_set_notification('N', __('notice'), $result,'S');
	
}

if ($mode == 'features'){
	fn_mcs_db_connect_parent();
	$data=fn_mcs_get_all_product_features();
	fn_mcs_db_connect_child();
	$result=fn_mcs_put_all_product_features($data);
	
	fn_set_notification('N', __('notice'), $result,'S');
}

if($mode=='images'){
	if (!empty($_REQUEST['product_id'])) {
		$pid = $_REQUEST['product_id'];	
	}
}