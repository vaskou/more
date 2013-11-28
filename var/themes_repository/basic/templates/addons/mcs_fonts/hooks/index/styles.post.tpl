{if $addons.mcs_fonts.mcs_body_gfont}
<style type="text/css">
{literal}
	body, div, span, li, td, input[type="text"], input[type="password"], textarea, select, .scroll-y, .ui-widget select, .ui-widget textarea, .ui-widget, .ui-dialog .ui-dialog-title, a, a:visited, a:active, .cm-popup-title:hover > a, .cm-popup-title.unlogged a, .cm-popup-title.logged a, .minicart-title, ul.dropdown-multicolumns li a {
		font-family:'{/literal}{$addons.mcs_fonts.mcs_body_gfont}{literal}';
	}
{/literal}
</style>
{/if}

{if $addons.mcs_fonts.mcs_headings_gfont}
<style type="text/css">
{literal}
	h1 .mainbox-title, .mainbox-title span, .product-main-info h1.mainbox-title, .product-quick-view.product-main-info .quick-view-title {
		font-family:'{/literal}{$addons.mcs_fonts.mcs_headings_gfont}{literal}';
	}
{/literal}
</style>
{/if}

{if $addons.mcs_fonts.mcs_links_gfont}
<style type="text/css">
{literal}
	a, a:visited, a:active, .tygh-footer a:link, .tygh-footer a:visited, .top-links-grid a:link, .top-links-grid a:visited, .product-filters li a.filter-item, .sidebox-body ul a.extra-link {
		font-family:'{/literal}{$addons.mcs_fonts.mcs_links_gfont}{literal}';
	}
{/literal}
</style>
{/if}

{if $addons.mcs_fonts.mcs_price_tag_gfont}
<style type="text/css">
{literal}
	.product-main-info .price-num, .product-main-info.product-quick-view .price-num {
		font-family:'{/literal}{$addons.mcs_fonts.mcs_price_tag_gfont}{literal}';
	}
{/literal}
</style>
{/if}

{if $addons.mcs_fonts.mcs_buttons_gfont}
<style type="text/css">
{literal}
	.button-submit-action input, .button-submit input, .button a, .button-action a, .button-big a, .button-submit-action input, .button-submit input, .button-submit-big input {
		font-family:'{/literal}{$addons.mcs_fonts.mcs_buttons_gfont}{literal}';
	}
{/literal}
</style>
{/if}