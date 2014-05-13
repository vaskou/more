{styles use_scheme=true}
{hook name="index:styles"}
    {style src="reset.css"}
    {style src="grid.less"}
    {style src="lib/ui/jqueryui.css"}
    {style src="base.css"}
    {if $addons.mcs_framework.mcs_icomoon!='Y'}
	    {style src="glyphs.css"}
    {/if}
    {style src="styles.css"}
    {style src="print.css" media="print"}

    {if $runtime.customization_mode.translation || $runtime.customization_mode.design}
    {style src="design_mode.css"}
    {/if}
    {if $include_dropdown}
    {style src="dropdown.css"}
    {/if}

	{* Theme editor mode *}
    {if $runtime.customization_mode.theme_editor}
        {style src="theme_editor.css"}
    {/if}
    
    {style src="scheme.less"}
{/hook}
{/styles}

{styles use_scheme=true}
{hook name="index:mcs_styles"}
{/hook}
{/styles}

{styles use_scheme=true}
	{style src="theme_styles/mcs_general_less_rules.less"}
    {style src="theme_styles/mcs_general_styles.css"}
    {style src="theme_styles/mcs_general_styles.less"}
    {style src="theme_styles/mcs_brands_page.css"}
    {style src="theme_styles/mcs_brands_page.less"}
    {style src="theme_styles/header/mcs_top_panel.css"}
    {style src="theme_styles/header/mcs_top_panel.less"}
    {style src="theme_styles/header/mcs_header.css"}
    {style src="theme_styles/header/mcs_header.less"}
    {style src="theme_styles/header/mcs_top_menu.css"}
    {style src="theme_styles/header/mcs_top_menu.less"}
    {style src="theme_styles/header/mcs_search_box.css"}
    {style src="theme_styles/header/mcs_search_box.less"}
    {style src="theme_styles/homepage/mcs_main_content.css"}
    {style src="theme_styles/homepage/mcs_main_content.less"}
    {style src="theme_styles/homepage/mcs_slider.css"}
    {style src="theme_styles/homepage/mcs_slider.less"}
    {style src="theme_styles/homepage/mcs_brand_scroller.css"}
    {style src="theme_styles/homepage/mcs_brand_scroller.less"}
    {style src="theme_styles/categories/mcs_products_grid.css"}
    {style src="theme_styles/categories/mcs_products_grid.less"}
    {style src="theme_styles/categories/mcs_side_menu.css"}
    {style src="theme_styles/categories/mcs_side_menu.less"}
    {style src="theme_styles/categories/mcs_sidebox.css"}
    {style src="theme_styles/categories/mcs_sidebox.less"}
    {style src="theme_styles/categories/mcs_sorting.css"}
    {style src="theme_styles/categories/mcs_sorting.less"}
    {style src="theme_styles/products/mcs_product.css"}
    {style src="theme_styles/products/mcs_product.less"}
    {style src="theme_styles/pages/mcs_pages_side_menu.css"}
    {style src="theme_styles/pages/mcs_pages_side_menu.less"}
    {style src="theme_styles/mcs_labels/mcs_labels.css"}
    {style src="theme_styles/footer/mcs_footer.css"}
    {style src="theme_styles/footer/mcs_footer.less"}
    
    {if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
        {style src="theme_styles/mcs_general_styles.resp.css"}
        {style src="theme_styles/header/mcs_top_panel.resp.css"}
        {style src="theme_styles/header/mcs_header.resp.css"}
        {style src="theme_styles/header/mcs_header.resp.less"}
        {style src="theme_styles/header/mcs_top_menu.resp.less"}
        {style src="theme_styles/header/mcs_search_box.resp.css"}
        {style src="theme_styles/homepage/mcs_main_content.resp.css"}
        {style src="theme_styles/homepage/mcs_slider.resp.css"}
        {style src="theme_styles/homepage/mcs_slider.resp.less"}
        {style src="theme_styles/categories/mcs_sidebox.resp.css"}
        {style src="theme_styles/categories/mcs_products_grid.resp.less"}
        {style src="theme_styles/categories/mcs_sorting.resp.css"}
        {style src="theme_styles/products/mcs_product.resp.css"}
    {/if}
    {literal}<style>.zxcasd{display:none;}</style>{/literal}
{/styles}