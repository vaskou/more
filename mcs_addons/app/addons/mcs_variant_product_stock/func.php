<?php

function fn_mcs_variant_product_stock_update_product_option_pre($option_data, $option_id, $lang_code)
{	
	$variants=$option_data['variants'];
	foreach($variants as $k=>$v){
		foreach($v['mcs_related_product'] as $k1=>$v1){
			$comb_hash=fn_generate_cart_id($v1['product_id'],array('product_options'=>$v1['product_options']));
			$v['mcs_related_product'][$k1]['comb_hash']=$comb_hash;
		}

		$mcs_related_product=serialize($v['mcs_related_product']);
		$option_data['variants'][$k]['mcs_related_product']=$mcs_related_product;
	}
	/*var_dump($option_data);
	die;*/
}

function fn_mcs_variant_product_stock_update_product_option_post( $option_data, $option_id, $deleted_variants, $lang_code)
{
	/*foreach ($option_data['variants'] as $k => $v) {
		if ((!isset($v['variant_name']) || $v['variant_name'] == '') && $option_data['option_type'] != 'C') {
			continue;
		}
		
	}
	
	var_dump($deleted_variants);
	die;*/
}

function fn_mcs_variant_product_stock_rebuild_product_options_inventory_pre($product_id, $amount)
{
	
}

function fn_mcs_variant_product_stock_look_through_variants_pre($product_id, $amount, $options, $variants)
{
	var_dump($product_id);
	var_dump($options);
	var_dump($variants);
	$combinations = fn_get_options_combinations($options, $variants);
	var_dump($combinations);
	die;
}