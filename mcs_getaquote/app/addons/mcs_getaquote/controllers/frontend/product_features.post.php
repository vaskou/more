<?php

use Tygh\Registry;
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }



if($mode="view"){
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$variant_id=$tpl_vars['variant_data']->value['variant_id'];
	$vendor_id=db_get_field("SELECT company_id FROM ?:companies WHERE mcs_connected_brand=?i",$variant_id);
	var_dump($vendor_id);
	
	fn_mcs_vendor_wishlist_view($vendor_id);
}