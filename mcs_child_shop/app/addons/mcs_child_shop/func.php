<?php

use Tygh\Registry;
use Tygh\Storage;
use Tygh\BlockManager\Block;
use Tygh\BlockManager\ProductTabs;
use Tygh\Navigation\LastView;
use Tygh\Languages\Languages;

include("write_log.php");
include("read_log.php");

$addons=Registry::get('addons');
$mcs_child_shop=$addons['mcs_child_shop'];

$GLOBALS['db_parent_params']=array(
	'server'=>$mcs_child_shop['mcs_general_parent_server'],
	'username'=>$mcs_child_shop['mcs_general_parent_username'],
	'password'=>$mcs_child_shop['mcs_general_parent_password'],
	'table_prefix'=>$mcs_child_shop['mcs_general_parent_table_prefix'],
	'db_name'=>$mcs_child_shop['mcs_general_parent_db_name'],
	'dbc_name'=>'parent'
);
$GLOBALS['db_child_params']=array(
	'server'=>$mcs_child_shop['mcs_general_child_server'],
	'username'=>$mcs_child_shop['mcs_general_child_username'],
	'password'=>$mcs_child_shop['mcs_general_child_password'],
	'table_prefix'=>$mcs_child_shop['mcs_general_child_table_prefix'],
	'db_name'=>$mcs_child_shop['mcs_general_child_db_name'],
	'dbc_name'=>'child'
);

$GLOBALS['mcs_parent_url']=fn_mcs_check_url($mcs_child_shop['mcs_general_parent_url']);

$GLOBALS['feature_ids']=array();
$GLOBALS['variant_ids']=array();
$GLOBALS['option_ids']=array();
$GLOBALS['sync_products_enabled']=false;
$GLOBALS['master_category_id']=799999;
$GLOBALS['company_id']=(Registry::get('runtime.forced_company_id') ? Registry::get('runtime.forced_company_id') : Registry::get('runtime.company_id'));

function fn_mcs_sync_product($product_id)
{
	$product_data=array();
	
	// Connect to parent db
	$db_result=fn_mcs_db_connect($GLOBALS['db_parent_params']);
	
	// Check connection
	if(!$db_result['db_init'] || !$db_result['db_con']){
		write_log('Parent database connection problem');
		return array('return_msg'=>'Database connection problem', 'msg_type'=>'E');
	}
	
	// Get all product data from parent
	$product_data=fn_mcs_get_all_product_data($product_id);

/*	// Sync files
	if($sync_data['mcs_child_sync_files']=='Y'){
		$files=fn_mcs_get_product_files($product_id);
	}*/
	
	// Check if there were errors
	if(!empty($product_data['msg_type'])){
		return $product_data;
	}
	
	// Connect to child db
	$db_result=fn_mcs_db_connect($GLOBALS['db_child_params']);
	
	// Check connection
	if(!$db_result['db_init'] || !$db_result['db_con']){
		write_log('Child database connection problem');
		return array('return_msg'=>'Database connection problem', 'msg_type'=>'E');
	}
	
	// Put all product data to child
	$put_result=fn_mcs_put_all_product_data($product_data);

/*	// Sync files
	if($sync_data['mcs_child_sync_files']=='Y'){
		fn_mcs_put_product_files($files,$product_id);
	}*/
	
	// Return result message
	return $put_result;
}

function fn_mcs_sync_all_products($sync_taxes=false,$sync_categories=false,$sync_products_enabled=false)
{
	$GLOBALS['sync_products_enabled']=$sync_products_enabled;
	$sync_result=array();
	$product_data=array();

	$last_sync_timestamp=fn_mcs_get_timestamp_of_sync();
	
	// Connect to parent db
	$db_result=fn_mcs_db_connect($GLOBALS['db_parent_params']);
	// Check connection
	if(!$db_result['db_init'] || !$db_result['db_con']){
		write_log('Parent database connection problem');
		return array('return_msg'=>'Database connection problem', 'msg_type'=>'E');
	}
	
	// Get all categories from parent
	if($sync_categories){
		$categories=fn_mcs_get_all_categories();
	}

	// Get product ids of products to be synced
	$pids = db_get_array("SELECT product_id FROM ?:products WHERE mcs_child_sync_product='Y' AND timestamp >= ".$last_sync_timestamp);
	foreach($pids as $k=>$v){
		//$sync_result[]=fn_mcs_sync_product($v['product_id']);
		$product_data[$v['product_id']]=fn_mcs_get_all_product_data($v['product_id']);
	}
	
	// Get taxes, destinations and states tables from parent
	if($sync_taxes){
		$taxes=fn_mcs_get_all_taxes();
		$destinations=fn_mcs_get_all_destinations();
		$states=fn_mcs_get_all_states();
	}
	
	// Connect to child db
	$db_result=fn_mcs_db_connect($GLOBALS['db_child_params']);
	// Check connection
	if(!$db_result['db_init'] || !$db_result['db_con']){
		write_log('Child database connection problem');
		return array('return_msg'=>'Database connection problem', 'msg_type'=>'E');
	}
	
	// Put all categories to child
	if($sync_categories){
		if(empty($categories['msg_type'])){
			$categories_result=fn_mcs_put_all_categories($categories);
			fn_mcs_error_logging($categories_result,'Error putting data with fn_mcs_put_all_categories');
		}else{
			fn_set_notification($categories['msg_type'], __('notice'), $categories['return_msg']);
		}
	}
	
	// Put products to be synced
	foreach($product_data as $k=>$v){
		if(empty($v['msg_type'])){
			$product_result=fn_mcs_put_all_product_data($v);
			$sync_result[]=array(
				'name'=>$v['descriptions'][CART_LANGUAGE]['product'],
				'product_id'=>$v['descriptions'][CART_LANGUAGE]['product_id']
			);
		}
	}
	
	// Put taxes, destinations and states tables to child
	if($sync_taxes){
		if(empty($taxes['msg_type'])){
			$taxes_result=fn_mcs_put_all_taxes($taxes);
			fn_mcs_error_logging($taxes_result,'Error putting data with fn_mcs_put_all_taxes');
		}else{
			fn_set_notification($taxes['msg_type'], __('notice'), $taxes['return_msg']);
		}
		if(empty($destinations['msg_type'])){
			$destinations_result=fn_mcs_put_all_destinations($destinations);
			fn_mcs_error_logging($destinations_result,'Error putting data with fn_mcs_put_all_destinations');
		}else{
			fn_set_notification($destinations['msg_type'], __('notice'), $destinations['return_msg']);
		}
		if(empty($states['msg_type'])){
			$states_result=fn_mcs_put_all_states($states);
			fn_mcs_error_logging($states_result,'Error putting data with fn_mcs_put_all_states');
		}else{
			fn_set_notification($states['msg_type'], __('notice'), $states['return_msg']);
		}
	}
	
	// Update timestamp of sync
	$today=fn_parse_date(date('m/d/Y'));
	db_replace_into("mcs_timestamp_of_sync",array('id'=>1,'timestamp'=>$today));
	
	return array('return_msg'=>'Synchronization finished', 'msg_type'=>'N', 'sync_result'=>$sync_result);
}

function fn_mcs_get_all_product_data($product_id)
{
	$data=fn_mcs_get_parent_main_data($product_id);
	if(empty($data)){
		$msg='There is no product with this id';
		write_log($msg.'('.$product_id.')');
		return array('return_msg'=>$msg, 'msg_type'=>'W');
	}
    $main_data=$data['product_data'];
	$sync_data=$data['sync_data'];
	if($sync_data['mcs_child_sync_product']=='N'){
		return array('return_msg'=>'Product is not allowed to be synced', 'msg_type'=>'W');	
	}
	
	// Sync descriptions
	$descriptions=fn_mcs_get_descriptions($product_id);
	fn_mcs_error_logging($descriptions,'Nothing returned from fn_mcs_get_descriptions with product_id = '.$product_id);
	
	// Sync prices
	$prices=fn_mcs_get_prices($product_id);
	fn_mcs_error_logging($prices,'Nothing returned from fn_mcs_get_prices with product_id = '.$product_id);
	
	// Sync options
	$options=fn_mcs_get_product_options($product_id);
	// Sync features
	$features=fn_mcs_get_product_features($product_id);

	$result=array(
		'product_id'=>$product_id,
		'main_data'=>$main_data,
		'sync_data'=>$sync_data,
		'descriptions'=>$descriptions,
		'prices'=>$prices,
		'options'=>$options,
		'features'=>$features
	);
	
	return $result;
}

function fn_mcs_put_all_product_data($data)
{
	$m_data_result=fn_mcs_put_parent_main_data($data['main_data']);
	if(!$m_data_result){
		$msg='Error putting product data in database';
		write_log('Error putting data with fn_mcs_put_parent_main_data with product_id = '.$data['product_id']);
		return array('return_msg'=>$msg, 'msg_type'=>'E');
	}
	
	// Sync descriptions
	$descr_result=fn_mcs_put_descriptions($data['descriptions']);
	fn_mcs_error_logging($descr_result,'Error putting data with fn_mcs_put_descriptions with product_id = '.$data['product_id']);
	
	// Sync prices
	$prices_result=fn_mcs_put_prices($data['prices']);
	fn_mcs_error_logging($prices_result,'Error putting data with fn_mcs_put_prices with product_id = '.$data['product_id']);
	
	// Put product on main category
	fn_mcs_put_product_to_demo_category($data['product_id']);
	
	// Sync options
	$opt_result=fn_mcs_put_product_options($data['options']);
	fn_mcs_error_logging($opt_result,'Error putting data with fn_mcs_put_product_options with product_id = '.$data['product_id']);
	// Sync features
	$feat_result=fn_mcs_put_product_features($data['features']);
	fn_mcs_error_logging($feat_result,'Error putting data with fn_mcs_put_product_features with product_id = '.$data['product_id']);
	
	return array('return_msg' => 'The product was copied', 'msg_type'=>'N');
}

function fn_mcs_get_all_categories()
{
	$categories=db_get_array("SELECT * FROM ?:categories");
	if(empty($categories)){
		$msg='Error getting categories with fn_mcs_get_all_categories';
		write_log($msg);
		return array('return_msg'=>$msg, 'msg_type'=>'E');
	}
	$category_descriptions=db_get_array("SELECT * FROM ?:category_descriptions");
	fn_mcs_error_logging($category_descriptions,'Error getting data from category_descriptions table');
	$products_categories=db_get_array("SELECT * FROM ?:products_categories");
	fn_mcs_error_logging($products_categories,'Error getting data from products_categories table');
	
	$result=array(
		'categories'=>$categories,
		'category_descriptions'=>$category_descriptions,
		'products_categories'=>$products_categories
	);
	
	return $result;
}

function fn_mcs_put_all_categories($data)
{
	$result=array();
	foreach($data as $k=>$v){
		if(!empty($v)){
			if($k=='products_categories'){
				db_query("TRUNCATE TABLE  ?:products_categories");
			}
			$temp_result=fn_mcs_multi_db_replace_into($k,$v);
			if(in_array(false,$temp_result)){
				$result[]=false;
			}
		}
	}
	
	fn_update_product_count(array($GLOBALS['master_category_id']));
	
	if(in_array(false,$result)){
		return false;
	}
	
	return true;
}

function fn_mcs_get_parent_main_data($product_id)
{
	$sync_data=array();
	$result=array();
	$data = db_get_row("SELECT * FROM ?:products WHERE product_id = ?i", $product_id);
	if(!empty($data)){
		$sync_data['mcs_child_sync_product']=$data['mcs_child_sync_product'];
		$sync_data['mcs_child_sync_images']=$data['mcs_child_sync_images'];
		$sync_data['mcs_child_sync_files']=$data['mcs_child_sync_files'];
		unset($data['mcs_child_sync_product']);
		unset($data['mcs_child_sync_images']);
		unset($data['mcs_child_sync_files']);
		if($GLOBALS['sync_products_enabled']==false){
			$data['status'] = 'D';
		}
		$data['timestamp'] = $data['updated_timestamp'] = time();
		
		$result=array('product_data'=>$data,'sync_data'=>$sync_data);
	}
	return $result;
}

function fn_mcs_put_parent_main_data($data)
{
	$result=db_replace_into("products", $data);
	
	return $result;
}

function fn_mcs_get_descriptions($product_id)
{
	$result=array();
	$data = db_get_array("SELECT * FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $product_id,CART_LANGUAGE);

	foreach($data as $k=>$v){
		if(!empty($v['mcs_child_product'])){
			$v['product']=$v['mcs_child_product'];
		}
		if(!empty($v['mcs_child_full_description'])){
			$v['full_description']=$v['mcs_child_full_description'];
		}
		unset($v['mcs_child_product']);
		unset($v['mcs_child_full_description']);
		$result[$v['lang_code']]=$v;
	}

	return $result;
}

function fn_mcs_put_descriptions($data)
{
	$result=array();
	foreach($data as $k=>$v){
		if(!empty($v)){
			$temp_result=db_replace_into("product_descriptions",$v);
			if($temp_result===false){
				write_log("Error putting product description with product id=".$v['product_id']." and lang_code=".$v['lang_code']);
				$result[]=false;
			}
		}
	}
	
	if(in_array(false,$result)){
		return false;
	}
	
	return true;

}

function fn_mcs_get_prices($product_id)
{
	$data = db_get_array("SELECT * FROM ?:product_prices WHERE product_id = ?i", $product_id);
	return $data;
}

function fn_mcs_put_prices($data)
{
	$result=fn_mcs_multi_db_replace_into("product_prices", $data);
//	$result=db_replace_into("product_prices", $data);
	if(in_array(false, $result)){
		return false;
	}
	return $result;
}

function fn_mcs_put_product_to_demo_category($pid)
{
	$master_category=db_get_array("SELECT * FROM ?:categories WHERE category_id = ?i", $GLOBALS['master_category_id']);
	if(empty($master_category)){
		$master_category_data=array(
			'category_id'=>$GLOBALS['master_category_id'],
			'id_path'=>1,
			'company_id'=>$GLOBALS['company_id'],
			'product_details_layout'=>'default',
			'timestamp'=>time()
		);
		$master_category_discriptions=array(
			'category_id'=>$GLOBALS['master_category_id'],
			'lang_code'=>CART_LANGUAGE,
			'category'=>'Master Category'
		);
		db_replace_into("categories", $master_category_data);
		db_replace_into("category_descriptions", $master_category_discriptions);
	}
    $data = db_get_array("SELECT * FROM ?:products_categories WHERE product_id = ?i", $pid);
	if(empty($data)){
		$products_categories=array(
			'product_id'=>$pid,
			'category_id'=>$GLOBALS['master_category_id'],
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
			if(!in_array($option_id,$GLOBALS['option_ids'])){
				$GLOBALS['option_ids'][]=$option_id;
				fn_mcs_get_product_options_and_descriptions($option_id,$product_options,$product_options_descriptions);
				fn_mcs_get_product_option_variants_and_descriptions($option_id,$product_option_variants,$product_option_variants_descriptions);
			}
		}
	}
	$option_ids=db_get_array("SELECT option_id FROM ?:product_options WHERE product_id=$product_id");
	if(!empty($option_ids)){	
		foreach($option_ids as $k=>$v){
			$option_id=$v['option_id'];			
			fn_mcs_get_product_options_and_descriptions($option_id,$product_options,$product_options_descriptions);
			fn_mcs_get_product_option_variants_and_descriptions($option_id,$product_option_variants,$product_option_variants_descriptions);
		}
	}
	$product_options_exceptions=db_get_array("SELECT * FROM ?:product_options_exceptions WHERE product_id=$product_id");
	$product_options_inventory=db_get_array("SELECT * FROM ?:product_options_inventory WHERE product_id=$product_id");
	
	/*$product_options_inventory_images=fn_mcs_get_product_options_inventory_images($product_options_inventory);
	$product_option_variants_images=fn_mcs_get_product_option_variants_images($product_option_variants);*/
	
	$data=array(
		'product_global_option_links'=>$product_global_option_links,
		'product_options'=>$product_options,
		'product_options_descriptions'=>$product_options_descriptions,
		'product_options_exceptions'=>$product_options_exceptions,
		'product_options_inventory'=>$product_options_inventory,
		'product_option_variants'=>$product_option_variants,
		'product_option_variants_descriptions'=>$product_option_variants_descriptions,
		/*'product_options_inventory_images'=>$product_options_inventory_images,
		'product_option_variants_images'=>$product_option_variants_images*/
	);

	return $data;
}

function fn_mcs_get_product_options_and_descriptions($option_id,&$product_options,&$product_options_descriptions)
{
	$temp_options=db_get_row("SELECT * FROM ?:product_options WHERE option_id=$option_id");
	$temp_options_descriptions=db_get_array("SELECT * FROM ?:product_options_descriptions WHERE option_id=$option_id AND lang_code=?s",CART_LANGUAGE);
	
	array_push($product_options,$temp_options);
	foreach($temp_options_descriptions as $k=>$v){
		array_push($product_options_descriptions,$v);
	}
}

function fn_mcs_get_product_option_variants_and_descriptions($option_id,&$product_option_variants,&$product_option_variants_descriptions)
{
	$temp_option_variants=db_get_array("SELECT * FROM ?:product_option_variants WHERE option_id=$option_id");
	$temp_option_variants_descriptions=array();
	foreach($temp_option_variants as $k1=>$v1){
		$variant_id=$v1['variant_id'];
		$data=db_get_array("SELECT * FROM ?:product_option_variants_descriptions WHERE variant_id=$variant_id AND lang_code=?s",CART_LANGUAGE);
		foreach($data as $k2=>$v2){
			array_push($temp_option_variants_descriptions,$v2);
		}
	}
	
	foreach($temp_option_variants as $k2=>$v2){
		array_push($product_option_variants,$v2);
	}
	foreach($temp_option_variants_descriptions as $k2=>$v2){
		array_push($product_option_variants_descriptions,$v2);
	}
}

function fn_mcs_get_product_options_inventory_images($data)
{
	$product_options_inventory_images=array();
	foreach($data as $k=>$v){
		$object_id=$v['combination_hash'];
		$temp_product_options_inventory_images=fn_mcs_get_image_pairs($object_id, 'product_option');
		array_push($product_options_inventory_images,$temp_product_options_inventory_images[0]);
	}
	
	return $product_options_inventory_images;
}

function fn_mcs_get_product_option_variants_images($data)
{
	$product_option_variants_images=array();
	foreach($data as $k=>$v){
		$object_id=$v['variant_id'];
		$temp_product_option_variants_images=fn_mcs_get_image_pairs($object_id, 'variant_image');
		array_push($product_option_variants_images,$temp_product_option_variants_images[0]);
	}
	
	return $product_option_variants_images;
}

function fn_mcs_put_product_options($data)
{
	$result=array();
	foreach($data as $k=>$v){
		if($k!='product_options_inventory_images' && $k!='product_option_variants_images'){
			if(!empty($v)){
				$temp_result=fn_mcs_multi_db_replace_into($k,$v);
				if(in_array(false,$temp_result)){
					$result[]=false;
				}
			}
		}else{
			fn_mcs_put_image_pairs($v);
		}
	}

	if(in_array(false,$result)){
		return false;
	}
	
	return true;
}

function fn_mcs_get_product_features($product_id)
{
	$product_features_values=db_get_array("SELECT * FROM ?:product_features_values WHERE product_id=$product_id");
	$product_features=array();
	$product_features_descriptions=array();
	$product_feature_variants=array();
	$product_feature_variant_descriptions=array();
	$ult_objects_sharing=array();
	$feature_parents=array();
	
	$feature_variant_images=array();
	
	if(!empty($product_features_values)){
		foreach($product_features_values as $k=>$v){
			
			$feature_id=$v['feature_id'];
			
			if(!in_array($feature_id,$GLOBALS['feature_ids'])){
				$GLOBALS['feature_ids'][]=$feature_id;
			
				$temp_product_features=db_get_row("SELECT feature_id, feature_code, company_id, feature_type, parent_id, display_on_product, display_on_catalog, display_on_header, status, position, comparison FROM ?:product_features WHERE feature_id=$feature_id");
				array_push($product_features,$temp_product_features);
				
				$temp_product_features_descriptions=db_get_row("SELECT * FROM ?:product_features_descriptions WHERE feature_id=$feature_id AND lang_code=?s",CART_LANGUAGE);
				array_push($product_features_descriptions,$temp_product_features_descriptions);
				
				if($temp_product_features['parent_id']!=0){
					if(!in_array($temp_product_features['parent_id'],$feature_parents)){
						array_push($feature_parents,$temp_product_features['parent_id']);
					}
				}
				
				$temp_ult_objects_sharing=db_get_row("SELECT * FROM ?:ult_objects_sharing WHERE share_object_type='product_features' AND share_object_id=$feature_id");
				array_push($ult_objects_sharing,$temp_ult_objects_sharing);
			}
			
			$variant_id=$v['variant_id'];
			
			if(!in_array($variant_id,$GLOBALS['variant_ids'])){
				$GLOBALS['variant_ids'][]=$variant_id;
				
				if($variant_id!=0){
					$temp_product_feature_variants=db_get_row("SELECT * FROM ?:product_feature_variants WHERE variant_id=$variant_id");
					array_push($product_feature_variants,$temp_product_feature_variants);
				
					$temp_product_feature_variant_descriptions=db_get_row("SELECT * FROM ?:product_feature_variant_descriptions WHERE variant_id=$variant_id AND lang_code=?s",CART_LANGUAGE);
					array_push($product_feature_variant_descriptions,$temp_product_feature_variant_descriptions);
					
					$temp_feature_variant_images=fn_mcs_get_image_pairs($variant_id, 'feature_variant');
					if(!empty($temp_feature_variant_images)){
						array_push($feature_variant_images,$temp_feature_variant_images[0]);
					}
				}
			}
			
			/*$temp_feature_variant_images=fn_mcs_get_image_pairs($variant_id, 'feature_variant');
			array_push($feature_variant_images,$temp_feature_variant_images[0]);*/	
		}
		if(!empty($feature_parents)){
			foreach($feature_parents as $k=>$v){
				$temp_product_features=db_get_row("SELECT feature_id, feature_code, company_id, feature_type, parent_id, display_on_product, display_on_catalog, display_on_header, status, position, comparison FROM ?:product_features WHERE feature_id=$v");
				array_push($product_features,$temp_product_features);
				
				$temp_product_features_descriptions=db_get_row("SELECT * FROM ?:product_features_descriptions WHERE feature_id=$v AND lang_code=?s",CART_LANGUAGE);
				array_push($product_features_descriptions,$temp_product_features_descriptions);
				
				$temp_ult_objects_sharing=db_get_row("SELECT * FROM ?:ult_objects_sharing WHERE share_object_type='product_features' AND share_object_id=$v");
				array_push($ult_objects_sharing,$temp_ult_objects_sharing);
			}
		}
	
	}

	$data=array(
		'product_features'=>$product_features,
		'product_features_descriptions'=>$product_features_descriptions,
		'product_features_values'=>$product_features_values,
		'product_feature_variants'=>$product_feature_variants,
		'product_feature_variant_descriptions'=>$product_feature_variant_descriptions,
		'ult_objects_sharing'=>$ult_objects_sharing,
		'feature_variant_images'=>$feature_variant_images
	);
	
	return $data;
}

function fn_mcs_put_product_features($data)
{
	$result=array();
	foreach($data as $k=>$v){
		if($k!='feature_variant_images'){
			if(!empty($v)){
				$temp_result=fn_mcs_multi_db_replace_into($k,$v);
				if(in_array(false,$temp_result)){
					$result[]=false;
				}
			}
		}else{
			fn_mcs_put_image_pairs($v);
		}
	}
	
	if(in_array(false,$result)){
		return false;
	}
	
	return true;
}

function fn_mcs_get_image_pairs($object_id, $object_type, $lang_code = CART_LANGUAGE)
{
	$image_data=array();
    // Get all pairs
    $pair_data = db_get_hash_array("SELECT pair_id, image_id, detailed_id, type FROM ?:images_links WHERE object_id = ?i AND object_type = ?s", 'pair_id', $object_id, $object_type);

    if (empty($pair_data)) {
        return false;
    }

    $icons = $detailed = $pairs_data = array();

    foreach ($pair_data as $pair_id => $p_data) {
        if (!empty($p_data['image_id'])) {
            $icons[$pair_id] = fn_get_image($p_data['image_id'], $object_type, $lang_code, true);

            if (!empty($icons[$pair_id])) {
                $p_data['image_alt'] = empty($icons[$pair_id]['alt']) ? '' : $icons[$pair_id]['alt'];

                /*$tmp_name = fn_create_temp_file();
                Storage::instance('images')->export($icons[$pair_id]['relative_path'], $tmp_name);*/
/*TODO:get url from addon setting*/
				$tmp_name=fn_get_url_data($GLOBALS['mcs_parent_url']."/images/".$icons[$pair_id]['relative_path']);
				if(empty($tmp_name)){
					write_log('Error getting image '.$icons[$pair_id]['relative_path'].' from parent');
					continue;
				}
				$tmp_name=$tmp_name['path'];
                $name = fn_basename($icons[$pair_id]['image_path']);

                $icons[$pair_id] = array(
                    'path' => $tmp_name,
                    'size' => filesize($tmp_name),
                    'error' => 0,
                    'name' => $name,
                );
            }
        }
        if (!empty($p_data['detailed_id'])) {
            $detailed[$pair_id] = fn_get_image($p_data['detailed_id'], 'detailed', $lang_code, true);
            if (!empty($detailed[$pair_id])) {
                $p_data['detailed_alt'] = empty($detailed[$pair_id]['alt']) ? '' : $detailed[$pair_id]['alt'];

/*TODO:get url from addon setting*/								
				$tmp_name=fn_get_url_data($GLOBALS['mcs_parent_url']."/images/".$detailed[$pair_id]['relative_path']);
				if(empty($tmp_name)){
					write_log('Error getting image '.$detailed[$pair_id]['relative_path'].' from parent');
					continue;
				}
				$tmp_name=$tmp_name['path'];
				$img_id=$detailed[$pair_id]['image_id'];				

                $name = fn_basename($detailed[$pair_id]['image_path']);

				$detailed[$pair_id] = array(
                    'path' => $tmp_name,
                    'size' => filesize($tmp_name),
                    'error' => 0,
                    'name' => $name,
                );
            }
        }
		
        $pairs_data = array(
            $pair_id => array(
                'type' => $p_data['type'],
                'image_alt' => (!empty($p_data['image_alt'])) ? $p_data['image_alt'] : '',
                'detailed_alt' => (!empty($p_data['detailed_alt'])) ? $p_data['detailed_alt'] : '',
				'pair_id'=>$pair_id
            )
        );
		
		$temp_image_data=array(
			'icons'=>$icons,
			'detailed'=>$detailed,
			'pairs_data'=>$pairs_data,
			'object_id'=>$object_id,
			'object_type'=>$object_type,
			'lang_code'=>$lang_code,
			/*'img_data'=>$detailed[$pair_id],
			'img_id'=>$img_id*/
		);
		
		array_push($image_data,$temp_image_data);
    }

	return $image_data;
}

function fn_mcs_put_image_pairs($image_data)
{
	foreach($image_data as $k=>$v){
		//var_dump($v);	
		fn_mcs_update_image_pairs($v['icons'], $v['detailed'], $v['pairs_data'], $v['object_id'], $v['object_type'], array(), true, $v['lang_code']);
	}
}

function fn_mcs_update_image_pairs($icons, $detailed, $pairs_data, $object_id = 0, $object_type = 'product_lists', $object_ids = array (), $update_alt_desc = true, $lang_code = CART_LANGUAGE)
{
    $pair_ids = array();

    if (!empty($pairs_data)) {
        foreach ($pairs_data as $k => $p_data) {
            $data = array();
            $pair_id = !empty($p_data['pair_id']) ? $p_data['pair_id'] : 0;
            $o_id = !empty($object_id) ? $object_id : ((!empty($p_data['object_id'])) ? $p_data['object_id'] : 0);

            if ($o_id == 0 && !empty($object_ids[$k])) {
                $o_id = $object_ids[$k];
            } elseif (!empty($object_ids) && empty($object_ids[$k])) {
                continue;
            }

            // Check if main pair is exists
            if (empty($pair_id) && !empty($p_data['type']) && $p_data['type'] == 'M') {
                $pair_data = db_get_row("SELECT pair_id, image_id, detailed_id FROM ?:images_links WHERE object_id = ?i AND object_type = ?s AND type = ?s", $o_id, $object_type, $p_data['type']);
                $pair_id = !empty($pair_data['pair_id']) ? $pair_data['pair_id'] : 0;
            } else {
                $pair_data = db_get_row("SELECT image_id, detailed_id FROM ?:images_links WHERE pair_id = ?i", $pair_id);
                if (empty($pair_data)) {
                    //$pair_id = 0;
                }
            }
			
            // Update detailed image
            if (!empty($detailed[$k]) && !empty($detailed[$k]['size'])) {
                if (fn_get_image_size($detailed[$k]['path'])) {
                    $data['detailed_id'] = fn_update_image($detailed[$k], !empty($pair_data['detailed_id']) ? $pair_data['detailed_id'] : 0, 'detailed');
                }
            }else{
				$data['detailed_id']=0;	/*custom*/
			}

            // Update icon
            if (!empty($icons[$k]) && !empty($icons[$k]['size'])) {
                if (fn_get_image_size($icons[$k]['path'])) {
                    $data['image_id'] = fn_update_image($icons[$k], !empty($pair_data['image_id']) ? $pair_data['image_id'] : 0, $object_type);
                }
            }else{
				$data['image_id']=0;	/*custom*/
			}

            // Update alt descriptions
            if (((empty($data) && !empty($pair_id)) || !empty($data)) && $update_alt_desc == true) {
                $image_ids = array();
                if (!empty($pair_id)) {
                    $image_ids = db_get_row("SELECT image_id, detailed_id FROM ?:images_links WHERE pair_id = ?i", $pair_id);
                }

                $image_ids = fn_array_merge($image_ids, $data);
				
                $fields = array('detailed', 'image');
                foreach ($fields as $field) {
                    if (!empty($image_ids[$field . '_id']) && isset($p_data[$field . '_alt'])) {
                        if (!is_array($p_data[$field . '_alt'])) {
                            $_data = array (
                                'description' => empty($p_data[$field . '_alt']) ? '' : trim($p_data[$field . '_alt']),
                                'object_holder' => 'images'
                            );

                            // check, if this is new record, create new descriptions for all languages
                            $is_exists = db_get_field('SELECT object_id FROM ?:common_descriptions WHERE object_id = ?i AND lang_code = ?s AND object_holder = ?s', $image_ids[$field . '_id'], $lang_code, 'images');
                            if (!$is_exists) {
                                fn_create_description('common_descriptions', 'object_id', $image_ids[$field . '_id'], $_data);
                            } else {
                                db_query('UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND lang_code = ?s AND object_holder = ?s', $_data, $image_ids[$field . '_id'], $lang_code, 'images');
                            }
                        } else {
                            foreach ($p_data[$field . '_alt'] as $lc => $_v) {
                                $_data = array (
                                    'object_id' => $image_ids[$field . '_id'],
                                    'description' => empty($_v) ? '' : trim($_v),
                                    'lang_code' => $lc,
                                    'object_holder' => 'images'
                                );
                                db_query("REPLACE INTO ?:common_descriptions ?e", $_data);
                            }
                        }
                    }
                }
            }

            if (empty($data)) {
                continue;
            }

            // Pair is exists
            $data['position'] = !empty($p_data['position']) ? $p_data['position'] : 0; // set data position

            if (!empty($pair_id)) {
                //db_query("UPDATE ?:images_links SET ?u WHERE pair_id = ?i", $data, $pair_id);
				$d=array(
					'pair_id'=>$pair_id,
					'object_id'=>$o_id,
					'object_type'=>$object_type,
					'image_id'=>$data['image_id'],
					'detailed_id'=>$data['detailed_id'],
					'type'=>$p_data['type']					
				);
				$d_result=db_replace_into('images_links',$d);
				if($d_result===false){
					if(array_key_exists($k,$detailed)){
						write_log('Error putting data of image '.$detailed[$k]['name'].' in table image_links');
					}else{
						write_log('Error putting data of image '.$icons[$k]['name'].' in table image_links');
					}
				}
				

            } else {
                $data['type'] = $p_data['type']; // set link type
                $data['object_id'] = $o_id; // assign pair to object
                $data['object_type'] = $object_type;
                $pair_id = db_query("INSERT INTO ?:images_links ?e", $data);
            }

            $pairs_data[$k]['pair_id'] = $pair_id;

            $pair_ids[] = $pair_id;
        }
    }

//    fn_set_hook('mcs_update_image_pairs', $pair_ids, $icons, $detailed, $pairs_data, $object_id, $object_type, $object_ids, $update_alt_desc, $lang_code);

    return $pair_ids;
}

function fn_mcs_get_product_files($product_id)
{
	$product_file_descriptions=array();
	$product_file_folder_descriptions=array();
	
	$product_files = db_get_array("SELECT * FROM ?:product_files WHERE product_id = ?i", $product_id);
	$product_file_folders = db_get_array("SELECT * FROM ?:product_file_folders WHERE product_id = ?i", $product_id);
	
	foreach($product_files as $k=>$v){
		$temp = db_get_row("SELECT * FROM ?:product_file_descriptions WHERE file_id = ?i", $v['file_id']);
		array_push($product_file_descriptions,$temp);
	}
	
	foreach($product_file_folders as $k=>$v){
		$temp = db_get_row("SELECT * FROM ?:product_file_folder_descriptions WHERE folder_id = ?i", $v['folder_id']);
		array_push($product_file_folder_descriptions,$temp);
	}
	
	$data=array(
		'product_files'=>$product_files,
		'product_file_descriptions'=>$product_file_descriptions,
		'product_file_folders'=>$product_file_folders,
		'product_file_folder_descriptions'=>$product_file_folder_descriptions
	);
	//var_dump($data);
	
	return $data;
}

function fn_mcs_put_product_files($data,$product_id)
{
	foreach($data['product_files'] as $k=>$v){
		$product_file=$v;
/*TODO: get urls from addon settings*/
		$new_file=fn_get_url_data("http://localhost/vasilis/cscart_parent/var/downloads/".$product_file['product_id']."/".$product_file['file_path']);
		$new_preview=fn_get_url_data("http://localhost/vasilis/cscart_parent/var/downloads/".$product_file['product_id']."/".$product_file['preview_path']);
		
		$dir = $product_file['product_id'];
		$old_file = db_get_row('SELECT file_path, preview_path FROM ?:product_files WHERE product_id = ?i AND file_id = ?i', $product_file['product_id'], $product_file['file_id']);

		if (!empty($new_file) && !empty($old_file['file_path'])) {
			Storage::instance('downloads')->delete($dir . '/' . $old_file['file_path']);
		}

		if (!empty($new_preview) && !empty($old_file['preview_path'])) {
			Storage::instance('downloads')->delete($dir . '/' . $old_file['preview_path']);
		}
		
		$file_name=$dir."/".$product_file['file_path'];

		Storage::instance('downloads')->put($file_name, array(
			'file' => $new_file['path'],
			'overwrite' => true
		));
		
		$preview_name=$dir."/".$product_file['preview_path'];

		Storage::instance('downloads')->put($preview_name, array(
			'file' => $new_preview['path'],
			'overwrite' => true
		));
	}
	foreach($data as $k=>$v){
		fn_mcs_multi_db_replace_into($k,$v);
	}
}

function fn_mcs_get_all_taxes()
{
	$taxes=db_get_array("SELECT * FROM ?:taxes");
	if(empty($taxes)){
		$msg='Error getting taxes with fn_mcs_get_all_taxes';
		write_log($msg);
		return array('return_msg'=>$msg, 'msg_type'=>'E');
	}
	$tax_descriptions=db_get_array("SELECT * FROM ?:tax_descriptions");
	fn_mcs_error_logging($tax_descriptions,'Error getting tax_descriptions with fn_mcs_get_all_taxes');
	$tax_rates=db_get_array("SELECT * FROM ?:tax_rates");
	fn_mcs_error_logging($tax_rates,'Error getting tax_rates with fn_mcs_get_all_taxes');
	
	$result=array(
		'taxes'=>$taxes,
		'tax_descriptions'=>$tax_descriptions,
		'tax_rates'=>$tax_rates
	);
	
	return $result;
}

function fn_mcs_put_all_taxes($data)
{
	$result=array();
	foreach($data as $k=>$v){
		if(!empty($v)){
			$temp_result=fn_mcs_multi_db_replace_into($k,$v);
			if(in_array(false,$temp_result)){
				$result[]=false;
			}
		}
	}
	
	if(in_array(false,$result)){
		return false;
	}
	
	return true;
}

function fn_mcs_get_all_destinations()
{
	$destinations=db_get_array("SELECT * FROM ?:destinations");
	if(empty($destinations)){
		$msg='Error getting destinations with fn_mcs_get_all_destinations';
		write_log($msg);
		return array('return_msg'=>$msg, 'msg_type'=>'E');
	}
	$destination_descriptions=db_get_array("SELECT * FROM ?:destination_descriptions");
	fn_mcs_error_logging($destination_descriptions,'Error getting destination_descriptions with fn_mcs_get_all_destinations');
	$destination_elements=db_get_array("SELECT * FROM ?:destination_elements");
	fn_mcs_error_logging($destination_elements,'Error getting tax_rates with fn_mcs_get_all_destinations');
	
	$result=array(
		'destinations'=>$destinations,
		'destination_descriptions'=>$destination_descriptions,
		'destination_elements'=>$destination_elements
	);
	
	return $result;
}

function fn_mcs_put_all_destinations($data)
{
	$result=array();
	foreach($data as $k=>$v){
		if(!empty($v)){
			$temp_result=fn_mcs_multi_db_replace_into($k,$v);
			if(in_array(false,$temp_result)){
				$result[]=false;
			}
		}
	}
	
	if(in_array(false,$result)){
		return false;
	}
	
	return true;
}

function fn_mcs_get_all_states()
{
	$states=db_get_array("SELECT * FROM ?:states");
	if(empty($states)){
		$msg='Error getting states with fn_mcs_get_all_states';
		write_log($msg);
		return array('return_msg'=>$msg, 'msg_type'=>'E');
	}
	$state_descriptions=db_get_array("SELECT * FROM ?:state_descriptions");
	fn_mcs_error_logging($state_descriptions,'Error getting state_descriptions with fn_mcs_get_all_states');
	
	$result=array(
		'states'=>$states,
		'state_descriptions'=>$state_descriptions
	);
	
	return $result;
}

function fn_mcs_put_all_states($data)
{
	$result=array();
	foreach($data as $k=>$v){
		if(!empty($v)){
			$temp_result=fn_mcs_multi_db_replace_into($k,$v);
			if(in_array(false,$temp_result)){
				$result[]=false;
			}
		}
	}
	
	if(in_array(false,$result)){
		return false;
	}
	
	return true;
}

function fn_mcs_get_timestamp_of_sync()
{
	$last_sync_timestamp=0;
	// Connect to child db
	$db_result=fn_mcs_db_connect($GLOBALS['db_child_params']);
	// Check connection
	if(!$db_result['db_init'] || !$db_result['db_con']){
		write_log('Child database connection problem');
		return array('return_msg'=>'Database connection problem', 'msg_type'=>'E');
	}
	
	// Get last sync timestamp
	$timestamp_result=db_get_row("SELECT timestamp FROM ?:mcs_timestamp_of_sync");
	if(!empty($timestamp_result)){
		$last_sync_timestamp=$timestamp_result['timestamp'];
	}
	
	return $last_sync_timestamp;
}

function fn_mcs_error_logging($data,$msg)
{
	if(empty($data) || !$data){
		write_log($msg);
	}
}

function fn_mcs_read_log($filename='')
{
	$result=read_log($filename);
	if($result['status']==false){
		return array('return_msg'=>$result['message'], 'msg_type'=>'N');
	}
	$result=explode("\n",$result);
	return $result;
}

function fn_mcs_check_url($url)
{
	if(preg_match("@^http://@i",$url)){
		$url = preg_replace("@(http://)+@i",'http://',$url);
	}else{
		$url = 'http://'.$url;
	}
	return $url;
}

function fn_mcs_db_connect($parameters)
{
	$params = array(
	  'dbc_name' => $parameters['dbc_name'],
	  'table_prefix' => $parameters['table_prefix']
	);
	$db_init=db_initiate($parameters['server'], $parameters['username'], $parameters['password'], $parameters['db_name'], $params);
	$db_con=db_connect_to($params, $parameters['db_name']);
	
	$result=array(
		'db_init'=>$db_init,
		'db_con'=>$db_con
	);
	return $result;
}

function fn_mcs_multi_db_replace_into($table,$data)
{
	$result=array();
	foreach($data as $k=>$v){
		$tmp_result=db_replace_into($table,$v);
		if($tmp_result===false){
			$result[]=false;
		}else{
			$result[]=true;
		}
	}

	return $result;
}

// HOOK
function fn_mcs_child_shop_update_product_post($product_data, $product_id, $lang_code, $create)
{
	if(!$create){
		
		$image_result=db_get_array("SELECT * FROM ?:images_links WHERE object_id = ?i AND object_type = 'product'", $product_id);
		if(!empty($image_result)){
			return true;	
		}
		
		// Connect to parent db
		$db_result=fn_mcs_db_connect($GLOBALS['db_parent_params']);
		// Check connection
		if(!$db_result['db_init'] || !$db_result['db_con']){
			write_log('Parent database connection problem');
			return array('return_msg'=>'Database connection problem', 'msg_type'=>'E');
		}
		
		$data = db_get_row("SELECT mcs_child_sync_product, mcs_child_sync_images FROM ?:products WHERE product_id = ?i", $product_id);
		if(!empty($data)){
			if($data['mcs_child_sync_product']=='Y' && $data['mcs_child_sync_images']=='Y'){
				$images=fn_mcs_get_image_pairs($product_id,'product');
			}
		}
		
		if(!empty($images)){
			// Connect to child db
			$db_result=fn_mcs_db_connect($GLOBALS['db_child_params']);
			
			// Check connection
			if(!$db_result['db_init'] || !$db_result['db_con']){
				write_log('Child database connection problem');
				return array('return_msg'=>'Database connection problem', 'msg_type'=>'E');
			}
			
			fn_mcs_put_image_pairs($images);
		}
	}
}
