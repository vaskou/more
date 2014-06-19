<?php
use Tygh\Registry;

if($mode=='view'){

}

if($mode=='install'){
/*	$map_settings=fn_map_settings();
	Registry::get('view')->assign('map_settings', $map_settings);*/
	//return array(CONTROLLER_STATUS_REDIRECT, "addons.update&addon=a_test");
}

if($mode=='uninstall'){
/*	$general_settings=fn_save_general_settings();
	$vendor_settings=fn_save_vendor_settings();
	
	Registry::get('view')->assign('general_settings', $general_settings);
	Registry::get('view')->assign('vendor_settings', $vendor_settings);*/
	
	//return array(CONTROLLER_STATUS_REDIRECT, "addons.update&addon=a_test");
}

if($mode=='restore'){
	fn_restore_settings();
	return array(CONTROLLER_STATUS_REDIRECT, "addons.update&addon=mcs_framework");
}