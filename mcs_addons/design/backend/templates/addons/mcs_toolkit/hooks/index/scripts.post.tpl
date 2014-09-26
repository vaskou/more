{if $_REQUEST.dispatch=='addons.manage'}

	{assign var=mcs_addons value=array()|fn_get_addons:0:$smarty.const.DESCR_SL}

	{foreach from=$mcs_addons[0] key=key item=addon}
			
		{assign var=version value=$addon.addon|fn_get_addon_version}
		
		<script type="text/javascript">
			$(document).ready(function() {	
				var addon_dom_object = $('#addon_'+'{$addon.addon} .object-group-link-wrap');
				addon_dom_object.append('<br>Version: {$version}');
			});
		</script>   
	   
	{/foreach}
	
{/if}