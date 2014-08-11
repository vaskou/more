<input type="hidden" name="products_data[{$product.product_id}][mcs_lock_sync_product]" value="N" />
{*$product|var_dump*}
<input type="checkbox" name="products_data[{$product.product_id}][mcs_lock_sync_product]" value="Y" {if $product.mcs_lock_sync_product == "Y"}checked="checked"{/if} />






