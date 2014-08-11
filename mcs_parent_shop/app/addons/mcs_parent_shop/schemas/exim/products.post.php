<?php

use Tygh\Registry;

$schema['export_fields']['Child Sync Product'] = array (
    'db_field' => 'mcs_child_sync_product'
);

$schema['export_fields']['Child Sync Images'] = array (
    'db_field' => 'mcs_child_sync_images'
);

$schema['export_fields']['Child Sync Files'] = array (
    'db_field' => 'mcs_child_sync_files'
);

$schema['export_fields']['Child Name'] = array (
    'table' => 'product_descriptions',
	'db_field' => 'mcs_child_product',
    'multilang' => true
);

$schema['export_fields']['Child Description'] = array (
    'table' => 'product_descriptions',
	'db_field' => 'mcs_child_full_description',
    'multilang' => true
);

return $schema;

