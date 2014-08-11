<?php
use Tygh\Registry;


if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
	return;

if ($mode == 'update') {
			
		// list($shipping_availabilities, ) = fn_get_shipping_availabilities(array(), DESCR_SL);
	    // Registry::get('view')->assign('shipping_availabilities', $shipping_availabilities);
}

if ($mode == 'manage') {

    $selected_fields = Registry::get('view')->getTemplateVars('selected_fields');

    $selected_fields[] = array(
        'name' => '[extra][mcs_lock_sync_product]',
        'text' => __('mcs_lock_sync_product')
    );
	
    Registry::get('view')->assign('selected_fields', $selected_fields);
	
}

elseif ($mode == 'm_update') {

    $selected_fields = $_SESSION['selected_fields'];

    //if (!empty($selected_fields['extra']['mcs_child_sync_product'])) {

        $field_groups = Registry::get('view')->getTemplateVars('field_groups');
        $filled_groups = Registry::get('view')->getTemplateVars('filled_groups');
		
		if (!empty($selected_fields['extra']['mcs_lock_sync_product'])) {
			$field_groups['C']['mcs_lock_sync_product'] = 'products_data';
			$filled_groups['C']['mcs_lock_sync_product'] = __('mcs_lock_sync_product');
        }
		
        Registry::get('view')->assign('field_groups', $field_groups);
        Registry::get('view')->assign('filled_groups', $filled_groups);
    //}
}

?>

