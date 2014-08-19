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