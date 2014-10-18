<div class="control-group">
    <label class="control-label" for="elm_company_connected_brand">{__("brand")}:</label>
    <div class="controls">
    {assign var=params value=['feature_id'=>$addons.mcs_getaquote.mcs_features_list]}
    {assign var=brands value=$params|fn_get_product_feature_variants}
    <select name="company_data[mcs_connected_brand]" id="elm_company_connected_brand">
    		<option value="" {if $company_data.mcs_connected_brand=""}selected="selected"{/if}>{__('none')}</option>
        {foreach from=$brands.0 item="brand" key="brand_id"}
            <option value="{$brand_id}" {if $brand_id == $company_data.mcs_connected_brand}selected="selected"{/if}>{$brand.variant}</option>
        {/foreach}
    </select>
    </div>
</div>