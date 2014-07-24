<?php

use Tygh\Registry;
use Tygh\BlockManager\Block;

if (!defined('BOOTSTRAP')) { die('Access denied'); }


function fn_get_product_mcs_child_sync_product($product_id)
{
	return db_get_field("SELECT mcs_child_sync_product FROM ?:products WHERE product_id = ?i", $product_id);
}

function fn_get_product_mcs_child_sync_images($product_id)
{
	return db_get_field("SELECT mcs_child_sync_images FROM ?:products WHERE product_id = ?i", $product_id);
}

function fn_get_product_mcs_child_sync_files($product_id)
{
	return db_get_field("SELECT mcs_child_sync_files FROM ?:products WHERE product_id = ?i", $product_id);
}

function fn_get_product_mcs_child_product($product_id)
{
	return db_get_field("SELECT mcs_child_product FROM ?:product_descriptions WHERE product_id = ?i", $product_id);
}

function fn_get_product_mcs_child_full_description($product_id)
{
	return db_get_field("SELECT mcs_child_full_description FROM ?:product_descriptions WHERE product_id = ?i", $product_id);
}

/* [HOOKS] */

function fn_mcs_parent_shop_gather_additional_product_data_post(&$product, $auth, $params)
{
	$product['mcs_child_sync_product'] = fn_get_product_mcs_child_sync_product($product['product_id']);
	$product['mcs_child_sync_images'] = fn_get_product_mcs_child_sync_images($product['product_id']);
	$product['mcs_child_sync_files'] = fn_get_product_mcs_child_sync_files($product['product_id']);
	$product['mcs_child_product'] = fn_get_product_mcs_child_product($product['product_id']);
	$product['mcs_full_description'] = fn_get_product_mcs_child_product($product['product_id']);
}


function fn_mcs_parent_shop_update_product_pre(&$product_data, &$product_id, &$lang_code, &$can_update)
{
	$today=fn_parse_date(date("m/d/y"));
	
	if($product_data['mcs_child_sync_product_force']=="Y")
		$product_data['timestamp']=$today;
	
	return $product_data;
}

/* [/HOOKS] */

?>
