<?php

use Tygh\Registry;
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'view') {
	
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$products=$tpl_vars['products']->value;
	
	list($vendor_products,$vendors)=fn_mcs_seperate_products_by_vendor($products);
	
	Registry::get('view')->assign('vendor_products', $vendor_products);
	Registry::get('view')->assign('vendors', $vendors);
	
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($mode == 'add') {
		if (!empty($_SESSION['notifications'])) {
			foreach ($_SESSION['notifications'] as $k => $v) {
				if ($v['message_state']=='I' & $v['type']=='I') {
					unset($_SESSION['notifications'][$k]);
				}
			}
		}
	
		return true;
	}
}