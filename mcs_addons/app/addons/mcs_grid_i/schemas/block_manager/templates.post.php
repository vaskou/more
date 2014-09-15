<?php

$schema['addons/mcs_grid_i/blocks/products/mcs_grid_i.tpl'] = array (
	'settings' => array(
		'item_number' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'number_of_columns' => array (
			'type' => 'input',
			'default_value' => 4
		),
		'show_price' => array (
			'type' => 'checkbox',
			'default_value' => 'Y'
		),
		'enable_quick_view' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'enable_add_to_wish' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'enable_add_to_compare' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'show_product_rating'=> array(
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'mcs_product_hidden_info_transition'=>array(
			'type'=>'selectbox',
			'values' => array (
				'mcs_none' => 'None',
				'mcs_fade' => 'Fade',
				'mcs_show' => 'Show',
				'mcs_slide' => 'Slide',
			),
			'default_value' => 'mcs_none'
		),
		'mcs_product_hidden_info_duration'=>array(
			'type'=>'input',
			'default_value'=>0
		)
	),
	'bulk_modifier' => array (
		'fn_gather_additional_products_data' => array (
			'products' => '#this',
			'params' => array (
				'get_icon' => true,
				'get_detailed' => true,
				'get_options' => true,
			),
		),
	),
);

$schema['addons/mcs_grid_i/blocks/products/mcs_grid_i_scroller.tpl'] = array (
	'settings' => array(
		'show_price' => array (
			'type' => 'checkbox',
			'default_value' => 'Y'
		),
		'enable_quick_view' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'enable_add_to_wish' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'enable_add_to_compare' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'show_product_rating'=> array(
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'not_scroll_automatically' => array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'scroll_per_page' =>  array (
			'type' => 'checkbox',
			'default_value' => 'N'
		),
		'speed' =>  array (
			'type' => 'input',
			'default_value' => 400
		),
		'pause_delay' =>  array (
			'type' => 'input',
			'default_value' => 3
		),
		'item_quantity' =>  array (
			'type' => 'input',
			'default_value' => 4
		),
	),
	'bulk_modifier' => array (
		'fn_gather_additional_products_data' => array (
			'products' => '#this',
			'params' => array (
				'get_icon' => true,
				'get_detailed' => true,
				'get_options' => true,
			),
		),
	),
);

return $schema;