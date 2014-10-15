<?php

use Tygh\Registry;
use Tygh\BlockManager\SchemesManager;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if ($mode == 'update') {
		if(!empty($_REQUEST['product_data'])){
			if($_REQUEST['product_data']['tracking']=='B'){
				fn_mcs_rebuild_inventory();
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
				fn_mcs_rebuild_inventory();
			}
		}
	}
}