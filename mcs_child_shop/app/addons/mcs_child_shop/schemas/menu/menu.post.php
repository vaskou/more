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
		),
		'mcs_sync_log'=> array(
			'attrs' => array(
				'class'=>'is-addon'
			),
			'href'=>'sync.sync_log',
			'position'=>300
		)
	),
	'position' => 1000
);

if( isset($_SESSION['auth']['is_root']) && $_SESSION['auth']['is_root']=='N' ){
	unset($schema['central']['mcs_synchronization']['items']['mcs_error_log']);
}

return $schema;