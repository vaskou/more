<?php
if ( !defined('AREA') ) { die('Access denied'); }

fn_register_hooks(
	'gather_additional_product_data_post',
	'update_product_pre',
	'tools_change_status'
);

?>
