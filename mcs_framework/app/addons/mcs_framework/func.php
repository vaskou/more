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
use Tygh\BlockManager;
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



function fn_mcs_framework_render_blocks($grid, $block, $this, $content)
{
	if(AREA=='C'){
		
		$tpl_vars=Registry::get('view')->{'tpl_vars'};
		$deviceType=$tpl_vars['mobiledetect']->{'value'}['deviceType'];
		$mcs_framework=$tpl_vars['settings']->{'value'}['mcs_framework'];
		
		if($mcs_framework['mcs_mobile_devices']['mcs_mobile_devices_block_detection']=='Y'){
			if(is_array($block['properties'])){
				if(array_key_exists('devices',$block['properties'])){
					
					if($deviceType=='computer' && !array_key_exists('computer',$block['properties']['devices'])){
						$block['status']='D';
					}
					if($deviceType=='tablet' && !array_key_exists('tablet',$block['properties']['devices'])){
						$block['status']='D';
					}
					if($deviceType=='phone' && !array_key_exists('phone',$block['properties']['devices'])){
						$block['status']='D';
					}
				}
			}
		}
		//print_r($deviceType);
		//print_r($block);
		
	}
}

function fn_mcs_framework_get_grids_post($grids)
{
	if(AREA=='C'){
		
		$tpl_vars=Registry::get('view')->{'tpl_vars'};
		$deviceType=$tpl_vars['mobiledetect']->{'value'}['deviceType'];
		$mcs_framework=$tpl_vars['settings']->{'value'}['mcs_framework'];
		
		if($mcs_framework['mcs_mobile_devices']['mcs_mobile_devices_grid_detection']=='Y'){
		
			foreach ($grids as &$value) {
				foreach ($value as &$v) {
					if($deviceType=='computer' && $v['computer']=='N'){
						$v['status']='D';
					}
					if($deviceType=='tablet' && $v['tablet']=='N'){
						$v['status']='D';
					}
					if($deviceType=='phone' && $v['phone']=='N'){
						$v['status']='D';
					}
					
					 /*print '<pre>';
					 print_r ($v);
					 print '</pre>';*/
				}		
				
			}
		}
	}
}