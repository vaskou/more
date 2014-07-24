<?php
if ( !defined('AREA') ) { die('Access denied'); }

fn_register_hooks(
	'gather_additional_product_data_post',
	'update_product_pre'
);

// if (fn_allowed_for('ULTIMATE')) {
    // fn_register_hooks(
        // 'delete_company',
        // 'ult_check_store_permission'
    // );
// }

?>
