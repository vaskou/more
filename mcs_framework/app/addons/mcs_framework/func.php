<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Registry;
use Tygh\BlockManager\Block;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_get_brands($params, $lang_code = CART_LANGUAGE)
{
    $params['feature_id']=18;
	$params['feature_type']="E";
    $params['get_images'] = true;
	
    list($brands, $search) = fn_get_product_feature_variants($params,0, DESCR_SL);
	
    return array($brands, $params);
}

function fn_get_brand_name($brand_id)
{
	list($brands, )=fn_get_brands();
	$brand_name=$brands[$brand_id]['variant'];
	
	return $brand_name;
}

function fn_get_selected_brands($params)
{
	$sel_brands=array();
	list($brands, )=fn_get_brands();
	
	$ids=explode(",",$params['item_ids']);
	
	foreach($ids as $id){
		array_push($sel_brands, $brands[$id]);
	}
	
	return array($sel_brands);
}