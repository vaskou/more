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
}


function fn_mcs_variant_product_stock_look_through_variants_update_combination($combination, $_data, $product_id, $amount, $options, $variants)
{

	$temp_amount=array();
	
	foreach($combination as $k=>$v){
		$result=db_get_row("SELECT * FROM ?:product_option_variants WHERE variant_id = ?s",$v);
		if($result['mcs_related_product']){
			$result=unserialize($result['mcs_related_product']);
			foreach($result as $k1=>$v1){
				if($v1['product_options']){
					$temp_amount[]=db_get_field('SELECT amount FROM ?:product_options_inventory WHERE combination_hash = ?i',$v1['comb_hash']);
				}else{
					$temp_amount[]=db_get_field('SELECT amount FROM ?:products WHERE product_id = ?i',$v1['product_id']);
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
			if($result['mcs_related_product']){
				$result=unserialize($result['mcs_related_product']);
				foreach($result as $k1=>$v1){
					if($v1['product_options']){
						$old_amount=db_get_field('SELECT amount FROM ?:product_options_inventory WHERE combination_hash = ?i',$v1['comb_hash']);
						$temp_amount=$old_amount - $difference;
						db_query("UPDATE ?:product_options_inventory SET amount = ?i WHERE combination_hash = ?i", $temp_amount, $v1['comb_hash']);
					}else{
						$old_amount=db_get_field('SELECT amount FROM ?:products WHERE product_id = ?i',$v1['product_id']);
						$temp_amount=$old_amount - $difference;
						db_query("UPDATE ?:products SET amount = ?i WHERE product_id = ?i", $temp_amount, $v1['product_id']);
					}
				}
			}
		}
		fn_rebuild_product_options_inventory($product_id, 50);
	}
}