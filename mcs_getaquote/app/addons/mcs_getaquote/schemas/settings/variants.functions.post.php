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

function fn_settings_variants_addons_mcs_getaquote_mcs_pages_list()
{
	$pages=array();
	list($pages_list)=fn_get_pages();
	foreach($pages_list as $page){
		if($page['page_type']=='F'){
			$pages[$page['page_id']]=$page['page'];
		}
	}
	
	return $pages;
}
