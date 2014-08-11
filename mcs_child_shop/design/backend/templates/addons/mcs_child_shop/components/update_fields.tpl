<div id="acc_mcs_lock_sync" class="collapse in" style="background:#e5e5e5;">

	<div class="control-group">
		<label class="control-label" for="elm_product_mcs_lock_sync_product">{__("mcs_lock_sync_product")}:</label>
		<div class="controls">
			<label class="checkbox">
				<input type="hidden" name="product_data[mcs_lock_sync_product]" value="N" />
				<input type="checkbox" name="product_data[mcs_lock_sync_product]" id="elm_product_mcs_lock_sync_product" value="Y" {if $product_data.mcs_lock_sync_product == "Y"}checked="checked"{/if} />
			</label>
		</div>
	</div>

</div>