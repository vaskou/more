<?php

$features_list=fn_mcs_product_get_features();

$schema['mcs_brand_scroller'] = array (
	'content' => array (
		'items' => array (
			'remove_indent' => true,
			'hide_label' => true,
			'type' => 'enum',
			'object' => 'brands',
			'items_function' => 'fn_get_selected_brands',
			'fillings' => array (
				'random' => array (
                    'params' => array (
                        'has_limit' => true,
                    )
                ),
				'manually' => array (
					'picker' => 'addons/mcs_brand_scroller/pickers/brands/picker.tpl',
					'picker_params' => array (
						'type' => 'links',
					),
				),
			),
		),
	),
	'settings'=>array(
		'mcs_brand_scroller_button'=>array(
			'type'=>'checkbox',
			'default_value'=>'Y'
		),
		'mcs_brand_scroller_button_icon'=>array(
			'type'=>'input',
			'default_value'=>'ty-icon-right-open'
		),
		'mcs_brand_scroller_brand_feature_id' => array(
			'type'=>'selectbox',
			'values'=>$features_list
		)		
	),
    'templates' => array (
		'addons/mcs_brand_scroller/blocks/mcs_brand_scroller.tpl' => array(
			'settings'=>array(
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
					'default_value' => 6
				)
			)
		)
	),
    'wrappers' => 'blocks/wrappers',
);

return $schema;
