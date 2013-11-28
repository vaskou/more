{style src="addons/mcs_framework/mcs_font_icons/core.css"}

{if $addons.mcs_framework.mcs_fontawesome=='Y'}
	{style src="addons/mcs_framework/mcs_font_icons/fontawesome/style.css"}
{/if}

{if $addons.mcs_framework.mcs_icomoon=='Y'}
	{style src="addons/mcs_framework/mcs_font_icons/icomoon/style.css"}
{/if}

{if $addons.mcs_framework.mcs_bxslider=='Y'}
	{style src="addons/mcs_framework/mcs_sliders/bxslider/jquery.bxslider.css"}
    {style src='addons/mcs_framework/mcs_sliders/bxslider/bxslider.pager.css'}
{/if}

{if $addons.mcs_framework.mcs_fixed_menu=='Y'}
	{style src="addons/mcs_framework/mcs_menu_fixed.css"}
{/if}

{if $addons.mcs_framework.mcs_product_tabs_vertical=='Y'}
	{style src="addons/mcs_framework/mcs_product_tabs/tabs_vertical.less"}
    
    {assign var="left_width" value=$addons.mcs_framework.mcs_product_tabs_width}
    
    {if $left_width<10 or $left_width>50}
    	{$left_width=36}
    {/if}
    
	{math equation="94 - x" x=$left_width assign="right_width"}
        
	<style>
		{literal}
		@media (min-width:768px){
			.tabs{
				width:{/literal}{$left_width}{literal}%;
			}
			.cm-tabs-content {
				width:{/literal}{$right_width}{literal}%;
			}
		}
		{/literal}
    </style>
{/if} 

{if $addons.mcs_framework.mcs_product_categories_hidden_info=='Y'}
	{style src="addons/mcs_framework/mcs_alpha_grid/mcs_hover_hide.css"}
{/if}

{style src="addons/mcs_framework/jquery_ui/jquery-ui-1.10.3.custom.css"}

{style src="addons/mcs_framework/mcs_alpha_menu/mcs_alpha_menu.css"}
{style src="addons/mcs_framework/mcs_alpha_grid/mcs_alpha_grid.css"}
{style src="addons/mcs_framework/mcs_alpha_grid/mcs_slides.css"}
{style src="addons/mcs_framework/mcs_alpha_grid/mcs_slides.less"}
{style src="addons/mcs_framework/mcs_product_tabs/mcs_tab_buttons.css"}
{style src="addons/mcs_framework/mcs_product_tabs/mcs_tab_buttons.less"}