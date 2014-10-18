<?php

use Tygh\Registry;
use Tygh\BlockManager;
use Tygh\BlockManager\Block;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**************************** Blocks and Grids on mobiles ******************************/
function fn_mcs_toolkit_render_blocks($grid, $block, $this, $content)
{
	if(AREA=='C'){
		
		$tpl_vars=Registry::get('view')->{'tpl_vars'};
		$deviceType=$tpl_vars['mobiledetect']->{'value'}['deviceType'];
		//var_dump($deviceType);
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
}

function fn_mcs_toolkit_get_grids_post($grids)
{
	if(AREA=='C'){
		
		$tpl_vars=Registry::get('view')->{'tpl_vars'};
		$deviceType=$tpl_vars['mobiledetect']->{'value'}['deviceType'];
		
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
/****************************************************************************************************/

function fn_mcs_toolkit_init_templater($view)
{
	
	$lib_path = Registry::get('config.dir.addons') . 'mcs_toolkit/libs/';
	
	require_once ($lib_path . 'mobiledetect/Mobile_Detect.php');
	
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	$scriptVersion = $detect->getScriptVersion();
	
	$mobiledetect=array();
	$mobiledetect['isMobile']=$detect->isMobile();
	$mobiledetect['isTablet']=$detect->isTablet();
	$mobiledetect['deviceType']=$deviceType;
	$mobiledetect['scriptVersion']=$scriptVersion;
	$mobiledetect['userAgent']=$detect->getUserAgent();
	$mobiledetect['isiOS']=$detect->isiOS();
	$mobiledetect['isAndroidOS']=$detect->isAndroidOS();
	$mobiledetect['isBlackBerryOS']=$detect->isBlackBerryOS();
	$mobiledetect['isWindowsMobileOS']=$detect->isWindowsMobileOS();
	$mobiledetect['isWindowsPhoneOS']=$detect->isWindowsPhoneOS();
	$mobiledetect['versionIE']=$detect->version('IE');
	
	$view->assign('mobiledetect', $mobiledetect);
}