<?php

use Tygh\Registry;
use Tygh\Storage;
use Tygh\BlockManager\Block;
use Tygh\BlockManager\ProductTabs;
use Tygh\Navigation\LastView;
use Tygh\Languages\Languages;

function fn_sync_product($product_id)
{
    /**
     * Adds additional actions before product cloning
     *
     * @param int $product_id Original product identifier
     */
    fn_set_hook('sync_product_pre', $product_id);

	fn_db_connect_parent();
	// Clone main data
    $main_data=fn_get_parent_main_data($product_id);
	// Clone descriptions
	$descriptions=fn_get_descriptions($product_id);
	// Clone prices
	$prices=fn_get_prices($product_id);
	
	
	fn_db_connect_child();
	// Clone main data
    $pid=fn_put_parent_main_data($main_data);
	// Clone descriptions
	fn_put_descriptions($descriptions, $pid);
	// Clone prices
	fn_put_prices($prices, $pid);
	// Put product on main category
	fn_put_product_categories($main_data,$pid);
	

    

    // Clone product options
   /* fn_clone_product_options($product_id, $pid);

    // Clone global linked options
    $gl_options = db_get_fields("SELECT option_id FROM ?:product_global_option_links WHERE product_id = ?i", $product_id);
    if (!empty($gl_options)) {
        foreach ($gl_options as $v) {
            db_query("INSERT INTO ?:product_global_option_links (option_id, product_id) VALUES (?i, ?i)", $v, $pid);
        }
    }

    // Clone product features
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

function fn_get_parent_main_data($product_id)
{
	$data = db_get_row("SELECT * FROM ?:products WHERE product_id = ?i", $product_id);
	$data['product_cid']=$data['product_id'];
    unset($data['product_id']);
    $data['status'] = 'D';
    $data['timestamp'] = $data['updated_timestamp'] = time();
	
	return $data;
}

function fn_put_parent_main_data($data)
{
	//$pid = db_query("INSERT INTO ?:products ?e", $data);
	$pid=db_replace_into("products", $data);
	
	return $pid;
}

function fn_get_descriptions($product_id)
{
	$data = db_get_array("SELECT * FROM ?:product_descriptions WHERE product_id = ?i", $product_id);
	return $data;
}

function fn_put_descriptions($data, $pid)
{
	foreach ($data as $v) {
        $v['product_id'] = $pid;
    //    db_query("INSERT INTO ?:product_descriptions ?e", $v);
		db_replace_into("product_descriptions", $v);
    }
}

function fn_get_prices($product_id)
{
	$data = db_get_array("SELECT * FROM ?:product_prices WHERE product_id = ?i", $product_id);
	return $data;
}

function fn_put_prices($data, $pid)
{
	foreach ($data as $v) {
        $v['product_id'] = $pid;
        unset($v['price_id']);
    //    db_query("INSERT INTO ?:product_prices ?e", $v);
		db_replace_into("product_prices", $v);
    }
}

function fn_put_product_categories($data,$pid)
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

function fn_get_product_options()
{
	$product_global_option_links=db_get_array("SELECT * FROM ?:product_global_option_links");
	$product_options=db_get_array("SELECT * FROM ?:product_options");
	$product_options_descriptions=db_get_array("SELECT * FROM ?:product_options_descriptions");
	$product_options_exceptions=db_get_array("SELECT * FROM ?:product_options_exceptions");
	$product_options_inventory=db_get_array("SELECT * FROM ?:product_options_inventory");
	$product_options_variants=db_get_array("SELECT * FROM ?:product_options_variants");
	$product_options_variants_descriptions=db_get_array("SELECT * FROM ?:product_options_variants_descriptions");
	
	$data=array(
		'product_global_option_links'=>$product_global_option_links,
		'product_options'=>$product_options,
		'product_options_descriptions'=>$product_options_descriptions,
		'product_options_exceptions'=>$product_options_exceptions,
		'product_options_inventory'=>$product_options_inventory,
		'product_options_variants'=>$product_options_variants,
		'product_options_variants_descriptions'=>$product_options_variants_descriptions
	);
	
	return $data;
}

function fn_get_product_options($data)
{
	
}

function fn_db_connect_parent()
{
	$params = array(
	  'dbc_name' => 'parent',
	  'table_prefix' => 'cscart_'
	);
	db_initiate('localhost', 'vaskou', 'vaskou1!', 'cscart_parent', $params);
	db_connect_to($params, 'cscart_master');
}

function fn_db_connect_child()
{
	$params = array(
	  'dbc_name' => 'child',
	  'table_prefix' => 'cscart_'
	);
	db_initiate('localhost', 'vaskou', 'vaskou1!', 'cscart_child', $params);
	db_connect_to($params, 'cscart_child');
}