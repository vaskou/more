<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }


fn_register_hooks(
	'update_product_option_pre',
    'update_product_option_post',
	'rebuild_product_options_inventory_pre',
	'look_through_variants_pre'
);