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