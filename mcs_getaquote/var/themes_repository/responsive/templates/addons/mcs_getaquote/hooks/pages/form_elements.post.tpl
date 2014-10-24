{if $mcs_last_key==$element_id}
	<h3>Products</h3>

	{assign var=product_data value=$mcs_product_data|json_decode:true}

	{*$product_data|var_dump*}
    {foreach from=$product_data key="product_id" item="product"}
    	<div class="ty-column6">
        	<div class="ty-grid-list__item">
	    		<div class="ty-grid-list__image" style="min-height:0;padding:0;">
    		        {include file="views/products/components/product_icon.tpl" product=$product}
	    	    </div>
            </div>
        </div>
        <input type="hidden" name="form_values[products][{$product_id}]" value="{$product.main_pair.detailed.http_image_path}" />
    {/foreach}
    
    <input type="hidden" name="form_values[mcs_form_type]" value="true" />
{/if}