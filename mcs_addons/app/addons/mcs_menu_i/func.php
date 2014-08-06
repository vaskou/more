<?php

function fn_mcs_get_filters()
{
	return 'Vasilis';
}

function fn_mcs_category_subcategories($category_id,&$result)
{
	
	$category[$category_id]['category_id']=$category_id;
	
	$category[$category_id]['subcategories']=fn_get_categories_tree($category_id);
	
	foreach($category as $k=>$v){
		if(!empty($v['subcategories'])){
			foreach($v['subcategories'] as $k1=>$v1){
				$result[]=fn_mcs_category_subcategories($v1['category_id'],$result);
			}
		}
	}
	
	return $category_id;
	
}

function fn_mcs_get_products_by_category($category_ids)
{
	$products=array();
	
	foreach($category_ids as $cid){
		$result=db_get_array("SELECT product_id FROM ?:products_categories WHERE category_id=$cid");
		
		if(!empty($result)){
			foreach($result as $pid){
				$products[]=$pid['product_id'];
			}
		}
	}

	return $products;
	
}

function fn_mcs_get_product_brand($product_ids)
{
	$brands=array();
	
	foreach($product_ids as $pid){
		$result=db_get_hash_single_array("SELECT a.variant_id, b.variant FROM ?:product_features_values as a INNER JOIN ?:product_feature_variant_descriptions as b ON a.variant_id=b.variant_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.product_id=$pid AND a.feature_id=18", array('variant_id', 'variant'));
		//$result=db_get_row("SELECT variant_id FROM ?:product_features_values WHERE product_id=$pid AND feature_id=18 AND lang_code=?s",CART_LANGUAGE);
		if(!empty($result)){
			if(!in_array($result[key($result)],$brands)){
				$brands[]=$result[key($result)];
			}
		}
		/*var_dump($result);
		die;*/
	}
	var_dump($brands);
}