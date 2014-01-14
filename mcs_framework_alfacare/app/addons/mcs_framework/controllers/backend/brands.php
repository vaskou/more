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