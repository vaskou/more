
{if $mcs_product_hidden_info_transition!='mcs_none'}
{literal}
<script>
$(function(){
	var trans_{/literal}{$block.block_id}{literal}={/literal}"{$mcs_product_hidden_info_transition}"{literal};
	var dur_{/literal}{$block.block_id}{literal}={/literal}{if $mcs_product_hidden_info_duration==''}0{else}{$mcs_product_hidden_info_duration}{/if}{literal};
	initBindings();
	
	$( document ).ajaxStop(function() 
	{
		initBindings();
	});
	
	function initBindings(){	
	
		enquire.register("(min-width:768px)",{
			match:function(){
				$('#mcs_grid_i_list_{/literal}{$block.block_id}{literal} .mcs-grid-i-list__item').hover_hide({transition:trans_{/literal}{$block.block_id}{literal},duration:dur_{/literal}{$block.block_id}{literal}});
			}
		});
		enquire.register("(max-width:767px)",{
			match:function(){
				hh=$('#mcs_grid_i_list_{/literal}{$block.block_id}{literal} .mcs-grid-i-list__item').hover_hide({transition:trans_{/literal}{$block.block_id}{literal},duration:dur_{/literal}{$block.block_id}{literal},fade_other_elms:false});
				hh.disable();
			}
		});
	
	};
	
	
});
</script>
{/literal}
{/if}