<div class="control-group mcs_devices">
    <label class="control-label" for="block_{$html_id}_devices">{__("devices")}</label>
    <div class="controls">
    
        <input type="checkbox" id="block_{$html_id}_computer" name="block_data[properties][devices][computer]"  size="25" value="T" {if !$block.properties.devices}checked{/if} {if !$block.properties.devices.computer==''}checked{/if} /><span>Computer</span><br/>
        <input type="checkbox" id="block_{$html_id}_tablet" name="block_data[properties][devices][tablet]"  size="25" value="T" {if !$block.properties.devices}checked{/if} {if !$block.properties.devices.tablet==''}checked{/if} /><span>Tablet</span><br/>
        <input type="checkbox" id="block_{$html_id}_phone" name="block_data[properties][devices][phone]"  size="25" value="T" {if !$block.properties.devices}checked{/if} {if !$block.properties.devices.phone==''}checked{/if} /><span>Phone</span>
    
    </div>
</div>

{*********************************************CSP comments***********************************************}
{*This is hooked in files /design/backend/templates/views/block_manager/update.tpl at line 162			*}
{*This is hooked in files /design/backend/templates/views/block_manager/update_block.tpl at line 129	*}