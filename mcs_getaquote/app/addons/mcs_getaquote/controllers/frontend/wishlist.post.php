<?php

use Tygh\Registry;
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'view') {
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$products=$tpl_vars['products']->value;
	//var_dump($products);
	
	$vendor_ids=array();
	$vendors=array();
	
	foreach($products as $product){
		$vendor_products[$product['company_id']][$product['cart_id']]=$product;	
		if(!in_array($product['company_id'],$vendor_ids)){
			$vendor_ids[]=$product['company_id'];
		}
	}
	
	foreach($vendor_ids as $vid){
		$vendors[$vid]=fn_get_company_data($vid);
		if (fn_allowed_for('MULTIVENDOR')) {
			if (!empty($vid)) {
				$vendors[$vid]['logos'] = fn_get_logos($vid);
			}
	
			//Registry::get('view')->assign('logo_types', fn_get_logo_types(true));
		}
	}
	
	//var_dump($vendor_products);
	Registry::get('view')->assign('vendor_products', $vendor_products);
	Registry::get('view')->assign('vendors', $vendors);
}