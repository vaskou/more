<?php
$schema['central']['mcs_synchronization'] = array(
	'items'=>array(
		'mcs_synchronize' => array(
			'attrs' => array(
				'class'=>'is-addon'
			),
    		'href' => 'sync.manage',
	    	'position' => 100
		),
		'mcs_error_log'=> array(
			'attrs' => array(
				'class'=>'is-addon'
			),
			'href'=>'sync.error_log',
			'position'=>200
		)
	),
	'position' => 1000
);

return $schema;