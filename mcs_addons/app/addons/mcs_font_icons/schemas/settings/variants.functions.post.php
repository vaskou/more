<?php

if ( !defined('AREA') ) { die('Access denied'); }

function fn_settings_variants_addons_mcs_font_icons_mcs_icons_library()
{
	$files_array=array();
	$extensions=array('css','less');
	$dir_path="design/themes/responsive/css/addons/mcs_font_icons/libraries";
	$files=fn_get_dir_contents($dir_path,false,true,$extensions,'',true);
	foreach($files as $file){
		$key=str_replace(".","_DOT_",$file);
		$key=str_replace("/","_SLASH_",$key);
		$files_array[$key]=$file;
	}
	return $files_array;
}

function fn_settings_variants_addons_mcs_font_icons_mcs_custom_icons()
{
	$files_array=array();
	$extensions=array('css','less');
	$dir_path="design/themes/responsive/css/addons/mcs_font_icons/custom";
	$files=fn_get_dir_contents($dir_path,false,true,$extensions,'',true);
	foreach($files as $file){
		$key=str_replace(".","_DOT_",$file);
		$key=str_replace("/","_SLASH_",$key);
		$files_array[$key]=$file;
	}
	return $files_array;
}