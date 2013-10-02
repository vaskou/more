<div class="control-group mcs_side">
    <label class="control-label" for="block_{$html_id}_icon_class_pre">User-defined icon before header</label>
    <div class="controls">
    <input type="text" name="snapping_data[icon_class_pre]" id="block_{$html_id}_icon_class_pre" size="25" value="{$block.icon_class_pre}"/>
    </div>
</div>
<div class="control-group mcs_side">
    <label class="control-label" for="block_{$html_id}_icon_class_post">User-defined icon after header</label>
    <div class="controls">
    <input type="text" name="snapping_data[icon_class_post]" id="block_{$html_id}_icon_class_post" size="25" value="{$block.icon_class_post}"/>
    </div>
</div>

{literal}
<script>
$(function(){
	
	check_selected();
	
	$('#{/literal}block_{$html_id}_wrapper{literal}').change(function(){
    	check_selected();
    });
	
	function check_selected()
	{
		if($('#{/literal}block_{$html_id}_wrapper{literal} option:selected').text()=='Sidebox general')
        {
        	$('.mcs_side').show();
        }
        else
        {
        	$('.mcs_side').hide();
        }	
	}
});
</script>
{/literal}
{*********************************************CSP comments***********************************************}
{*This is hooked in files /design/backend/templates/views/block_manager/update.tpl at line 162			*}
{*This is hooked in files /design/backend/templates/views/block_manager/update_block.tpl at line 129	*}