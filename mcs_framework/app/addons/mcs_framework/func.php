<?php

use Tygh\Registry;
use Tygh\BlockManager;
use Tygh\BlockManager\Block;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/********************* Brands and Brands Scroller ************************/

function fn_get_brands($feature_id, $lang_code = CART_LANGUAGE)
{
	//var_dump($feature_id);
    $params['feature_id']=$feature_id;
	$params['feature_type']="E";
    $params['get_images'] = true;
	
    list($brands, $search) = fn_get_product_feature_variants($params,0, DESCR_SL);
	
    return array($brands, $params);
}

function fn_get_brand_name($brand_id,$feature_id)
{
	list($brands, )=fn_get_brands($feature_id);
	$brand_name=$brands[$brand_id]['variant'];
	
	return $brand_name;
}

function fn_get_selected_brands($params)
{
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$mcs_framework=$tpl_vars['settings']->{'value'}['mcs_framework'];
	$feature_id=$mcs_framework['mcs_product']['mcs_product_brand_feature'];
	/*var_dump($params);*/
	$sel_brands=array();
	list($brands, )=fn_get_brands($feature_id);

	if($params['has_limit']){
		$br_count=count($brands);
		$limit=$params['limit'];
		if($br_count < $limit)
		{
			$ids=array_rand($brands,$br_count);
		}else{
			$ids=array_rand($brands,$limit);
		}
	}else{
		$ids=explode(",",$params['item_ids']);
	}
	
	foreach($ids as $id){
		array_push($sel_brands, $brands[$id]);
	}
	
	return array($sel_brands);
}

function fn_mcs_product_get_features()
{
   	return db_get_hash_single_array("SELECT a.feature_id, b.description FROM ?:product_features as a LEFT JOIN ?:product_features_descriptions as b ON a.feature_id=b.feature_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.status='A' AND a.feature_type='E' ORDER BY b.description", array('feature_id', 'description'));
}

function fn_mcs_product_get_feature_filter($feature_id)
{
   	return db_get_hash_single_array("SELECT a.filter_id, b.filter FROM ?:product_filters as a LEFT JOIN ?:product_filter_descriptions as b ON a.filter_id=b.filter_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.status='A' AND a.feature_id='$feature_id' ORDER BY b.filter", array('filter_id', 'filter'));
}
/****************************************************************************************/

/**************************** Blocks and Grids on mobiles ******************************/
function fn_mcs_framework_render_blocks($grid, $block, $this, $content)
{
	if(AREA=='C'){
		
		$tpl_vars=Registry::get('view')->{'tpl_vars'};
		$deviceType=$tpl_vars['mobiledetect']->{'value'}['deviceType'];
		$mcs_framework=$tpl_vars['settings']->{'value'}['mcs_framework'];
		
		if($mcs_framework['mcs_general']['mcs_general_mobile_devices_block_detection']=='Y'){
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
		
		/*Apply Shortcodes in HTML block content (only if shortcodes are enabled) */
		if(fn_mcs_shortcodes()&&$block['type']=='html_block'){
				
			$parser = ShortcodesParser();;
			$parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
			$parser->parse($block['content']['content']);
			$block['content']['content']=$parser->getAsHtml();
			
		}
		
	}
}

function fn_mcs_framework_get_grids_post($grids)
{
	if(AREA=='C'){
		
		$tpl_vars=Registry::get('view')->{'tpl_vars'};
		$deviceType=$tpl_vars['mobiledetect']->{'value'}['deviceType'];
		$mcs_framework=$tpl_vars['settings']->{'value'}['mcs_framework'];
		
		if($mcs_framework['mcs_general']['mcs_general_mobile_devices_grid_detection']=='Y'){
		
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
				}
			}
		}
	}
}
/****************************************************************************************************/

/*********************************** Popup notifications ********************************************/
function fn_mcs_popup_get_pages()
{
    $pages = array(
        'home' => __('home'),
        'all' => __('all')
		
    );

    return $pages;
}

function fn_mcs_popup_get_types()
{
    $types = array(
        'banner' => __('banner'),
        'category' => __('category'),
        'promotion' => __('promotion'),
        'newsletter' => __('newsletter')
		
    );

    return $types;
}

function fn_mcs_popup_get_banners()
{
	$company_id=(Registry::get('runtime.company_id')=="0")?Registry::get('runtime.forced_company_id'):Registry::get('runtime.company_id');
   	return db_get_hash_single_array("SELECT a.banner_id, b.banner FROM ?:banners as a LEFT JOIN ?:banner_descriptions as b ON a.banner_id=b.banner_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.status='A' AND a.company_id='$company_id' ORDER BY a.position", array('banner_id', 'banner'));
}

function fn_mcs_popup_get_categories()
{
	$company_id=(Registry::get('runtime.company_id')=="0")?Registry::get('runtime.forced_company_id'):Registry::get('runtime.company_id');
   	return db_get_hash_single_array("SELECT a.category_id, b.category FROM ?:categories as a LEFT JOIN ?:category_descriptions as b ON a.category_id=b.category_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.status='A' AND a.company_id='$company_id' ORDER BY a.id_path,a.position", array('category_id', 'category'));
}

function fn_mcs_popup_get_promotions()
{
   	return db_get_hash_single_array("SELECT a.promotion_id, b.name FROM ?:promotions as a LEFT JOIN ?:promotion_descriptions as b ON a.promotion_id=b.promotion_id AND b.lang_code = '" . CART_LANGUAGE . "' WHERE a.status='A' ORDER BY a.priority", array('promotion_id', 'name'));
}
/*************************************************************************************************************/

/**************************************** Shortcodes *********************************************************/
function fn_mcs_shortcodes(){

	$mcs_shortcodes_settings = Registry::get('addons.mcs_framework');
	$mcs_shortcodes = $mcs_shortcodes_settings['mcs_general_shortcodes_enable'];
	
	if($mcs_shortcodes=='Y')
		return true;
	else
		return false;
}

function fn_mcs_add_controller_parser(){
	
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$dispatch=Registry::get('view')->{'tpl_vars'}['location_data']->{'value'}['dispatch'];
	
	$parser = ShortcodesParser();
	$parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
	
	if($dispatch=='categories.view'){
		
		$parser->parse($tpl_vars['category_data']->{'value'}['description']);
		$tpl_vars['category_data']->{'value'}['description']=$parser->getAsHtml();
	}
	
	if($dispatch=='pages.view'){
			
		$parser->parse($tpl_vars['page']->{'value'}['description']);
		$tpl_vars['page']->{'value'}['description']=$parser->getAsHtml();
	}
	
	if($dispatch=='products.view'){
			
		$parser->parse($tpl_vars['product']->{'value'}['full_description']);
		$tpl_vars['product']->{'value'}['full_description']=$parser->getAsHtml();
		
		$parser->parse($tpl_vars['product']->{'value'}['promo_text']);
		$tpl_vars['product']->{'value'}['promo_text']=$parser->getAsHtml();	
		
	}
}

/*************************************************************************************************************/

function fn_mcs_variants_get_easings()
{
    $easings = array(
        
		'linear' => __('linear'),
        'swing' => __('swing'),
        'easeInQuad' => __('easeInQuad'),
        'easeOutQuad' => __('easeOutQuad'),
        'easeInOutQuad' => __('easeInOutQuad'),
        'easeInCubic' => __('easeInCubic'),
        'easeOutCubic' => __('easeOutCubic'),
        'easeInOutCubic' => __('easeInOutCubic'),
        'easeInQuart' => __('easeInQuart'),
        'easeOutQuart' => __('easeOutQuart'),
        'easeInOutQuart' => __('easeInOutQuart'),
        'easeInQuint' => __('easeInQuint'),
        'easeOutQuint' => __('easeOutQuint'),
        'easeInOutQuint' => __('easeInOutQuint'),
        'easeInExpo' => __('easeInExpo'),
        'easeOutExpo' => __('easeOutExpo'),
        'easeInOutExpo' => __('easeInOutExpo'),
        'easeInSine' => __('easeInSine'),
        'easeOutSine' => __('easeOutSine'),
        'easeInOutSine' => __('easeInOutSine'),
        'easeInCirc' => __('easeInCirc'),
        'easeOutCirc' => __('easeOutCirc'),
        'easeInOutCirc' => __('easeInOutCirc'),
        'easeInElastic' => __('easeInElastic'),
        'easeOutElastic' => __('easeOutElastic'),
        'easeInOutElastic' => __('easeInOutElastic'),
        'easeInBack' => __('easeInBack'),
        'easeOutBack' => __('easeOutBack'),
        'easeInOutBack' => __('easeInOutBack'),
        'easeInBounce' => __('easeInBounce'),
        'easeOutBounce' => __('easeOutBounce'),
        'easeInOutBounce' => __('easeInOutBounce')
		
    );
	
    return $easings;
}


function fn_mcs_variants_get_effects()
{
    $effects = array(
	    'blind' => __('blind'),
        'bounce' => __('bounce'),
        'clip' => __('clip'),
        'drop' => __('drop'),
        'fade' => __('fade'),
        'fold' => __('fold'),
        'puff' => __('puff'),
        'pulsate' => __('pulsate'),
        'scale' => __('scale'),
        'shake' => __('shake'),
		'slideDown' => __('slideDown'),
        'slideUp' => __('slideUp'),
	);
	
	return $effects;
}	
	

function fn_mcs_framework_styles_block_files($styles)
{
	$tpl_vars=Registry::get('view')->{'tpl_vars'};
	$mcs_framework=$tpl_vars['settings']->{'value'}['mcs_framework'];
	$icomoon_enabled=$mcs_framework['mcs_font_icons']['mcs_icomoon'];
	$versionIE=$tpl_vars['mobiledetect']->{'value'}['versionIE'];
	
	if(($versionIE=='8.0' || $versionIE=='9.0') && AREA=='C'){
		
		$base_styles=array();
		$framework_styles=array();
		$theme_styles=array();
		
		foreach($styles as $k=>$v){
			$path=explode("/",$v['relative']);
			if(in_array('mcs_framework',$path)){
				array_push($framework_styles,$v);
			}elseif(in_array('theme_styles',$path)){
				array_push($theme_styles,$v);
			}else{
				if($icomoon_enabled=='Y'){
					if(!in_array('glyphs.css',$path)){
						array_push($base_styles,$v);
					}
				}else{
						array_push($base_styles,$v);
				}
				
			}		
		}
		
	//	$params['use_scheme']=true;
		
		list($_area) = Registry::get('view')->getArea();
		$filename = fn_merge_styles($base_styles, $internal_styles, $prepend_prefix, $params, $_area);
		$content='<link type="text/css" rel="stylesheet" href="' . $filename . '" />';
		$filename = fn_merge_styles($framework_styles, $internal_styles, $prepend_prefix, $params, $_area);
		$content.='<link type="text/css" rel="stylesheet" href="' . $filename . '" />';
		$filename = fn_merge_styles($theme_styles, $internal_styles, $prepend_prefix, $params, $_area);
		$content.='<link type="text/css" rel="stylesheet" href="' . $filename . '" />';
		
		
		$styles=array();
		print_r($content);
	}
	
	return $styles;
}

function fn_get_addon_id()
{
	$temp=db_get_array("SELECT `section_id`,`name` FROM ?:settings_sections WHERE `name` LIKE 'mcs_framework'");
	
	return $temp['0']['section_id'];
}

function fn_map_settings()
{
	$section_id=fn_get_addon_id();
	$i==0;
	$temp=db_get_array("SELECT `object_id`,`name` FROM ?:settings_objects WHERE section_id=$section_id AND type !='H'");
	foreach($temp as $k=>$v){
		$i++;
		$r=array(
			'sid'=>$i,
			'setting_id'=>$v['object_id'],
			'setting_name'=>$v['name']
		);
		db_replace_into("mcs_map_settings", $r);
	}
	return $temp;
}

function fn_save_general_settings()
{
	$section_id=fn_get_addon_id();
	$i==0;
	$temp=db_get_array("SELECT `object_id`,`name`,`value` FROM ?:settings_objects WHERE section_id=$section_id AND type !='H'");
	foreach($temp as $k=>$v){
		$i++;
		$r=array(
			'sid'=>$i,
			'setting_id'=>$v['object_id'],
			'setting_name'=>$v['name'],
			'setting_value'=>$v['value']
		);
		db_replace_into("mcs_general_settings", $r);
	}
	return $temp;
}

function fn_save_vendor_settings()
{
	$section_id=fn_get_addon_id();
	$i==0;
	$temp=db_get_array("SELECT a.object_id,a.name,b.value,b.company_id FROM ?:settings_objects as a LEFT JOIN ?:settings_vendor_values as b ON a.object_id=b.object_id WHERE a.section_id=$section_id AND a.type !='H'");
	foreach($temp as $k=>$v){
		$i++;
		$r=array(
			'sid'=>$i,
			'setting_id'=>$v['object_id'],
			'setting_name'=>$v['name'],
			'setting_value'=>$v['value'],
			'setting_comp_id'=>$v['company_id']
		);
		db_replace_into("mcs_vendor_settings", $r);
		if($v['value']==null || $v['company_id']==null){
			$i++;
			$r['sid']=$i;
			db_replace_into("mcs_vendor_settings", $r);
		}
	}
	return $temp;
}

function fn_restore_settings()
{
	$map_settings=db_get_array("SELECT * FROM ?:mcs_map_settings");
	$general_settings=db_get_array("SELECT * FROM ?:mcs_general_settings");
	$vendor_settings=db_get_array("SELECT * FROM ?:mcs_vendor_settings");
	
	foreach($general_settings as $k=>$v){
		db_query("UPDATE ?:settings_objects SET value=?s WHERE name=?s",$v['setting_value'],$v['setting_name']);
	}
	
	foreach($map_settings as $k=>$v){
		
		foreach($vendor_settings as $k1=>$v1){
			if($v['setting_name']==$v1['setting_name']){
				//db_query("UPDATE ?:settings_vendor_values SET value=?s WHERE object_id=?i AND company_id=?i",$v1['setting_value'],$v['setting_id'],$v1['setting_comp_id']);
				if($v1['setting_comp_id']!=null || $v1['setting_value']!=null){
					$temp=array(
						'object_id'=>$v['setting_id'],
						'company_id'=>$v1['setting_comp_id'],
						'value'=>$v1['setting_value']
					);
					db_replace_into("settings_vendor_values", $temp);
				}else if($v1['setting_comp_id']==null && $v1['setting_value']==null){
					db_query("DELETE FROM ?:settings_vendor_values WHERE object_id=?i",$v['setting_id']);
				}
			}
		}
		
	}
}