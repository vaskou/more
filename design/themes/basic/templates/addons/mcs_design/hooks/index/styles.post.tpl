{*style src="addons/mcs_design/vars.less"*}
{*style src="addons/mcs_design/custom.less"*}
{*style src="addons/mcs_design/buttons.less"*}
{*style src="addons/mcs_design/top_menu.less"*}
{*style src="addons/mcs_design/sidebox.less"*}
{*style src="addons/mcs_design/tabs.less"*}
{*style src="addons/mcs_design/tables.less"*}
{*style src="addons/mcs_design/wishlist.less"*}
{*style src="addons/mcs_design/section.less"*}
{*style src="addons/mcs_design/checkout_cart.less"*}
{*style src="addons/mcs_design/dropdown_box.less"*}
{*style src="addons/mcs_design/popup.less"*}
{*style src="addons/mcs_design/ui.less"*}
{*style src="addons/mcs_design/dropdown_content.less"*}
{*style src="addons/mcs_design/input.less"*}

{if $addons.mcs_design.mcs_design_tabs_vertical=='Y'}
	{style src="addons/mcs_design/tabs_vertical.less"}
    
    {assign var="left_width" value=$addons.mcs_design.mcs_design_tabs_width}
    
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

{style src="addons/mcs_design/mcs_sistina.css"}
{style src="addons/mcs_design/mcs_hover_grid.css"}
{style src="addons/mcs_design/mcs_products_list.css"}
{style src="addons/mcs_design/mcs_slides.css"}
{style src="addons/mcs_design/mcs_slides.less"}

{*style src="addons/mcs_design/bootstrap_16.responsive.less"*}