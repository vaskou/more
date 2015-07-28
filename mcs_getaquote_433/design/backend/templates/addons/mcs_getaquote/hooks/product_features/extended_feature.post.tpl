<div class="control-group">
    <label class="control-label" for="elm_company_connected_brand">{__("brand")}:</label>
    <div class="controls">
    {assign var=params value=['status'=>'A']}
    {assign var=companies value=$params|fn_get_short_companies}
    <select name="feature_data[variants][{$num}][mcs_connected_company]" id="elm_company_connected_brand">
    		<option value="0" {if $var.mcs_connected_company=="0"}selected="selected"{/if}>{__('none')}</option>
        {foreach from=$companies.0.companies item="company" key="company_id"}
            <option value="{$company_id}" {if $company_id == $var.mcs_connected_company}selected="selected"{/if}>{$company}</option>
        {/foreach}
    </select>
    </div>
</div>