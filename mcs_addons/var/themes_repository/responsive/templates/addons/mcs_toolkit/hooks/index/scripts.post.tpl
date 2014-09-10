{script src="js/addons/mcs_toolkit/jquery.slides.js"}

{* MCS-PRICE *}
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
			$('.ty-price').children('.ty-price-num').each(function(){
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
{* /MCS-PRICE *}

{if $mobiledetect.versionIE=='8.0'||$mobiledetect.versionIE=='9.0'}
	{script src="js/addons/mcs_toolkit/libs/media.match.min.js"}
    {script src="js/addons/mcs_toolkit/libs/html5shiv.js"}
{/if}
{script src="js/addons/mcs_toolkit/libs/enquire.min.js"}

{script src="js/addons/mcs_toolkit/mcs_responsive_menu_fix.js"}

{literal}
<script>
$(function(){
	enquire.register("screen and (min-width:768px)",[
			mcs_responsive_menu_fix_over_handler
		]
	);
	enquire.register("screen and (max-width:767px)",[
			
		]
	);
});
</script>
{/literal}


{* CUSTOM SCRIPTS *}
    
    {foreach from=$addons.mcs_toolkit.mcs_scripts key=k item=script}
    	{if $k != 'N'}
			{assign var=script_name value="_DOT_"|str_replace:".":$k}
    	    {script src="js/addons/mcs_toolkit/custom/`$script_name`"}
        {/if}
    {/foreach}
    
{* /CUSTOM SCRIPTS *}