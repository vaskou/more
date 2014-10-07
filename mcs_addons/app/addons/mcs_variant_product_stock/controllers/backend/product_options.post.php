<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if ($mode == 'update_combinations') {
		
		$temp_ids=array();
		
		$result=db_get_array("SELECT product_id FROM ?:product_options_inventory");
		foreach($result as $k=>$v){
			if(!in_array($v['product_id'],$temp_ids)){
				$temp_ids[]=$v['product_id'];
				fn_rebuild_product_options_inventory($v['product_id'], 50);
			}
		}	
	}

}


if ($mode == 'update') {
	$product_id = !empty($_REQUEST['product_id']) ? $_REQUEST['product_id'] : 0;

    $o_data = fn_get_product_option_data($_REQUEST['option_id'], $product_id);
	if(!empty($o_data)){
		$variants=$o_data['variants'];
		
		foreach($variants as $k=>$v){
			$variant_id=$v['variant_id'];
			$result=db_get_field("SELECT mcs_related_product FROM ?:product_option_variants WHERE variant_id = ?s",$variant_id);
			$o_data['variants'][$variant_id]['mcs_related_product']=unserialize($result);
		}
		Registry::get('view')->assign('option_data', $o_data);
	}
	
}

