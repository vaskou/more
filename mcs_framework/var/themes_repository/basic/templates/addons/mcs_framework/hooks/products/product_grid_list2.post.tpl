<div class="mcs_labels_wrapper  list_template">
	{if $addons.mcs_framework.mcs_labels_new_grid=='Y'}
		{assign var=days value=$addons.mcs_framework.mcs_labels_new_days*86400} 
		{if $smarty.now-$product.timestamp<$days}
			{include file="addons/mcs_framework/views/mcs_labels/new_product_label.tpl"}
		{/if}
	{/if}

	{if $addons.mcs_framework.mcs_labels_free_shipping_grid=='Y'&&$product.free_shipping=='Y'}
		{include file="addons/mcs_framework/views/mcs_labels/free_shipping_label.tpl"}
	{/if}

	{if $addons.mcs_framework.mcs_labels_out_of_stock_grid=='Y'&&$product.amount=='0'}
		{include file="addons/mcs_framework/views/mcs_labels/out_of_stock_label.tpl"}
	{/if}

	{if $addons.mcs_framework.mcs_labels_downloadable_grid=='Y'&&$product.is_edp=='Y'}
		{include file="addons/mcs_framework/views/mcs_labels/downloadable_label.tpl"}
	{/if}
</div>