<?php
$schema['central']['mcs_synchronization'] = array(
	'items'=>array(
		'mcs_synchronize' => array(
    		'href' => 'sync.manage',
	    	'position' => 100
		),
		'mcs_error_log'=> array(
			'href'=>'sync.error_log',
			'position'=>200
		)
	),
	'position' => 1000
);

return $schema;