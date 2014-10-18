<?php

use Tygh\Registry;

$schema['mcs_vendor_wishlist']=array (
	'templates' => 'addons/mcs_getaquote/blocks/mcs_vendor_wishlist.tpl',
	/*'content' => array (
		'items' => array (
			'type' => 'function',
			'function' => array('fn_get_menu_items')
		),
		'menu' => array(
			'type' => 'template',
			'template' => 'views/menus/components/block_settings.tpl',
			'hide_label' => true,
			'data_function' => array('fn_get_menus'),
		),
	),*/
	'wrappers' => 'blocks/wrappers',
);

return $schema;