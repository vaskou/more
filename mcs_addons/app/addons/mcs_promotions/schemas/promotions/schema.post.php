<?php

$scheme['conditions']['mcs_products_in_category'] = array (
	'operators' => array ('gte', 'gt', 'lte', 'lt'),
	'type' => 'mixed',
	'conditions_function' => array('fn_mcs_promotions_get_categories'),
	'field_function' => array('fn_mcs_promotions_check_products_amount', '#this', '@cart', '@cart_products','C'),
	'zones' => array('cart')
);

return $scheme;
