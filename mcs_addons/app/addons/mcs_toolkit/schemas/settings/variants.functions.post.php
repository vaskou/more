<?php

if ( !defined('AREA') ) { die('Access denied'); }

function fn_settings_variants_addons_mcs_toolkit_mcs_scripts()
{
	$files_array=array();
	$dir_path="js/addons/mcs_toolkit/custom";
	$files=fn_get_dir_contents($dir_path,true,true);
	foreach($files as $file){
		$key=str_replace(".","_DOT_",$file);
		$files_array[$key]=$file;
	}
	return $files_array;
}
