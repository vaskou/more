<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_mcs_seperate_products_by_vendor($products)
{
	$vendor_ids=array();
	$vendors=array();
	$vendor_products=array();
	
	foreach($products as $product){
		$vendor_products[$product['company_id']][$product['cart_id']]=$product;	
		if(!in_array($product['company_id'],$vendor_ids)){
			$vendor_ids[]=$product['company_id'];
		}
	}
	
	foreach($vendor_ids as $vid){
		$vendors[$vid]=fn_get_company_data($vid);
		if (fn_allowed_for('MULTIVENDOR')) {
			if (!empty($vid)) {
				$vendors[$vid]['logos'] = fn_get_logos($vid);
			}
	
			//Registry::get('view')->assign('logo_types', fn_get_logo_types(true));
		}
	}
	
	return array($vendor_products,$vendors);
}

function fn_mcs_vendor_wishlist_view($vendor_id,$mcs_variant_id)
{
	$_SESSION['wishlist'] = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : array();
	$wishlist = & $_SESSION['wishlist'];
	$_SESSION['continue_url'] = isset($_SESSION['continue_url']) ? $_SESSION['continue_url'] : '';
	$auth = & $_SESSION['auth'];
	
	$products = !empty($wishlist['products']) ? $wishlist['products'] : array();
    $extra_products = array();
    $wishlist_is_empty = fn_cart_is_empty($wishlist);

    if (!empty($products)) {
        foreach ($products as $k => $v) {
            $_options = array();
            $extra = $v['extra'];
            if (!empty($v['product_options'])) {
                $_options = $v['product_options'];
            }
            $products[$k] = fn_get_product_data($v['product_id'], $auth, CART_LANGUAGE, '', true, true, true, false, false, true, false, true);

            if (empty($products[$k])) {
                unset($products[$k], $wishlist['products'][$k]);
                continue;
            }
            $products[$k]['extra'] = empty($products[$k]['extra']) ? array() : $products[$k]['extra'];
            $products[$k]['extra'] = array_merge($products[$k]['extra'], $extra);

            if (isset($products[$k]['extra']['product_options']) || $_options) {
                $products[$k]['selected_options'] = empty($products[$k]['extra']['product_options']) ? $_options : $products[$k]['extra']['product_options'];
            }

            if (!empty($products[$k]['selected_options'])) {
                $options = fn_get_selected_product_options($v['product_id'], $v['product_options'], CART_LANGUAGE);
                foreach ($products[$k]['selected_options'] as $option_id => $variant_id) {
                    foreach ($options as $option) {
                        if ($option['option_id'] == $option_id && !in_array($option['option_type'], array('I', 'T', 'F')) && empty($variant_id)) {
                            $products[$k]['changed_option'] = $option_id;
                            break 2;
                        }
                    }
                }
            }
            $products[$k]['display_subtotal'] = $products[$k]['price'] * $v['amount'];
            $products[$k]['display_amount'] = $v['amount'];
            $products[$k]['cart_id'] = $k;
            /*$products[$k]['product_options'] = fn_get_selected_product_options($v['product_id'], $v['product_options'], CART_LANGUAGE);
            $products[$k]['price'] = fn_apply_options_modifiers($v['product_options'], $products[$k]['price'], 'P');*/
            if (!empty($products[$k]['extra']['parent'])) {
                $extra_products[$k] = $products[$k];
                unset($products[$k]);
                continue;
            }
        }
    }

    fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options' => true, 'get_discounts' => true));

	$temp_products=array();
	
	$addons=Registry::get('addons');
	$mcs_feature_id=$addons['mcs_getaquote']['mcs_features_list'];
	
	foreach($products as $key=>$product){
		if($product['company_id']==$vendor_id){
			foreach($product['header_features'] as $feature){
				if($feature['feature_id']==$mcs_feature_id && $feature['variant_id']==$mcs_variant_id){
					$temp_products[$key]=$product;
				}
			}
		}
	}
	$products=$temp_products;

    Registry::get('view')->assign('show_qty', true);
    Registry::get('view')->assign('wishlist_products', $products);
    Registry::get('view')->assign('wishlist_is_empty', $wishlist_is_empty);
    Registry::get('view')->assign('extra_products', $extra_products);
    Registry::get('view')->assign('wishlist', $wishlist);
    Registry::get('view')->assign('continue_url', $_SESSION['continue_url']);
	
	/*list($vendor_products,$vendors)=fn_mcs_seperate_products_by_vendor($products);
	
	Registry::get('view')->assign('vendor_products', $vendor_products);
	Registry::get('view')->assign('vendors', $vendors);*/
}