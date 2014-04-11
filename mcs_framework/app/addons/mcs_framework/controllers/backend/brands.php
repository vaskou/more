<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode == 'picker') {
	
	/*$params['feature_id']=18;
	$params['feature_type']="E";
    $params['get_images'] = true;*/
	$mcs_feature_id=$_REQUEST['mcs_feature_id'];
	list($brands, ) = fn_get_brands($mcs_feature_id);
	
    Registry::get('view')->assign('brands',$brands);
    Registry::get('view')->display('addons/mcs_framework/pickers/brands/picker_contents.tpl');
    exit;
	
}