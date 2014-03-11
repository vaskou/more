<?php
	use Tygh\Registry;
	
	if (!defined('BOOTSTRAP')) { die('Access denied'); }
	
	$lib_path = Registry::get('config.dir.addons') . 'mcs_framework/lib/';
	
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

	
	 //print '<pre>'; 
	 //print_r($detect);
	// echo $detect->isMobile();
	// echo $detect->isTablet();
	 //print '</pre>';
	
	Registry::get('view')->assign('mobiledetect', $mobiledetect);
	