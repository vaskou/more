<?php

function fn_mcs_get_filters()
{
	$filter_list=array();
	list($filters,)=fn_get_product_filters();
	foreach($filters as $filter){
		$filter_list[$filter['filter_id']]=$filter['filter'];
	}
	
	return $filter_list;
}