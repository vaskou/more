<?php

use Tygh\Registry;

$schema['central']['mcs_child_shops']=array(
	'items'=>array(
		'mcs_child_shops' => array(
			'attrs' => array(
				'class'=>'is-addon'
			),
			'href' => 'child_shops.manage',
			'position' => 1000
		)
	),
	'position'=>'1000'
);
	
return $schema;