<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($mode == 'send_form' && isset($_REQUEST['form_values']['mcs_form_type'])) {

        $suffix = '';
        if (fn_image_verification('use_for_form_builder', $_REQUEST) == false) {
            fn_save_post_data('form_values');

            return array(CONTROLLER_STATUS_REDIRECT, "pages.view?page_id=$_REQUEST[page_id]");
        }

        if (fn_mcs_send_form($_REQUEST['page_id'], empty($_REQUEST['form_values']) ? array() : $_REQUEST['form_values'])) {
            $suffix = '&sent=Y';
        }
		
        return array(CONTROLLER_STATUS_OK, "pages.view?page_id=$_REQUEST[page_id]" . $suffix);
    }
	
    return;
}