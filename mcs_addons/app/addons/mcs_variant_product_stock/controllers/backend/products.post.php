<?php

use Tygh\Registry;
use Tygh\BlockManager\SchemesManager;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if ($mode == 'update') {
		if(!empty($_REQUEST['product_data'])){
			$temp_ids=array();
		
			$result=db_get_array("SELECT product_id FROM ?:product_options_inventory");
			foreach($result as $k=>$v){
				if(!in_array($v['product_id'],$temp_ids)){
					$temp_ids[]=$v['product_id'];
					fn_rebuild_product_options_inventory($v['product_id'], 50);
				}
			}
		}
	}
	if ($mode == 'm_update') {		
		if(!empty($_REQUEST['products_data'])){
			
			foreach($_REQUEST['products_data'] as $k=>$v){
				$tracking=db_get_field("SELECT tracking FROM ?:products WHERE product_id = ?i",$k);
				if($tracking == 'B'){
					break;
				}
			}
			
			if($tracking == 'B'){
				$temp_ids=array();
				
				$result=db_get_array("SELECT product_id FROM ?:product_options_inventory");
				foreach($result as $k=>$v){
					if(!in_array($v['product_id'],$temp_ids)){
						$temp_ids[]=$v['product_id'];
						fn_rebuild_product_options_inventory($v['product_id'], 50);
					}
				}
			}
		}
	}
}