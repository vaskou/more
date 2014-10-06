<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }


fn_register_hooks(
	'update_product_option_pre',
	'look_through_variants_update_combination',
	'update_product_amount'
);