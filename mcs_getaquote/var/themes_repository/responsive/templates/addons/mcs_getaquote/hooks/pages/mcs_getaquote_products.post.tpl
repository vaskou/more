<div class="ty-control-group">
	<h3>Products</h3>

	{assign var=product_data value=$mcs_product_data|json_decode:true}

	{*$product_data|var_dump*}
    {foreach from=$product_data key="product_id" item="product"}
    	<div class="ty-column6">
        	<div class="ty-grid-list__item">
	    		<div class="ty-grid-list__image" style="min-height:0;padding:0;">
    		        {include file="views/products/components/product_icon.tpl" product=$product }
	    	    </div>
            </div>
        </div>
        {*$product|var_dump*}
        {*<input type="hidden" name="form_values[products][{$product_id}][product_name]" value="{$product.product_name}" />
        <input type="hidden" name="form_values[products][{$product_id}][image]" value="{$product.main_pair.detailed.http_image_path}" />
        <input type="hidden" name="form_values[products][{$product_id}][product_code]" value="{$product.product_code}" />*}
        <input type="hidden" name="form_values[products][{$product_id}]" value="{$product|json_encode}" />
    {/foreach}
    
    <input type="hidden" name="form_values[mcs_form_type]" value="true" />
    <input type="hidden" name="mcs_last_key" value="{$mcs_last_key}" />
    <input type="hidden" name="mcs_product_data" value="{$mcs_product_data}" />
    <input type="hidden" name="mcs_variant_id" value="{$mcs_variant_id}" />
	<input type="hidden" name="form_values[mcs_vendor_id]" value="{$mcs_vendor_id}" />
</div>