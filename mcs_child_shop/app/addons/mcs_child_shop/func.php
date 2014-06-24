<?php

use Tygh\Registry;
use Tygh\Storage;
use Tygh\BlockManager\Block;
use Tygh\BlockManager\ProductTabs;
use Tygh\Navigation\LastView;
use Tygh\Languages\Languages;

function fn_mcs_sync_product($product_id)
{
    /**
     * Adds additional actions before product cloning
     *
     * @param int $product_id Original product identifier
     */
    fn_set_hook('sync_product_pre', $product_id);

	fn_mcs_db_connect_parent();
	// Sync main data
    $main_data=fn_mcs_get_parent_main_data($product_id);
	// Sync descriptions
	$descriptions=fn_mcs_get_descriptions($product_id);
	// Sync prices
	$prices=fn_mcs_get_prices($product_id);
	// Sync options
	$options=fn_mcs_get_product_options($product_id);
	// Sync features
	$features=fn_mcs_get_product_features($product_id);
	
	fn_mcs_db_connect_child();
	// Sync main data
    $pid=fn_mcs_put_parent_main_data($main_data);
	// Sync descriptions
	fn_mcs_put_descriptions($descriptions, $pid);
	// Sync prices
	fn_mcs_put_prices($prices, $pid);
	// Put product on main category
	fn_mcs_put_product_categories($main_data,$pid);
	// Sync options
	fn_mcs_put_product_options($options,$product_id);
	// Sync features
	fn_mcs_put_product_features($features,$product_id);

/*    // Clone product features
    $data = db_get_array("SELECT * FROM ?:product_features_values WHERE product_id = ?i", $product_id);
    foreach ($data as $v) {
        $v['product_id'] = $pid;
        db_query("INSERT INTO ?:product_features_values ?e", $v);
    }

    // Clone blocks
    Block::instance()->cloneDynamicObjectData('products', $product_id, $pid);

    // Clone tabs info
    ProductTabs::instance()->cloneStatuses($pid, $product_id);

    // Clone addons
    fn_set_hook('clone_product', $product_id, $pid);

    // Clone images
    fn_clone_image_pairs($pid, $product_id, 'product');

    // Clone product files
    fn_clone_product_files($product_id, $pid);*/

    /**
     * Adds additional actions after product cloning
     *
     * @param int    $product_id Original product identifier
     * @param int    $pid        Cloned product identifier
     * @param string $orig_name  Original product name
     * @param string $new_name   Cloned product name
     */
    fn_set_hook('sync_product_post', $product_id, $pid, $orig_name, $new_name);

    return array('product_id' => $pid, 'orig_name' => $orig_name, 'product' => $new_name);
}

function fn_mcs_get_parent_main_data($product_id)
{
	$data = db_get_row("SELECT * FROM ?:products WHERE product_id = ?i", $product_id);
/*	$data['product_cid']=$data['product_id'];
    unset($data['product_id']);*/
    $data['status'] = 'D';
    $data['timestamp'] = $data['updated_timestamp'] = time();
	
	return $data;
}

function fn_mcs_put_parent_main_data($data)
{
	$pid=db_replace_into("products", $data);
	
	return $pid;
}

function fn_mcs_get_descriptions($product_id)
{
	$data = db_get_array("SELECT * FROM ?:product_descriptions WHERE product_id = ?i", $product_id);
	return $data;
}

function fn_mcs_put_descriptions($data, $pid)
{
	foreach ($data as $v) {
        $v['product_id'] = $pid;
		db_replace_into("product_descriptions", $v);
    }
}

function fn_mcs_get_prices($product_id)
{
	$data = db_get_array("SELECT * FROM ?:product_prices WHERE product_id = ?i", $product_id);
	return $data;
}

function fn_mcs_put_prices($data, $pid)
{
	foreach ($data as $v) {
        $v['product_id'] = $pid;
        unset($v['price_id']);
		db_replace_into("product_prices", $v);
    }
}

function fn_mcs_put_product_categories($data,$pid)
{
    $data = db_get_array("SELECT * FROM ?:products_categories WHERE product_id = ?i", $pid);
	if(empty($data)){
		$products_categories=array(
			'product_id'=>$pid,
			'category_id'=>1,
			'link_type'=>'M',
			'position'=>0
		);
		db_replace_into("products_categories", $products_categories);
		
		$temp = db_get_array("SELECT * FROM ?:products_categories WHERE product_id = ?i", $pid);
		$_cids = array();
		foreach ($temp as $v) {
			$_cids[] = $v['category_id'];
		}
		fn_update_product_count($_cids);
	}
}

function fn_mcs_get_all_product_options()
{
	$product_global_option_links=db_get_array("SELECT * FROM ?:product_global_option_links");
	$product_options=db_get_array("SELECT * FROM ?:product_options");
	$product_options_descriptions=db_get_array("SELECT * FROM ?:product_options_descriptions");
	$product_options_exceptions=db_get_array("SELECT * FROM ?:product_options_exceptions");
	$product_options_inventory=db_get_array("SELECT * FROM ?:product_options_inventory");
	$product_option_variants=db_get_array("SELECT * FROM ?:product_option_variants");
	$product_option_variants_descriptions=db_get_array("SELECT * FROM ?:product_option_variants_descriptions");
	
	$data=array(
		'product_global_option_links'=>$product_global_option_links,
		'product_options'=>$product_options,
		'product_options_descriptions'=>$product_options_descriptions,
		'product_options_exceptions'=>$product_options_exceptions,
		'product_options_inventory'=>$product_options_inventory,
		'product_option_variants'=>$product_option_variants,
		'product_option_variants_descriptions'=>$product_option_variants_descriptions
	);
	
	return $data;
}

function fn_mcs_get_product_options($product_id)
{
	$product_global_option_links=db_get_array("SELECT * FROM ?:product_global_option_links WHERE product_id=$product_id");
	$product_options=array();
	$product_options_descriptions=array();
	$product_option_variants=array();
	$product_option_variants_descriptions=array();
	if(!empty($product_global_option_links)){
		foreach($product_global_option_links as $k=>$v){
			$option_id=$v['option_id'];
			fn_mcs_get_product_options_and_descriptions($option_id,$product_options,$product_options_descriptions);
			fn_mcs_get_product_option_variants_and_descriptions($option_id,$product_option_variants,$product_option_variants_descriptions);
		}
	}else{
		$option_ids=db_get_array("SELECT option_id FROM ?:product_options WHERE product_id=$product_id");
		foreach($option_ids as $k=>$v){
			$option_id=$v['option_id'];			
			fn_mcs_get_product_options_and_descriptions($option_id,$product_options,$product_options_descriptions);
			fn_mcs_get_product_option_variants_and_descriptions($option_id,$product_option_variants,$product_option_variants_descriptions);
		}
	}
	$product_options_exceptions=db_get_array("SELECT * FROM ?:product_options_exceptions WHERE product_id=$product_id");
	$product_options_inventory=db_get_array("SELECT * FROM ?:product_options_inventory WHERE product_id=$product_id");
	
	$data=array(
		'product_global_option_links'=>$product_global_option_links,
		'product_options'=>$product_options,
		'product_options_descriptions'=>$product_options_descriptions,
		'product_options_exceptions'=>$product_options_exceptions,
		'product_options_inventory'=>$product_options_inventory,
		'product_option_variants'=>$product_option_variants,
		'product_option_variants_descriptions'=>$product_option_variants_descriptions
	);
	
	return $data;
}

function fn_mcs_get_product_options_and_descriptions($option_id,&$product_options,&$product_options_descriptions)
{
	$temp_options=db_get_array("SELECT * FROM ?:product_options WHERE option_id=$option_id");
	$temp_options_descriptions=db_get_array("SELECT * FROM ?:product_options_descriptions WHERE option_id=$option_id");
	
	array_push($product_options,$temp_options[0]);
	array_push($product_options_descriptions,$temp_options_descriptions[0]);
}

function fn_mcs_get_product_option_variants_and_descriptions($option_id,&$product_option_variants,&$product_option_variants_descriptions)
{
	$temp_option_variants=db_get_array("SELECT * FROM ?:product_option_variants WHERE option_id=$option_id");
	$temp_option_variants_descriptions=array();
	foreach($temp_option_variants as $k1=>$v1){
		$variant_id=$v1['variant_id'];
		$data=db_get_array("SELECT * FROM ?:product_option_variants_descriptions WHERE variant_id=$variant_id");
		array_push($temp_option_variants_descriptions,$data[0]);
	}
	
	foreach($temp_option_variants as $k2=>$v2){
		array_push($product_option_variants,$v2);
	}
	foreach($temp_option_variants_descriptions as $k2=>$v2){
		array_push($product_option_variants_descriptions,$v2);
	}
}

function fn_mcs_put_all_product_options($data)
{
	try{
		foreach($data as $k=>$v){
			fn_mcs_multi_db_replace_into($k,$v);
		}
		
		$result=__('text_options_copied');
		return $result;
	}
	catch(Exception $e){
		return 'Caught exception: '.$e->getMessage()."\n";
	}
}

function fn_mcs_put_product_options($data,$product_id)
{
	foreach($data as $k=>$v){
		fn_mcs_multi_db_replace_into($k,$v);
	}
}

function fn_mcs_get_all_product_features()
{
	$product_features=db_get_array("SELECT feature_id, feature_code, company_id, feature_type, parent_id, display_on_product, display_on_catalog, display_on_header, status, position, comparison FROM ?:product_features");
	$product_features_descriptions=db_get_array("SELECT * FROM ?:product_features_descriptions");
	$product_features_values=db_get_array("SELECT * FROM ?:product_features_values");
	$product_feature_variants=db_get_array("SELECT * FROM ?:product_feature_variants");
	$product_feature_variant_descriptions=db_get_array("SELECT * FROM ?:product_feature_variant_descriptions");
	
	$data=array(
		'product_features'=>$product_features,
		'product_features_descriptions'=>$product_features_descriptions,
		'product_features_values'=>$product_features_values,
		'product_feature_variants'=>$product_feature_variants,
		'product_feature_variant_descriptions'=>$product_feature_variant_descriptions
	);
	
	return $data;
}

function fn_mcs_get_product_features($product_id)
{
	$product_features_values=db_get_array("SELECT * FROM ?:product_features_values WHERE product_id=$product_id");
	$product_features=array();
	$product_features_descriptions=array();
	$product_feature_variants=array();
	$product_feature_variant_descriptions=array();
	
	foreach($product_features_values as $k=>$v){
		$feature_id=$v['feature_id'];
		
		$temp_product_features=db_get_array("SELECT feature_id, feature_code, company_id, feature_type, parent_id, display_on_product, display_on_catalog, display_on_header, status, position, comparison FROM ?:product_features WHERE feature_id=$feature_id");
		array_push($product_features,$temp_product_features[0]);
		
		$temp_product_features_descriptions=db_get_array("SELECT * FROM ?:product_features_descriptions WHERE feature_id=$feature_id");
		array_push($product_features_descriptions,$temp_product_features_descriptions[0]);
		
		$variant_id=$v['variant_id'];
		
		$temp_product_feature_variants=db_get_array("SELECT * FROM ?:product_feature_variants WHERE variant_id=$variant_id");
		array_push($product_feature_variants,$temp_product_feature_variants[0]);
		
		$temp_product_feature_variant_descriptions=db_get_array("SELECT * FROM ?:product_feature_variant_descriptions WHERE variant_id=$variant_id");
		array_push($product_feature_variant_descriptions,$temp_product_feature_variant_descriptions[0]);

	}
	
	$data=array(
		'product_features'=>$product_features,
		'product_features_descriptions'=>$product_features_descriptions,
		'product_features_values'=>$product_features_values,
		'product_feature_variants'=>$product_feature_variants,
		'product_feature_variant_descriptions'=>$product_feature_variant_descriptions
	);
	
	return $data;;
}

function fn_mcs_put_all_product_features($data)
{
	try{
		foreach($data as $k=>$v){
			fn_mcs_multi_db_replace_into($k,$v);
		}
		
		$result=__('text_features_copied');
		return $result;
	}
	catch(Exception $e){
		return 'Caught exception: '.$e->getMessage()."\n";
	}
}

function fn_mcs_put_product_features($data,$product_id)
{
	foreach($data as $k=>$v){
		fn_mcs_multi_db_replace_into($k,$v);
	}
}

function fn_mcs_db_connect_parent()
{
	$params = array(
	  'dbc_name' => 'parent',
	  'table_prefix' => 'cscart_'
	);
	db_initiate('localhost', 'vaskou', 'vaskou1!', 'cscart_parent', $params);
	db_connect_to($params, 'cscart_master');
}

function fn_mcs_db_connect_child()
{
	$params = array(
	  'dbc_name' => 'child',
	  'table_prefix' => 'cscart_'
	);
	db_initiate('localhost', 'vaskou', 'vaskou1!', 'cscart_child', $params);
	db_connect_to($params, 'cscart_child');
}


function fn_mcs_multi_db_replace_into($table,$data)
{
	foreach($data as $k=>$v){
		db_replace_into($table,$v);	
	}
}