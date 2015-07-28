<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($mode == 'mcs_send_form' && isset($_REQUEST['form_values']['mcs_form_type'])) {

        $suffix = '';
        if (fn_image_verification('use_for_form_builder', $_REQUEST) == false) {
            fn_save_post_data('form_values');
			
			if($_REQUEST['mcs_variant_id']=='wishlist'){
				return array(CONTROLLER_STATUS_REDIRECT, "wishlist.view");
			}
			return array(CONTROLLER_STATUS_REDIRECT, "product_features.view?variant_id=$_REQUEST[mcs_variant_id]");
			
        }

        if (fn_mcs_send_form($_REQUEST['page_id'], empty($_REQUEST['form_values']) ? array() : $_REQUEST['form_values'], $auth)) {
            $suffix = '&sent=Y';
			fn_set_notification('N', __('notice'), 'Email is sent!');
        }
		
		if($_REQUEST['mcs_variant_id']=='wishlist'){
			return array(CONTROLLER_STATUS_REDIRECT, "wishlist.view");
		}
        return array(CONTROLLER_STATUS_OK, "product_features.view?variant_id=$_REQUEST[mcs_variant_id]" . $suffix);
		
    }
	
    return;
}