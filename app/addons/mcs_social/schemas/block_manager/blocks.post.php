<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

$schema['mcs_social'] = array (
    'templates' => array (
		'addons/mcs_social/blocks/mcs_social_links.tpl' => array(
        	'settings' => array (
				'mcs_social_icons_alignment' => array (
					'type' => 'selectbox',
                    'values' => array (
                        'center' => 'Center',
                        'left' => 'Left',
                        'right' => 'Right',
						'vertical'=>'Vertical'
                    ),
                    'default_value' => 'center',
					'tooltip'=>'Select the preferred alignment of the icons'
                ),
                'mcs_social_icons_size' => array (
                    'type' => 'selectbox',
					'values'=>array(
						'icon-default'=>'Default size',
						'icon-large'=>'Large size',
						'icon-2x'=>'2x size',
						'icon-3x'=>'3x size',
						'icon-4x'=>'4x size'
					),
                    'default_value' =>'icon-default',
					'tooltip'=>'Select the preferred size of the icons'
                ),
				'mcs_social_icons_border'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option to enable a discrete border around the icons'
				),
				'mcs_social_icons_shadow'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option to enable a discrete shadow around the icons'
				),
				'mcs_social_icons_circle'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option for rounded icons'
				),
				'mcs_social_icons_color'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option for colored icons'
				),
				'mcs_social_icons_white'=>array(
					'type'=>'checkbox',
					'default_value'=>'N',
					'tooltip'=>'Check this option for dark background. Will be ignored if Enable color has been checked'
				)
			),
        ),
	),
    'wrappers' => 'blocks/wrappers',
);

return $schema;
