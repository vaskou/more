<?php


$schema['addons/mcs_framework/blocks/categories/mcs_alpha_menu.tpl'] = array (
	'settings' => array (
		'dropdown_second_level_elements' => array (
			'type' => 'input',
			'default_value' => '12'
		),
		'dropdown_third_level_elements' => array (
			'type' => 'input',
			'default_value' => '6'
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