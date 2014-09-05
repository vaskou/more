{if $brand_id == "0"}
    {assign var="brand" value=$default_name}
{else}

    {assign var="brand" value=$brand_id|fn_get_brand_name:$block.properties.mcs_brand_scroller_brand_feature_id|default:"`$ldelim`brand`$rdelim`"}
{/if}

<tr {if !$clone}id="{$holder}_{$brand_id}" {/if}class="cm-js-item{if $clone} cm-clone hidden{/if}">
    {if $position_field}
        <td>
            <input type="text" name="{$input_name}[{$brand_id}]" value="{math equation="a*b" a=$position b=10}" size="3" class="input-text-short" {if $clone}disabled="disabled"{/if} />
        </td>
    {/if}
    <td>{$brand}</td>
    <td>
        {capture name="tools_list"}
            {if !$hide_delete_button && !$view_only}
                <li><a onclick="Tygh.$.cePicker('delete_js_item', '{$holder}', '{$brand_id}', 'b'); return false;">{__("delete")}</a></li>
            {/if}
        {/capture}
        <div class="hidden-tools">
            {dropdown content=$smarty.capture.tools_list}
        </div>
    </td>
</tr>