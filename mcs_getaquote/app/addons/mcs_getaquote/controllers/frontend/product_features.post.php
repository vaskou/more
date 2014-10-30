<?php

use Tygh\Registry;
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }



if($mode=="view"){
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$variant_id=$tpl_vars['variant_data']->value['variant_id'];
	$vendor_id=db_get_field("SELECT mcs_connected_company FROM ?:product_feature_variant_descriptions WHERE variant_id=?i AND lang_code=?s",$variant_id,CART_LANGUAGE);

	fn_mcs_vendor_wishlist_view($vendor_id,$variant_id);
}