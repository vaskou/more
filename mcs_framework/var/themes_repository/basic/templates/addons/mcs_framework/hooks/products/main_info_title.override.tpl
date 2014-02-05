{if !$hide_title}<h1 class="mainbox-title"{if $addons.mcs_framework.mcs_grs_product=="Y"} itemprop="name"{/if}>{$product.product nofilter}</h1>{/if}

{if $addons.discussion.status=="A"}
	{include file="addons/mcs_framework/views/components/mcs_average_rating.tpl"}
{/if}

{if $addons.mcs_framework.mcs_grs_product_category=="Y"}
	{include file="addons/mcs_framework/views/components/mcs_product_category.tpl"}
{/if}

<div class="brand-wrapper">
{include file="views/products/components/product_features_short_list.tpl" features=$product.header_features}
</div>