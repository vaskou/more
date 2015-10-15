<?php

function fn_mcs_variant_product_stock_update_product_option_pre(&$option_data, $option_id, $lang_code)
{	
	$product_id=$option_data['product_id'];
	$tracking=db_get_field("SELECT tracking FROM ?:products WHERE product_id = ?i",$product_id);
	
	$variants=$option_data['variants'];

	foreach($variants as $k=>$v){
		if(array_key_exists('mcs_related_product',$v)){
			foreach($v['mcs_related_product'] as $k1=>$v1){
				if(!array_key_exists('product_options',$v1)){
					$v1['product_options']='';
				}
				$comb_hash=fn_generate_cart_id($v1['product_id'],array('product_options'=>$v1['product_options']));
				$v['mcs_related_product'][$k1]['comb_hash']=$comb_hash;
				$v['mcs_related_product'][$k1]['tracking']=$tracking;
			}
	
			$mcs_related_product=serialize($v['mcs_related_product']);
			$option_data['variants'][$k]['mcs_related_product']=$mcs_related_product;
		}else{
			$option_data['variants'][$k]['mcs_related_product']='';
		}
	}
}


function fn_mcs_variant_product_stock_look_through_variants_update_combination($combination, &$_data, $product_id, $amount, $options, $variants)
{
	
	$temp_amount=array();
	
	foreach($combination as $k=>$v){
		
		$result=db_get_row("SELECT * FROM ?:product_option_variants WHERE variant_id = ?s",$v);
		$result=unserialize($result['mcs_related_product']);
		if(!empty($result)){
			foreach($result as $k1=>$v1){
				$tracking=db_get_field("SELECT tracking FROM ?:products WHERE product_id = ?i",$v1['product_id']);
				//if(array_key_exists('product_options',$v1)){
				if($tracking=='O'){
					$temp=db_get_field('SELECT amount FROM ?:product_options_inventory WHERE combination_hash = ?i',$v1['comb_hash']);
					$temp_amount[]=(!empty($temp)) ? $temp : '0';
				}elseif($tracking=='B'){
					$temp=db_get_field('SELECT amount FROM ?:products WHERE product_id = ?i',$v1['product_id']);
					$temp_amount[]=(!empty($temp)) ? $temp : '0';
				}
			}
		}
	}
	
	if(!empty($temp_amount)){
		$_data['amount']=min($temp_amount);
	}
	
}

function fn_mcs_variant_product_stock_update_product_amount($new_amount, $product_id, $cart_id, $tracking)
{	
	
	$option_inventory=db_get_row('SELECT * FROM ?:product_options_inventory WHERE combination_hash = ?i',$cart_id);
	if($option_inventory){
		$difference=$option_inventory['amount'] - $new_amount;
		$temp=explode('_',$option_inventory['combination']);
		
		foreach($temp as $k=>$v){
			$id=$k / 2;
			settype($id,'integer');
			
			if(($k % 2) == 0 ){
				$variant[$id]['option_id']=$v;
			}else{
				$variant[$id]['variant_id']=$v;
			}
		}
		
		foreach($variant as $k=>$v){
			$result=db_get_row("SELECT * FROM ?:product_option_variants WHERE variant_id = ?s",$v['variant_id']);
			$result=unserialize($result['mcs_related_product']);
			if(!empty($result)){
				foreach($result as $k1=>$v1){
					$tracking=db_get_field("SELECT tracking FROM ?:products WHERE product_id = ?i",$v1['product_id']);
					if($tracking=='O'){
					//if($v1['product_options']){
						$old_amount=db_get_field('SELECT amount FROM ?:product_options_inventory WHERE combination_hash = ?i',$v1['comb_hash']);
						$temp_amount=$old_amount - $difference;
						db_query("UPDATE ?:product_options_inventory SET amount = ?i WHERE combination_hash = ?i", $temp_amount, $v1['comb_hash']);
					}elseif($tracking=='B'){
						$old_amount=db_get_field('SELECT amount FROM ?:products WHERE product_id = ?i',$v1['product_id']);
						$temp_amount=$old_amount - $difference;
						db_query("UPDATE ?:products SET amount = ?i WHERE product_id = ?i", $temp_amount, $v1['product_id']);
					}
				}
			}
		}

		/*fn_rebuild_product_options_inventory($product_id, 50);*/
		
	}
	if ($tracking == 'B') {
		db_query("UPDATE ?:products SET amount = ?i WHERE product_id = ?i", $new_amount, $product_id);
	} else {
		db_query("UPDATE ?:product_options_inventory SET amount = ?i WHERE combination_hash = ?i", $new_amount, $cart_id);
	}
	fn_mcs_rebuild_inventory();
}

function fn_mcs_rebuild_inventory()
{
	$temp_ids=array();
	
	$result=db_get_array("SELECT product_id FROM ?:product_options_inventory");
	foreach($result as $k=>$v){
		if(!in_array($v['product_id'],$temp_ids)){
			$temp_ids[]=$v['product_id'];
			fn_mcs_rebuild_product_options_inventory($v['product_id'], 50);
		}
	}
}

function fn_mcs_rebuild_product_options_inventory($product_id, $amount = 50)
{

    /**
     * Changes parameters for rebuilding product options inventory
     * @param int $product_id Product identifier
     * @param int $amount     Default combination amount
     */
    fn_set_hook('rebuild_product_options_inventory_pre', $product_id, $amount);

    $_options = db_get_fields("SELECT a.option_id FROM ?:product_options as a LEFT JOIN ?:product_global_option_links as b ON a.option_id = b.option_id WHERE (a.product_id = ?i OR b.product_id = ?i) AND a.option_type IN ('S','R','C') AND a.inventory = 'Y' ORDER BY position", $product_id, $product_id);
    if (empty($_options)) {
        return;
    }

    db_query("UPDATE ?:product_options_inventory SET temp = 'Y' WHERE product_id = ?i", $product_id);
    foreach ($_options as $k => $option_id) {
        $variants[$k] = db_get_fields("SELECT variant_id FROM ?:product_option_variants WHERE option_id = ?i ORDER BY position", $option_id);
    }
    $combinations = fn_mcs_look_through_variants($product_id, $amount, $_options, $variants);

    // Delete image pairs assigned to old combinations
    $hashes = db_get_fields("SELECT combination_hash FROM ?:product_options_inventory WHERE product_id = ?i AND temp = 'Y'", $product_id);
    foreach ($hashes as $v) {
        fn_delete_image_pairs($v, 'product_option');
    }

    // Delete old combinations
    db_query("DELETE FROM ?:product_options_inventory WHERE product_id = ?i AND temp = 'Y'", $product_id);

    /**
     * Adds additional actions after rebuilding product options inventory
     *
     * @param int $product_id Product identifier
     */
    fn_set_hook('rebuild_product_options_inventory_post', $product_id);

    return true;
}

function fn_mcs_look_through_variants($product_id, $amount, $options, $variants)
{
    /**
     * Changes params for getting product variants combinations
     *
     * @param int   $product_id Product identifier
     * @param int   $amount     Default combination amount
     * @param array $options    Array of options identifiers
     * @param array $variants   Array of option variants identifiers arrays in order corresponding to $options parameter
     * @param array $string     Array of combinations values
     * @param int   $cycle      Options and variants key
     */
    fn_set_hook('look_through_variants_pre', $product_id, $amount, $options, $variants);

    $position = 0;
    $hashes = array();
    $combinations = fn_get_options_combinations($options, $variants);

    if (!empty($combinations)) {
        foreach ($combinations as $combination) {

            $_data = array();
            $_data['product_id'] = $product_id;

            $_data['combination_hash'] = fn_generate_cart_id($product_id, array('product_options' => $combination));

            if (array_search($_data['combination_hash'], $hashes) === false) {
                $hashes[] = $_data['combination_hash'];
                $_data['combination'] = fn_get_options_combination($combination);
                $_data['position'] = $position++;

                $old_data = db_get_row(
                    "SELECT combination_hash, amount, product_code "
                    . "FROM ?:product_options_inventory "
                    . "WHERE product_id = ?i AND combination_hash = ?i AND temp = 'Y'",
                    $product_id, $_data['combination_hash']
                );
				
                $_data['amount'] = isset($old_data['amount']) ? $old_data['amount'] : $amount;
                $_data['product_code'] = isset($old_data['product_code']) ? $old_data['product_code'] : '';

                /**
                 * Changes data before update combination
                 *
                 * @param array $combination Array of combination data
                 * @param array $data Combination data to update
                 * @param int $product_id Product identifier
                 * @param int $amount Default combination amount
                 * @param array $options Array of options identifiers
                 * @param array $variants Array of option variants identifiers arrays in order corresponding to $options parameter
                 */
                fn_set_hook('look_through_variants_update_combination', $combination, $_data, $product_id, $amount, $options, $variants);

                db_query("REPLACE INTO ?:product_options_inventory ?e", $_data);
                $combinations[] = $combination;
            }
            /*echo str_repeat('. ', count($combination));*/
        }
    }

    /**
     * Changes the product options combinations
     *
     * @param array $combination Array of combinations
     * @param int   $product_id  Product identifier
     * @param int   $amount      Default combination amount
     * @param array $options     Array of options identifiers
     * @param array $variants    Array of option variants identifiers arrays in order corresponding to $options parameter
     */
    fn_set_hook('look_through_variants_post', $combinations, $product_id, $amount, $options, $variants);

    return $combinations;
}