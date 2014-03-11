<?php

if ( !defined('AREA') ) { die('Access denied'); }

function fn_settings_variants_addons_mcs_framework_mcs_scroll_to_top_easing()
{
	return fn_mcs_variants_get_easings();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_content_pages()
{
	return fn_mcs_popup_get_pages();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_effects_show()
{
	return fn_mcs_variants_get_effects();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_effects_show_easing()
{
	return fn_mcs_variants_get_easings();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_effects_hide_effect()
{
	return fn_mcs_variants_get_effects();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_effects_hide_easing()
{
	return fn_mcs_variants_get_easings();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_content_types()
{
	return fn_mcs_popup_get_types();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_content_banners()
{
	return fn_mcs_popup_get_banners();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_content_categories()
{
	return fn_mcs_popup_get_categories();
}

function fn_settings_variants_addons_mcs_framework_mcs_popup_content_promotions()
{
	return fn_mcs_popup_get_promotions();
}

function fn_settings_variants_addons_mcs_framework_mcs_product_brand_feature()
{
	return fn_mcs_product_get_features();
}

?>