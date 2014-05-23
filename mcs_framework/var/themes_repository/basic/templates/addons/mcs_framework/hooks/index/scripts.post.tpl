{*script src="js/addons/mcs_framework/countCSSRules.js"*}
{literal}
<script>
$(function(){
//countCSSRules();
	
});
function deviceType(){
	var dt={/literal}{$mobiledetect.deviceType|var_export}{literal};
	return dt;	
}
</script>
{/literal}

{if $addons.mcs_framework.mcs_general_appearance_price=='Y'}
    {literal}
    <script>
    $(function(){
		
		initBindings();
		$(document).ajaxStop(function() {
			initBindings();
		});
		
		function initBindings(){
			{/literal}
			var both_cur=false;
			{if $settings.General.alternative_currency == "use_selected_and_alternative"}
				var both_cur=true;
			{/if}
			var secondary_cur_delim="{$currencies.$secondary_currency.decimals_separator}";	
			{literal}
			
			if(both_cur==false){
				$('.price').children('.price-num').each(function(){
					if($(this).attr('id'))
					{
						price=$(this).text().split(secondary_cur_delim);
						price_str="<span class='decim'>"+secondary_cur_delim+price[1]+"</span>"
						$(this).text(price[0]).append(price_str);
					}
				});
			}
		}
    });
    </script>
    {/literal}
{/if}

{*script src="js/addons/mcs_framework/jquery.widthCheck.js"*}
{if $mobiledetect.versionIE=='8.0'||$mobiledetect.versionIE=='9.0'}
	{script src="js/addons/mcs_framework/libs/media.match.min.js"}
    {script src="js/addons/mcs_framework/libs/html5shiv.js"}
{/if}
{script src="js/addons/mcs_framework/libs/enquire.min.js"}

{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
    {literal}
    <script>
    $(function(){
        enquire.register("screen and (min-width:{/literal}{$layout_data.max_width + 1}{literal}px)",[
				{/literal}{if $addons.mcs_framework.mcs_general_fixed_menu_enable=='Y'}{literal}
                	fixed_menu_over_handler
				{/literal}{/if}{literal}
            ]
        );
        enquire.register("screen and (max-width:{/literal}{$layout_data.max_width}{literal}px)",[
                {/literal}{if $addons.mcs_framework.mcs_general_fixed_menu_enable=='Y'}{literal}
					fixed_menu_under_handler
				{/literal}{/if}{literal}
            ]
        );
		enquire.register("screen and (min-width:768px)",[
				sidebox_hide_over_handler,
				sidebox_filters_show_over_handler,
				tables_responsive_over_handler
			]
		);
		enquire.register("screen and (max-width:767px)",[
				sidebox_hide_under_handler,
				sidebox_filters_show_under_handler,
				tables_responsive_under_handler
			]
		);
    });
    </script>
    {/literal}
{else}
    {literal}
    <script>
    $(function(){
		{/literal}
		{if $addons.mcs_framework.mcs_general_fixed_menu_enable=='Y'}
			{literal}
        		fn_fixed_menu_over();
			{/literal}
		{/if}
		{literal}
		fn_sidebox_hide_over();
		fn_sidebox_filters_show_over();
    });
    </script>
    {/literal}
{/if}


{if $addons.mcs_framework.mcs_general_bxslider_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_sliders/bxslider/jquery.bxslider.min.js"}
{/if}

{if $addons.mcs_framework.mcs_general_fixed_menu_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_fixed_menu.js"}
{/if}

{if $addons.mcs_framework.mcs_product_categories_hidden_info!='mcs_none'}
	{script src="js/addons/mcs_framework/mcs_i_grid/jquery.hover_hide.js"}
{/if}

{script src="js/addons/mcs_framework/mcs_i_grid/jquery.slides.js"}
{script src="js/addons/mcs_framework/mcs_submenu_visible.js"}
{script src="js/addons/mcs_framework/mcs_sidebox_hide.js"}
{script src="js/addons/mcs_framework/mcs_sidebox_filters_show.js"}
{script src="js/addons/mcs_framework/mcs_tables_responsive.js"}

{if $addons.mcs_framework.mcs_scroll_to_top_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_scroll_to_top/jquery.scrollUp.min.js"}
{/if}


{script src="js/addons/mcs_framework/mcs_i_menu/mcs_click_on_tablets.js"}

{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
	
{/if}

{******************* THEME SCRIPTS FILE ***********************}

{if file_exists("js/theme_scripts/theme_scripts.tpl")}
	{include file="js/theme_scripts/theme_scripts.tpl"}
{/if}