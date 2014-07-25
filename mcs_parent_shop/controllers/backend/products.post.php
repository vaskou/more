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
        'name' => '[extra][mcs_child_sync_product]',
        'text' => __('mcs_child_sync_product')
    );
   
   $selected_fields[] = array(
        'name' => '[extra][mcs_child_sync_images]',
        'text' => __('mcs_child_sync_images')
    );

	$selected_fields[] = array(
        'name' => '[extra][mcs_child_sync_files]',
        'text' => __('mcs_child_sync_files')
    );
	
   $selected_fields[] = array(
        'name' => '[extra][mcs_child_product]',
        'text' => __('mcs_child_product_name')
    );

   $selected_fields[] = array(
        'name' => '[extra][mcs_child_full_description]',
        'text' => __('mcs_child_full_description')
    );

	
    Registry::get('view')->assign('selected_fields', $selected_fields);
	
}

elseif ($mode == 'm_update') {

    $selected_fields = $_SESSION['selected_fields'];

    //if (!empty($selected_fields['extra']['mcs_child_sync_product'])) {

        $field_groups = Registry::get('view')->getTemplateVars('field_groups');
        $filled_groups = Registry::get('view')->getTemplateVars('filled_groups');
		
		if (!empty($selected_fields['extra']['mcs_child_sync_product'])) {
			$field_groups['C']['mcs_child_sync_product'] = 'products_data';
			$filled_groups['C']['mcs_child_sync_product'] = __('mcs_child_sync_product');
        }
		
		if (!empty($selected_fields['extra']['mcs_child_sync_images'])) {
			$field_groups['C']['mcs_child_sync_images'] = 'products_data';
			$filled_groups['C']['mcs_child_sync_images'] = __('mcs_child_sync_images');
		}

		if (!empty($selected_fields['extra']['mcs_child_sync_files'])) {
			$field_groups['C']['mcs_child_sync_files'] = 'products_data';
			$filled_groups['C']['mcs_child_sync_files'] = __('mcs_child_sync_files');
		}
		
		if (!empty($selected_fields['extra']['mcs_child_product'])) {
			$field_groups['A']['mcs_child_product'] = 'products_data';
			$filled_groups['A']['mcs_child_product'] = __('mcs_child_product');
		}

		if (!empty($selected_fields['extra']['mcs_child_full_description'])) {
			$field_groups['D']['mcs_child_full_description'] = 'products_data';
			$filled_groups['D']['mcs_child_full_description'] = __('mcs_child_full_description');
		}
		
        Registry::get('view')->assign('field_groups', $field_groups);
        Registry::get('view')->assign('filled_groups', $filled_groups);
    //}
}

?>

