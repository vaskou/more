<div class="control-group">
	<label>Products</label>

	{assign var=product_data value=$mcs_product_data|json_decode:true}

    {foreach from=$product_data key="product_id" item="product"}
    	<div class="ty-column6">
        	<div class="ty-grid-list__item">
	    		<div class="ty-grid-list__image mcs-vendor-list__image">
                    {include file="common/image.tpl" images=$product.main_pair image_width=50 image_height=50}
	    	    </div>
            </div>
        </div>
        <input type="hidden" name="form_values[products][{$product_id}]" value="{$product|json_encode}" />
    {/foreach}
    
    <input type="hidden" name="form_values[mcs_form_type]" value="true" />
    <input type="hidden" name="mcs_last_key" value="{$mcs_last_key}" />
    <input type="hidden" name="mcs_product_data" value="{$mcs_product_data}" />
    <input type="hidden" name="mcs_variant_id" value="{$mcs_variant_id}" />
	<input type="hidden" name="form_values[mcs_vendor_id]" value="{$mcs_vendor_id}" />
</div>