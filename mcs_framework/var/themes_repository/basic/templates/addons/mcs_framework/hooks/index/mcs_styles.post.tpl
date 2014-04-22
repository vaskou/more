{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
	{style src="addons/mcs_framework/bootstrap-responsive/bootstrap.min.less"}
{/if}

{style src="addons/mcs_framework/mcs_general_less_rules.less"}
{style src="addons/mcs_framework/mcs_general_styles.css"}
{style src="addons/mcs_framework/mcs_general_styles.less"}
{style src="addons/mcs_framework/mcs_font_icons/core.css"}

{if $addons.mcs_framework.mcs_icomoon=='Y'}
	{style src="addons/mcs_framework/mcs_product_filter_icons.less"}
	{style src="addons/mcs_framework/mcs_font_icons/icomoon/style.css"}
    {style src="addons/mcs_framework/mcs_font_icons/overrides.css"}
{/if}

{if $addons.mcs_framework.mcs_general_bxslider_enable=='Y'}
	{style src="addons/mcs_framework/mcs_sliders/bxslider/jquery.bxslider.css"}
    {style src='addons/mcs_framework/mcs_sliders/bxslider/bxslider.pager.css'}
{/if}

{if $addons.mcs_framework.mcs_general_fixed_menu_enable=='Y'}
	{style src="addons/mcs_framework/mcs_menu_fixed.css"}
{/if}

{if $addons.mcs_framework.mcs_product_tabs_vertical=='Y'}
	{style src="addons/mcs_framework/mcs_vertical_product_tabs/tabs_vertical.less"}
        
	<style>
		{literal}
		@media (min-width:768px){
			.products_view .tabs{
				width:{/literal}{$addons.mcs_framework.mcs_product_tabs_width}{literal}px;
				margin-right:{/literal}{$addons.mcs_framework.mcs_product_tabs_margin}{literal}px;
			}
			
		}
		{/literal}
    </style>
{/if} 

{if $addons.mcs_framework.mcs_product_categories_hidden_info!='mcs_none'}
	{style src="addons/mcs_framework/mcs_i_grid/mcs_hover_hide.css"}
{/if}

{if $addons.mcs_framework.mcs_scroll_to_top_enable=='Y'}
	{style src="addons/mcs_framework/mcs_scroll_to_top/mcs_scroll_to_top.css"}
{/if}

{if $addons.mcs_framework.mcs_general_shortcodes_enable=='Y'}
	{style src="addons/mcs_framework/mcs_shortcodes/mcs_shortcodes.css"}
	{style src="addons/mcs_framework/mcs_shortcodes/mcs_shortcodes.less"}
{/if}

{style src="addons/mcs_framework/jquery_ui/jquery-ui-1.10.3.custom.css"}

{style src="addons/mcs_framework/mcs_i_menu/meanmenu.min.css"}
{style src="addons/mcs_framework/mcs_i_menu/mcs_i_menu.css"}
{style src="addons/mcs_framework/mcs_i_menu/mcs_i_menu.less"}
{style src="addons/mcs_framework/mcs_i_grid/mcs_i_grid.css"}
{style src="addons/mcs_framework/mcs_i_grid/mcs_slides.css"}
{style src="addons/mcs_framework/mcs_i_grid/mcs_slides.less"}
{style src="addons/mcs_framework/mcs_font_icons/mcs_block_icons.css"}
{style src="addons/mcs_framework/mcs_font_icons/mcs_block_icons.less"}
{style src="addons/mcs_framework/mcs_i_scroller.css"}
{style src="addons/mcs_framework/mcs_brand_scroller.css"}
{style src="addons/mcs_framework/mcs_brand_scroller.less"}
{style src="addons/mcs_framework/mcs_brands_page.css"}
{style src="addons/mcs_framework/mcs_submenu_visible.css"}
{style src="addons/mcs_framework/mcs_social_icons/mcs_social_icons.css"}
{style src="addons/mcs_framework/mcs_social_icons/mcs_social_icons.less"}
{style src="addons/mcs_framework/mcs_labels/mcs_labels.css"}
{style src="addons/mcs_framework/mcs_labels/mcs_labels.less"}
{style src="addons/mcs_framework/mcs_payment_icons/mcs_payment_icons.css"}
{style src="addons/mcs_framework/mcs_contact_block/mcs_contact_block.css"}

{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
	{style src="addons/mcs_framework/mcs_general_styles.resp.css"}
    {style src="addons/mcs_framework/mcs_general_styles.resp.less"}
    {style src="addons/mcs_framework/mcs_i_grid/mcs_i_grid.resp.css"}
    {style src="addons/mcs_framework/cart_page/cart_page.resp.css"}
    {style src="addons/mcs_framework/checkout_page/checkout_page.resp.css"}
    {style src="addons/mcs_framework/mcs_quick_view/mcs_quick_view.resp.css"}
    {style src="addons/mcs_framework/mcs_contact_block/mcs_contact_block.resp.css"}
{/if}

{literal}<style>.asdzxc{display:none;}</style>{/literal}