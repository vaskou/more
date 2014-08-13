{assign var=all_child_shops value=""|fn_get_child_shops}
{assign var=product_child_shops value=$product_data.product_id|fn_get_product_child_shops}
	
<div id="acc_mcs_child_sync" class="collapse in" style="background:#e5e5e5;">

	<div class="control-group">
		<label class="control-label" for="elm_product_mcs_child_sync_product_force">{__("mcs_child_sync_product_force")}:</label>
		<div class="controls">
			<label class="checkbox">
				<input type="hidden" name="product_data[mcs_child_sync_product_force]" value="N" />
				<input type="checkbox" name="product_data[mcs_child_sync_product_force]" id="elm_product_mcs_child_sync_product_force" value="Y" />
			</label>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="elm_product_mcs_child_sync_product">{__("mcs_child_sync_product")}:</label>
		<div class="controls">
			<label class="checkbox">
				<input type="hidden" name="product_data[mcs_child_sync_product]" value="N" />
				<input type="checkbox" name="product_data[mcs_child_sync_product]" id="elm_product_mcs_child_sync_product" value="Y" {if $product_data.mcs_child_sync_product == "Y"}checked="checked"{/if} />
			</label>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="elm_product_mcs_child_sync_images">{__("mcs_child_sync_images")}:</label>
		<div class="controls">
			<label class="checkbox">
				<input type="hidden" name="product_data[mcs_child_sync_images]" value="N" />
				<input type="checkbox" name="product_data[mcs_child_sync_images]" id="elm_product_mcs_child_sync_images" value="Y" {if $product_data.mcs_child_sync_images == "Y"}checked="checked"{/if} />
			</label>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="elm_product_mcs_child_sync_files">{__("mcs_child_sync_files")}:</label>
		<div class="controls">
			<label class="checkbox">
				<input type="hidden" name="product_data[mcs_child_sync_files]" value="N" />
				<input type="checkbox" name="product_data[mcs_child_sync_files]" id="elm_product_mcs_child_sync_files" value="Y" {if $product_data.mcs_child_sync_files == "Y"}checked="checked"{/if} />
			</label>
		</div>
	</div>
	

	<div class="control-group">
		<label for="child_shops" class="control-label">{__("mcs_child_shops_include")}:</label>
		<div class="controls">
			<select name="product_data[mcs_child_shops_domains][]" id="child_shops" multiple="multiple" size="5">
				{foreach from=$all_child_shops[0] item=child_shop}
					<option value="{$child_shop.domain}" {if $product_child_shops && in_array($child_shop.domain,$product_child_shops)} selected="selected"{/if}>{$child_shop.domain}</option>
				{/foreach}
			</select>
		</div>
	</div>
	
	<div class="control-group {$no_hide_input_if_shared_product}">
		<label for="product_description_child_product" class="control-label">{__("mcs_child_product_name")}</label>
		<div class="controls">
			<input class="input-large" form="form" type="text" name="product_data[mcs_child_product]" id="product_description_child_product" size="55" value="{$product_data.mcs_child_product}" />
			{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='product' name="update_all_vendors[product]"}
		</div>
	</div>

	<div class="control-group cm-no-hide-input">
		<label class="control-label" for="elm_child_product_full_descr">{__("mcs_child_full_description")}:</label>
		<div class="controls">
			{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='full_description' name="update_all_vendors[full_description]"}
			<textarea id="elm_child_product_full_descr" name="product_data[mcs_child_full_description]" cols="55" rows="8" class="cm-wysiwyg input-large">{$product_data.mcs_child_full_description}</textarea>
		</div>
	</div>

</div>