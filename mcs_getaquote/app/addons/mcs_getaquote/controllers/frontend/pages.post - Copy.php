<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }
	
if($mode=='view' && !empty($_REQUEST['page_id'])){
	if (defined('AJAX_REQUEST')) {
				
		Registry::get('view')->assign('mcs_req',$_REQUEST);
		
//		fn_set_notification('I', $title, $msg,'S','test');
		
		return;
	}
}
