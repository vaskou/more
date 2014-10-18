<?php

if ( !defined('AREA') ) { die('Access denied'); }

function fn_settings_variants_addons_mcs_getaquote_mcs_features_list()
{
	$features=array();
	$params=array("plain"=>true);
	list($features_list,,)=fn_get_product_features($params);
	foreach($features_list as $k=>$v)
	{
		$features[$v['feature_id']]=$v['description'];
	}
	return $features;
}
