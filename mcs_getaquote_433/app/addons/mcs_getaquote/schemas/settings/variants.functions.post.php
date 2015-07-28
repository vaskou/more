<?php

if ( !defined('AREA') ) { die('Access denied'); }

function fn_settings_variants_addons_mcs_getaquote_mcs_getaquote_features_list()
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

function fn_settings_variants_addons_mcs_getaquote_mcs_getaquote_pages_list()
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

function fn_settings_variants_addons_mcs_getaquote_mcs_getaquote_usergroups_list()
{
	$usergroups=array();
	
	$where = defined('RESTRICTED_ADMIN') ? "a.type != 'A' ": '1';

    $usergroups = db_get_hash_single_array("SELECT a.usergroup_id, b.usergroup FROM ?:usergroups as a LEFT JOIN ?:usergroup_descriptions as b ON b.usergroup_id = a.usergroup_id AND b.lang_code = ?s WHERE $where ORDER BY usergroup", array('usergroup_id', 'usergroup') , DESCR_SL);
	
	return $usergroups;
}