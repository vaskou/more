{** block-description:description **}
{if $addons.mcs_framework.mcs_grs_product_descr=="Y"}<div itemprop="description">{/if}
	{$product.full_description|default:$product.short_description nofilter}
{if $addons.mcs_framework.mcs_grs_product_descr=="Y"}</div>{/if}

{*********************************************MCS changes************************************************}
{*Line   2: added line																					*}
{*Line   4: added line																					*}