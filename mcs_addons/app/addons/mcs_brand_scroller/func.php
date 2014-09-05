<?php

use Tygh\Registry;
use Tygh\BlockManager;
use Tygh\BlockManager\Block;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/********************* Brands and Brands Scroller ************************/

function fn_get_brands($feature_id, $lang_code = CART_LANGUAGE)
{
	//var_dump($feature_id);
    $params['feature_id']=$feature_id;
	$params['feature_type']="E";
    $params['get_images'] = true;
	
    list($brands, $search) = fn_get_product_feature_variants($params,0, DESCR_SL);
	
    return array($brands, $params);
}

function fn_get_brand_name($brand_id,$feature_id)
{
	list($brands, )=fn_get_brands($feature_id);
	$brand_name=$brands[$brand_id]['variant'];
	
	return $brand_name;
}

function fn_get_selected_brands($params)
{
	$feature_id=$params['mcs_brand_scroller_brand_feature_id'];
	//var_dump($params);
	$sel_brands=array();
	list($brands, )=fn_get_brands($feature_id);

	if($params['has_limit']){
		$br_count=count($brands);
		$limit=$params['limit'];
		if($br_count < $limit)
		{
			$ids=array_rand($brands,$br_count);
		}else{
			$ids=array_rand($brands,$limit);
		}
	}else{
		$ids=explode(",",$params['item_ids']);
	}
	
	foreach($ids as $id){
		array_push($sel_brands, $brands[$id]);
	}
	
	return array($sel_brands);
}

function fn_mcs_product_get_features()
{
   	return db_get_hash_single_array("SELECT a.feature_id, b.description FROM ?:product_features as a LEFT JOIN ?:product_features_descriptions as b ON a.feature_id=b.feature_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.status='A' AND a.feature_type='E' ORDER BY b.description", array('feature_id', 'description'));
}

function fn_mcs_product_get_feature_filter($feature_id)
{
   	return db_get_hash_single_array("SELECT a.filter_id, b.filter FROM ?:product_filters as a LEFT JOIN ?:product_filter_descriptions as b ON a.filter_id=b.filter_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.status='A' AND a.feature_id='$feature_id' ORDER BY b.filter", array('filter_id', 'filter'));
}