<?php

$schema['addons/mcs_menu_i/blocks/categories/mcs_menu_i.tpl'] = array (
	'settings' => array (
		'dropdown_second_level_elements' => array (
			'type' => 'input',
			'default_value' => '12'
		),
		'dropdown_third_level_elements' => array (
			'type' => 'input',
			'default_value' => '6'
		),
		'mcs_top_menu_hide_third_level'=> array(
			'type'=>'checkbox',
			'default_value'=>'N'
		),
		'mcs_top_menu_show_images'=> array(
			'type'=>'checkbox',
			'default_value'=>'N'
		),
		'mcs_top_menu_category_image_width' => array (
			'type' => 'input',
			'default_value' => '120'
		),
		'mcs_top_menu_category_image_height' => array (
			'type' => 'input',
			'default_value' => '80'
		),
		'mcs_top_menu_responsive'=> array(
			'type'=>'checkbox',
			'default_value'=>'N'
		),
	),
	'fillings' => array('full_tree_cat', 'dynamic_tree_cat'),
	'params' => array (
		'plain' => false,
		'group_by_level' => true,
		'request' => array (
			'active_category_id' => '%CATEGORY_ID%',
		),
	)
);

return $schema;