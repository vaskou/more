<?php

if ( !defined('AREA') ) { die('Access denied'); }


function fn_mcs_promotions_get_categories($lang_code = CART_LANGUAGE)
{
	list($categories) = fn_get_categories(array('plain'=>true));
	
	$res=array();
	foreach($categories as $k=>$v){
		if($v['store']==false){
			$name=fn_get_category_name($v['category_id']);
			$level=$v['level'];
			$dashes="";
			for($i=0;$i<$level;$i++){
				$dashes.=" - ";
			}
			$res[$v['id_path']]['value'] = $dashes.$name;
			$res[$v['id_path']]['variants'] = array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10'
			);
		}
	}
	
	return $res;
}

/**
 * Calculate total quantity of products in cart
 *
 * @param array $cart cart information
 * @param array $cart_products cart products
 * @param char $type S - quantity for shipping, A - all, C - all, exception excluded from calculation
 * @return int products quantity
 */
function fn_mcs_promotions_check_products_amount($promotion, $cart, $cart_products, $type = 'S')
{
	$amount = 0;
	$prom_sel_cat_path_ids=explode("/",$promotion['condition_element']);
	$prom_sel_cat_path_ids_amount=count($prom_sel_cat_path_ids);
	$prom_sel_category = $prom_sel_cat_path_ids[$prom_sel_cat_path_ids_amount-1];
	$prom_prod_amount = $promotion['value'];
	$prom_operator = $promotion['operator'];
	$prom_sel_category_subids=array();

	list($categories)=fn_get_categories(array('plain'=>true));
	foreach($categories as $k=>$v){		
		$ids=explode("/",$v['id_path']);
		if(in_array($prom_sel_category,$ids)){
			array_push($prom_sel_category_subids,$v['category_id']);
		}
	}
	
	foreach ($cart_products as $k => $v) {
		if ($type == 'S') {
			if (($v['is_edp'] == 'Y' && $v['edp_shipping'] != 'Y') || $v['free_shipping'] == 'Y' || fn_exclude_from_shipping_calculate($cart['products'][$k])) {
				continue;
			}
		} elseif ($type == 'C') {
			if (isset($v['exclude_from_calculate'])) {
				continue;
			}
		}
		
		$cat_ids=$v['category_ids'];
		foreach($cat_ids as $k1=>$v1){
			if(in_array($v1,$prom_sel_category_subids)){
				$amount+=$v['amount'];
				break;
			}
		}
	}
	
	switch($prom_operator){
		case 'gte':			
			if($amount>=$prom_prod_amount){ return true; }else{ return false; }
		case 'gt':
			if($amount>$prom_prod_amount){ return true; }else{ return false; }
		case 'lte':
			if($amount<=$prom_prod_amount){ return true; }else{ return false; }
		case 'lt':
			if($amount<$prom_prod_amount){ return true; }else{ return false; }
	}
}
