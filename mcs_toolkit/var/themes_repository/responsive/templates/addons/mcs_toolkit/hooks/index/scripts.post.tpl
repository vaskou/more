{script src="js/addons/mcs_toolkit/jquery.slides.js"}

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