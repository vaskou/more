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
	// Sync images
	$images=fn_mcs_get_image_pairs($product_id,'product');
	// Sync files
	$files=fn_mcs_get_product_files($product_id);
	
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
	// Sync images
	fn_mcs_put_image_pairs($images);
	// Sync files
	fn_mcs_put_product_files($files,$product_id);
	
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

    // Clone product files*/
    //fn_clone_product_files($product_id, $pid);

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
	$ult_objects_sharing=db_get_array("SELECT * FROM ?:ult_objects_sharing WHERE share_object_type='product_features'");
	
	$data=array(
		'product_features'=>$product_features,
		'product_features_descriptions'=>$product_features_descriptions,
		'product_features_values'=>$product_features_values,
		'product_feature_variants'=>$product_feature_variants,
		'product_feature_variant_descriptions'=>$product_feature_variant_descriptions,
		'ult_objects_sharing'=>$ult_objects_sharing
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
	$ult_objects_sharing=array();
	$feature_parents=array();
	
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
		
		$temp_ult_objects_sharing=db_get_array("SELECT * FROM ?:ult_objects_sharing WHERE share_object_type='product_features' AND share_object_id=$feature_id");
		array_push($ult_objects_sharing,$temp_ult_objects_sharing[0]);
		
		if($temp_product_features[0]['parent_id']!=0){
			if(!in_array($temp_product_features[0]['parent_id'],$feature_parents)){
				array_push($feature_parents,$temp_product_features[0]['parent_id']);
			}
		}	
	}
	
	foreach($feature_parents as $k=>$v){
		$temp_product_features=db_get_array("SELECT feature_id, feature_code, company_id, feature_type, parent_id, display_on_product, display_on_catalog, display_on_header, status, position, comparison FROM ?:product_features WHERE feature_id=$v");
		array_push($product_features,$temp_product_features[0]);
		
		$temp_product_features_descriptions=db_get_array("SELECT * FROM ?:product_features_descriptions WHERE feature_id=$v");
		array_push($product_features_descriptions,$temp_product_features_descriptions[0]);
		
		$temp_ult_objects_sharing=db_get_array("SELECT * FROM ?:ult_objects_sharing WHERE share_object_type='product_features' AND share_object_id=$v");
		array_push($ult_objects_sharing,$temp_ult_objects_sharing[0]);
	}

	$data=array(
		'product_features'=>$product_features,
		'product_features_descriptions'=>$product_features_descriptions,
		'product_features_values'=>$product_features_values,
		'product_feature_variants'=>$product_feature_variants,
		'product_feature_variant_descriptions'=>$product_feature_variant_descriptions,
		'ult_objects_sharing'=>$ult_objects_sharing
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

                $tmp_name = fn_create_temp_file();
                Storage::instance('images')->export($icons[$pair_id]['relative_path'], $tmp_name);
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
				$tmp_name=fn_get_url_data("http://localhost/vasilis/cscart_parent/images/".$detailed[$pair_id]['relative_path']);
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
			'img_data'=>$detailed[$pair_id],
			'img_id'=>$img_id
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
            }

            // Update icon
            if (!empty($icons[$k]) && !empty($icons[$k]['size'])) {
                if (fn_get_image_size($icons[$k]['path'])) {
                    $data['image_id'] = fn_update_image($icons[$k], !empty($pair_data['image_id']) ? $pair_data['image_id'] : 0, $object_type);
                }
            }else{
				$data['image_id']=0;
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
				try{
				db_replace_into('images_links',$d);
				}
				catch(Exception $e){
					 echo 'Caught exception: ',  $e->getMessage(), "\n";
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
		$temp = db_get_array("SELECT * FROM ?:product_file_descriptions WHERE file_id = ?i", $v['file_id']);
		array_push($product_file_descriptions,$temp[0]);
	}
	
	foreach($product_file_folders as $k=>$v){
		$temp = db_get_array("SELECT * FROM ?:product_file_folder_descriptions WHERE folder_id = ?i", $v['folder_id']);
		array_push($product_file_folder_descriptions,$temp[0]);
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

function fn_mcs_db_connect_parent()
{
/*TODO: get params from addon settings*/
	$params = array(
	  'dbc_name' => 'parent',
	  'table_prefix' => 'cscart_'
	);
	db_initiate('localhost', 'vaskou', 'vaskou1!', 'cscart_parent', $params);
	db_connect_to($params, 'cscart_parent');
}

function fn_mcs_db_connect_child()
{
/*TODO: get params from addon settings*/
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