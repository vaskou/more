<?php

use Tygh\Registry;
use Tygh\Mailer;

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
	
//Wishlist frontend controller code
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

//mcs_getaquote code
	$temp_products=array();
	
	if($vendor_id>0){
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
	}
	$products=$temp_products;
	if(empty($products)){
		$wishlist_is_empty=true;
	}
	
    Registry::get('view')->assign('show_qty', true);
    Registry::get('view')->assign('wishlist_products', $products);
    Registry::get('view')->assign('wishlist_is_empty', $wishlist_is_empty);
    Registry::get('view')->assign('extra_products', $extra_products);
    Registry::get('view')->assign('wishlist', $wishlist);
    Registry::get('view')->assign('continue_url', $_SESSION['continue_url']);
	
	Registry::get('view')->assign('mcs_variant_id', $mcs_variant_id);
	Registry::get('view')->assign('mcs_vendor_id', $vendor_id);
	/*list($vendor_products,$vendors)=fn_mcs_seperate_products_by_vendor($products);
	
	Registry::get('view')->assign('vendor_products', $vendor_products);
	Registry::get('view')->assign('vendors', $vendors);*/
}

function fn_mcs_send_form($page_id, $form_values)
{
    $result = false;
    if (!empty($form_values)) {
        $page_data = fn_get_page_data($page_id);

        if (!empty($page_data['form']['elements'])) {

            $result = true;
            $attachments = array();
            $fb_files = fn_filter_uploaded_data('fb_files');

            if (!empty($fb_files)) {
                foreach ($fb_files as $k => $v) {
                    $attachments[$v['name']] = $v['path'];
                    $form_values[$k] = $v['name'];
                }
            }

            $max_length = 0;

            $sender = '';
            foreach ($page_data['form']['elements'] as $k => $v) {
                if (($l = strlen($v['description'])) > $max_length) {
                    $max_length = $l;
                }

                // Check if sender email exists
                if ($v['element_type'] == FORM_EMAIL) {
                    $sender = $form_values[$k];
                }

                if ($v['element_type'] == FORM_DATE) {
                    $form_values[$k] = fn_parse_date($form_values[$k]);
                }

                if ($v['element_type'] == FORM_REFERER) {
                    $form_values[$k] = $_SESSION['auth']['referer'];
                }

                if ($v['element_type'] == FORM_IP_ADDRESS) {
                    $ip = fn_get_ip();
                    $form_values[$k] = $ip['host'];
                }
            }
            $max_length += 2;

            if ($result == true) {

                $from = 'default_company_support_department';
                $is_html = true;
				
				$page_data['form']['elements']['products']=array(
					'element_id'=>'products',
					'page_id' =>  $page_data['page_id'],
					'parent_id' =>  $page_data['parent_id'],
					'element_type' =>  'products',
					'value' =>  '',
					'position' =>  '0',
					'required' =>  'Y',
					'status' =>  'A' ,
					'description' =>  'products',
				);
				
				//$form_values['mcs_vendor_id'];
				$vendor_email=db_get_field("SELECT email FROM ?:companies WHERE company_id=?i",$form_values['mcs_vendor_id']);
				$page_data['form']['general'][FORM_RECIPIENT]=array($page_data['form']['general'][FORM_RECIPIENT],$vendor_email);
				
				//var_dump($page_data);
				//var_dump($form_values);
				//die;
                fn_set_hook('mcs_send_form', $page_data, $form_values, $result, $from, $sender, $attachments, $is_html);

                if ($result == true) {
                    Mailer::sendMail(array(
                        'to' => $page_data['form']['general'][FORM_RECIPIENT],
                        'from' => $from,
                        'reply_to' => $sender,
                        'data' => array(
                            'max_length' => $max_length,
                            'elements' => $page_data['form']['elements'],
                            'form_title' => $page_data['page'],
                            'form_values' => $form_values,
                        ),
                        'attachments' => $attachments,
                        'tpl' => 'addons/mcs_getaquote/form.tpl',
                        'is_html' => $is_html
                    ), 'A');
                }
            }
        }
    }

    return $result;
}

function fn_mcs_getaquote_send_form($page_data, $form_values, $result, $from, $sender, $attachments, $is_html)
{
	if(isset($form_values['mcs_form_type'])){
		$result=false;
		return $result;
	}
}