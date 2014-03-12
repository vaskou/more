{if !$hide_title}<h1 class="mainbox-title">{$product.product nofilter}</h1>{/if}

<div class="mcs_labels_wrapper details_page">
	{if $addons.mcs_framework.mcs_labels_new_details=='Y'}
		{assign var=days value=$addons.mcs_framework.mcs_labels_new_days*86400} 
		{if $smarty.now-$product.timestamp<$days}
			{include file="addons/mcs_framework/views/mcs_labels/new_product_label.tpl"}
		{/if}
	{/if}

	{if $addons.mcs_framework.mcs_labels_free_shipping_details=='Y'&&$product.free_shipping=='Y'}
		{include file="addons/mcs_framework/views/mcs_labels/free_shipping_label.tpl"}
	{/if}

	{if $addons.mcs_framework.mcs_labels_out_of_stock_details=='Y'&&$product.amount=='0'}
		{include file="addons/mcs_framework/views/mcs_labels/out_of_stock_label.tpl"}
	{/if}

	{if $addons.mcs_framework.mcs_labels_downloadable_details=='Y'&&$product.is_edp=='Y'}
		{include file="addons/mcs_framework/views/mcs_labels/downloadable_label.tpl"}
	{/if}
</div>

<div class="brand-wrapper">
{include file="views/products/components/product_features_short_list.tpl" features=$product.header_features}
</div>

