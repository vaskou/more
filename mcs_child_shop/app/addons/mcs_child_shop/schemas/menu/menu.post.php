<?php
$schema['central']['synchronize'] = array(
	'items'=>array(
		'sync' => array(
    		'href' => 'sync.manage',
	    	'position' => 100
		),
		'error_log'=> array(
			'href'=>'sync.error_log',
			'position'=>200
		)
	),
	'position' => 1000
);

return $schema;