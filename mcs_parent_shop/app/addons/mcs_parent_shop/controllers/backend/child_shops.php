<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	fn_trusted_vars('child_shop','child_shop_data');
	
	$suffix = '';

	//
    // Delete child shops
    //
    if ($mode == 'm_delete') {
        foreach ($_REQUEST['child_shops_ids'] as $v) {
            fn_delete_child_shop_by_id($v);
        }

        $suffix = '.manage';
    }

    //
    // Update child shop
    //	
	else if ($mode == 'update') {

	
		if (!$_REQUEST['child_shop_id']){
		
			$domain_exists=fn_check_child_shop_domain_exists($_REQUEST['child_shop_data']['domain']);
			
			if($domain_exists)
				$_REQUEST['child_shop_data']['domain']=$_REQUEST['child_shop_data']['domain'].'-'.time();
		}
		
		$child_shop_id=fn_update_child_shop($_REQUEST['child_shop_data'], $_REQUEST['child_shop_id']);

		$suffix = ".update?child_shop_id=$child_shop_id";

	}

	return array(CONTROLLER_STATUS_OK, "child_shops$suffix");

}

if ($mode == 'update') {

	$child_shop_data = db_get_row("SELECT * FROM ?:mcs_child_shops WHERE child_shop_id = ?i ", $_REQUEST['child_shop_id']);

	Registry::set('navigation.tabs', array (
        'general' => array (
            'title' => __('general'),
            'js' => true
        ),
    ));
	
    Registry::get('view')->assign('child_shop_data', $child_shop_data);
}

elseif ($mode == 'delete') {
	
	if (!empty($_REQUEST['child_shop_id'])) {
		db_query("DELETE FROM ?:mcs_child_shops WHERE child_shop_id = ?i", $_REQUEST['child_shop_id']);
	}
	
	return array(CONTROLLER_STATUS_REDIRECT, "child_shops.manage");
}

elseif ($mode == 'manage') {

	list($child_shops, ) = fn_get_child_shops();
    Registry::get('view')->assign('child_shops', $child_shops);

}

?>
