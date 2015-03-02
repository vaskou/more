<?php

use Tygh\Registry;
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }



if($mode=="view"){
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$variant_id=$tpl_vars['variant_data']->value['variant_id'];
	
	$vendor_id=fn_mcs_getaquote_get_vendor_id($variant_id);
	
	$show_getaquote_block=fn_mcs_getaquote_show_getaquote_block($vendor_id);
	
	fn_mcs_vendor_wishlist_view($vendor_id,$variant_id,$show_getaquote_block);

}