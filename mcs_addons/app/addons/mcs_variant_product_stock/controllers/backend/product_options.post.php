<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if ($mode == 'update') {
	
		
	}


}


if ($mode == 'update') {
	$product_id = !empty($_REQUEST['product_id']) ? $_REQUEST['product_id'] : 0;

    $o_data = fn_get_product_option_data($_REQUEST['option_id'], $product_id);
	
	$variants=$o_data['variants'];
	//var_dump($o_data);
	//die;
	foreach($variants as $k=>$v){
		$variant_id=$v['variant_id'];
		$result=db_get_field("SELECT mcs_related_product FROM ?:product_option_variants WHERE variant_id = ?s",$variant_id);
		/*var_dump($result);*/
		$o_data['variants'][$variant_id]['mcs_related_product']=unserialize($result);
	}
	Registry::get('view')->assign('option_data', $o_data);
	
}

