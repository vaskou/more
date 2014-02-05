{literal}
<script>
$(function(){

});
function deviceType(){
	/*if ( (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i)) ) {*/
	
	var dt={/literal}{$mobiledetect.deviceType|var_export}{literal};
	
	return dt;
	
}
</script>
{/literal}
{script src="js/addons/mcs_framework/jquery.widthCheck.js"}

{if $addons.mcs_framework.mcs_bxslider=='Y'}
	{script src="js/addons/mcs_framework/libs/html5shiv.js"}
	{script src="js/addons/mcs_framework/mcs_sliders/bxslider/jquery.bxslider.min.js"}
{/if}

{if $addons.mcs_framework.mcs_general_fixed_menu_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_fixed_menu.js"}
{/if}

{if $addons.mcs_framework.mcs_product_categories_hidden_info!='mcs_none'}
	{script src="js/addons/mcs_framework/mcs_alpha_grid/jquery.hover_hide.js"}
{/if}

{script src="js/addons/mcs_framework/jquery_ui/jquery-ui-1.10.3.custom.min.js"}

{if $addons.mcs_framework.mcs_tab_block_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_tab_block/mcs_tab_block.js"}
{/if}

{if $addons.mcs_framework.mcs_accordion_block_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_accordion_block/mcs_accordion_block.js"}
{/if}

{script src="js/addons/mcs_framework/mcs_alpha_grid/jquery.slides.js"}
{script src="js/addons/mcs_framework/mcs_alpha_grid/mcs_alpha_grid.js"}
{script src="js/addons/mcs_framework/mcs_submenu_visible.js"}

{if $addons.mcs_framework.mcs_scroll_to_top_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_scroll_to_top/jquery.scrollUp.min.js"}
{/if}


{script src="js/addons/mcs_framework/mcs_alpha_menu/mcs_click_on_tablets.js"}

{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
	{script src="js/addons/mcs_framework/mcs_sidebox_hide.js"}
{/if}
