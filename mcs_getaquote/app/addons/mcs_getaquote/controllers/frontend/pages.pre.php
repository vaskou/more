<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if($mode=='view' && !empty($_REQUEST['page_id'])){
		if (defined('AJAX_REQUEST')) {
		//Pages frontend controller code	
			$_REQUEST['page_id'] = empty($_REQUEST['page_id']) ? 0 : $_REQUEST['page_id'];
			$preview = fn_is_preview_action($auth, $_REQUEST);
			$page = fn_get_page_data($_REQUEST['page_id'], CART_LANGUAGE, $preview);
		
			if (empty($page) || ($page['status'] == 'D' && !$preview)) {
				return array(CONTROLLER_STATUS_NO_PAGE);
			}
		
			if (!empty($page['meta_description']) || !empty($page['meta_keywords'])) {
				Registry::get('view')->assign('meta_description', $page['meta_description']);
				Registry::get('view')->assign('meta_keywords', $page['meta_keywords']);
			}
		
			// If page title for this page is exist than assign it to template
			if (!empty($page['page_title'])) {
				Registry::get('view')->assign('page_title', $page['page_title']);
			}
		
			$parent_ids = explode('/', $page['id_path']);
			foreach ($parent_ids as $p_id) {
				$_page = fn_get_page_data($p_id);
				fn_add_breadcrumb($_page['page'], ($p_id == $page['page_id']) ? '' : ($_page['page_type'] == PAGE_TYPE_LINK && !empty($_page['link']) ? $_page['link'] : "pages.view?page_id=$p_id"));
			}
		
			Registry::get('view')->assign('page', $page);
		
		//Form builder pages.post frontend controller code	
			$page_is_https = db_get_field("SELECT value FROM ?:form_options WHERE element_type = ?s AND page_id = ?i", FORM_IS_SECURE, $_REQUEST['page_id']);
			// if form is secure, redirect to https connection
			if (!defined('HTTPS') && $page_is_https == 'Y') {
				return array(CONTROLLER_STATUS_REDIRECT, Registry::get('config.https_location') . '/' . Registry::get('config.current_url'));
		
			} elseif (defined('HTTPS') && Registry::get('settings.Security.keep_https') != 'Y' && $page_is_https != 'Y') {
				return array(CONTROLLER_STATUS_REDIRECT, Registry::get('config.http_location') . '/' . Registry::get('config.current_url'));
			}
		
			$restored_form_values = fn_restore_post_data('form_values');
			if (!empty($restored_form_values)) {
				Registry::get('view')->assign('form_values', $restored_form_values);
			}
		
		//mcs_getaquote code
			$last_key=end(array_keys($page['form']['elements']));
			Registry::get('view')->assign('mcs_last_key',$last_key);	
			Registry::get('view')->assign('mcs_product_data',$_REQUEST['mcs_product_data']);
			
			$title = __('product_added_to_wl');
            $msg = Registry::get('view')->fetch('addons\mcs_getaquote\common\form_notification.tpl');
            fn_set_notification('I', $title, $msg);
			
			return;
		}
	}
}