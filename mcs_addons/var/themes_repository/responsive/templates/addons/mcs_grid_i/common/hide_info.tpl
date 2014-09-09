
{if $mcs_product_hidden_info_transition!='mcs_none'}
{literal}
<script>
$(function(){
	var trans={/literal}"{$mcs_product_hidden_info_transition}"{literal};
	var dur={/literal}{if $mcs_product_hidden_info_duration==''}0{else}{$mcs_product_hidden_info_duration}{/if}{literal};
	initBindings();
	
	$( document ).ajaxStop(function() 
	{
		initBindings();
	});
	
	function initBindings(){	
	
		enquire.register("screen and (min-width:768px)",{
			match:function(){
				$('.mcs-grid-i-list__item').hover_hide({transition:trans,duration:dur});
			}
		});
		enquire.register("screen and (max-width:767px)",{
			match:function(){
				hh=$('.mcs-grid-i-list__item').hover_hide({transition:trans,duration:dur,fade_other_elms:false});
				hh.disable();
			}
		});
	
	};
	
	
});
</script>
{/literal}
{/if}