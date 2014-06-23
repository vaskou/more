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
	$data['product_cid']=$data['product_id'];
    unset($data['product_id']);
    $data['status'] = 'D';
    $data['timestamp'] = $data['updated_timestamp'] = time();
	
	return $data;
}

function fn_mcs_put_parent_main_data($data)
{
	//$pid = db_query("INSERT INTO ?:products ?e", $data);
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
    //    db_query("INSERT INTO ?:product_descriptions ?e", $v);
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
    //    db_query("INSERT INTO ?:product_prices ?e", $v);
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
	$product_options=db_get_array("SELECT * FROM ?:product_options WHERE product_id=$product_id");
	$product_options_exceptions=db_get_array("SELECT * FROM ?:product_options_exceptions WHERE product_id=$product_id");
	$product_options_inventory=db_get_array("SELECT * FROM ?:product_options_inventory WHERE product_id=$product_id");
	
	$data=array(
		'product_global_option_links'=>$product_global_option_links,
		'product_options'=>$product_options,
		'product_options_exceptions'=>$product_options_exceptions,
		'product_options_inventory'=>$product_options_inventory,
	);
	
	return $data;
}

function fn_mcs_put_all_product_options($data)
{
	try{
		$data=fn_mcs_match_all_options_product_id($data);
		/*fn_mcs_multi_db_replace_into("product_global_option_links", $data['product_global_option_links']);
		fn_mcs_multi_db_replace_into("product_options", $data['product_options']);
		fn_mcs_multi_db_replace_into("product_options_descriptions", $data['product_options_descriptions']);
		fn_mcs_multi_db_replace_into("product_options_exceptions", $data['product_options_exceptions']);
		fn_mcs_multi_db_replace_into("product_options_inventory", $data['product_options_inventory']);
		fn_mcs_multi_db_replace_into("product_option_variants", $data['product_option_variants']);
		fn_mcs_multi_db_replace_into("product_option_variants_descriptions", $data['product_option_variants_descriptions']);*/
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
	$data=fn_mcs_match_options_product_id($data,$product_id);
	foreach($data as $k=>$v){
		fn_mcs_multi_db_replace_into($k,$v);
	}
}

function fn_mcs_match_all_options_product_id($data)
{
	$mapped_products_ids=db_get_array("SELECT product_id, product_cid FROM ?:products");
	foreach($mapped_products_ids as $k=>$v){
		foreach($data['product_global_option_links'] as $k1=>$v1){
			if($v['product_cid']==$v1['product_id']){
				$data['product_global_option_links'][$k1]['product_id']=$v['product_id'];
			}
		}
		foreach($data['product_options'] as $k2=>$v2){
			if($v['product_cid']==$v2['product_id']){
				$data['product_options'][$k2]['product_id']=$v['product_id'];
			}
		}
		foreach($data['product_options_exceptions'] as $k3=>$v3){
			if($v['product_cid']==$v3['product_id']){
				$data['product_options_exceptions'][$k3]['product_id']=$v['product_id'];
			}
		}
		foreach($data['product_options_inventory'] as $k4=>$v4){
			if($v['product_cid']==$v4['product_id']){
				$data['product_options_inventory'][$k4]['product_id']=$v['product_id'];
			}
		}
	}
	
	return $data;
}

function fn_mcs_match_options_product_id($data,$product_id)
{
	$mapped_products_ids=db_get_array("SELECT product_id, product_cid FROM ?:products WHERE product_cid=$product_id");
	foreach($mapped_products_ids as $k=>$v){
		foreach($data['product_global_option_links'] as $k1=>$v1){
			if($v['product_cid']==$v1['product_id']){
				$data['product_global_option_links'][$k1]['product_id']=$v['product_id'];
			}
		}
		foreach($data['product_options'] as $k2=>$v2){
			if($v['product_cid']==$v2['product_id']){
				$data['product_options'][$k2]['product_id']=$v['product_id'];
			}
		}
		foreach($data['product_options_exceptions'] as $k3=>$v3){
			if($v['product_cid']==$v3['product_id']){
				$data['product_options_exceptions'][$k3]['product_id']=$v['product_id'];
			}
		}
		foreach($data['product_options_inventory'] as $k4=>$v4){
			if($v['product_cid']==$v4['product_id']){
				$data['product_options_inventory'][$k4]['product_id']=$v['product_id'];
			}
		}
	}
	
	return $data;
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

function fn_mcs_put_all_product_features($data)
{
	try{
		$data=fn_mcs_match_all_product_features($data);
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

function fn_mcs_match_all_product_features($data)
{
	try{
		$mapped_products_ids=db_get_array("SELECT product_id, product_cid FROM ?:products");
		foreach($mapped_products_ids as $k=>$v){
			foreach($data['product_features_values'] as $k1=>$v1){
				if($v['product_cid']==$v1['product_id']){
					$data['product_features_values'][$k1]['product_id']=$v['product_id'];
				}
			}
		}
	
		return $data;
	}
	catch(Exception $e){
		echo 'Caught exception: '.$e->getMessage()."\n";
		return false;
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