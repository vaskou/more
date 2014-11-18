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

function fn_get_child_shops()
{	
    return array(db_get_array("SELECT * FROM ?:mcs_child_shops ORDER BY domain"));
}

function fn_get_product_child_shops($product_id)
{	
    return unserialize(db_get_field("SELECT mcs_child_shops_domains FROM ?:products WHERE product_id='".$product_id."'"));
}

function fn_update_child_shop( $child_shop_data, $child_shop_id)
{
	if (!empty($child_shop_id))
		db_query("UPDATE ?:mcs_child_shops SET ?u WHERE child_shop_id = ?i", $child_shop_data, $child_shop_id);
	else
        $child_shop_id = $child_shop_data['child_shop_id'] = db_query("REPLACE INTO ?:mcs_child_shops ?e", $child_shop_data);
	
	return $child_shop_id;
}

function fn_check_child_shop_domain_exists($domain)
{
	$domain=db_get_field("SELECT child_shop_id FROM ?:mcs_child_shops WHERE domain ='".$domain."'");
	
	return $domain;
}

function fn_delete_child_shop_by_id($child_shop_id)
{
    if (!empty($child_shop_id))	
        db_query("DELETE FROM ?:mcs_child_shops WHERE child_shop_id = ?i", $child_shop_id);

}

function fn_mcs_get_product_status($product_id)
{
	$status=db_get_field("SELECT status FROM ?:products WHERE product_id ='".$product_id."'");
	return $status;
}

function fn_mcs_update_product_timestamp($product_id)
{
	$today=fn_mcs_parse_date();
	db_query("UPDATE ?:products SET timestamp= '".$today."' WHERE product_id = '".$product_id."'" );
}

function fn_mcs_parse_date()
{
	$format=Registry::get('settings.Appearance.calendar_date_format');
	if($format=='day_first'){
		$today=fn_parse_date(date("d/m/y"));
	}elseif($format=='month_first'){
		$today=fn_parse_date(date("m/d/y"));
	}
	
	return $today;
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
	//Check if product status has changed to 
	$status=fn_mcs_get_product_status($product_id);
	$status_new=$product_data['status'];
	$status_changed=($status!=$status_new)?true:false;
	
	$today=fn_mcs_parse_date();
	
	if($product_data['mcs_child_sync_product_force']=="Y"||$status_changed)
		$product_data['timestamp']=$today;
	
	$product_data['mcs_child_shops_domains']=(isset($product_data['mcs_child_shops_domains']))?serialize($product_data['mcs_child_shops_domains']):'';
	
	return $product_data;
}

//Hook on product status change

function fn_mcs_parent_shop_tools_change_status($params, $result)
{
	if($params['table']=='products')
		fn_mcs_update_product_timestamp($params['id']);

}
/* [/HOOKS] */

?>
