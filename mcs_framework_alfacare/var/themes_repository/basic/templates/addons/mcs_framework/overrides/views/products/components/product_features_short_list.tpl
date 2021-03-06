{function name="feature_value"}
{strip}
{*$feature|var_dump*}
{if $feature.features_hash && $feature.feature_type == "E"}
	{assign var=variant_data value=$feature.variant_id|fn_get_product_feature_variant}
    {if $brand_feature}
    {if $variant_data.image_pair}
    <span class="brand-image">
        <a href="{"categories.view?category_id=`$product.main_category`&features_hash=`$feature.features_hash`"|fn_url}">
            {include file="common/image.tpl" images=$variant_data.image_pair}
        </a>
    </span>
    {/if}
    <span class="brand-name">
        {$feature.description}:
    {/if}
    	
        <a href="{"categories.view?category_id=`$product.main_category`&features_hash=`$feature.features_hash`"|fn_url}">
        	{if $addons.mcs_framework.mcs_grs_product_brand=="Y" && $addons.mcs_framework.mcs_product_brand_feature==$feature.feature_id}<span itemprop="brand">{/if}
{/if}
{if $feature.prefix}{$feature.prefix}{/if}
{if $feature.feature_type == "D"}
    {$feature.value_int|date_format:"`$settings.Appearance.date_format`"}
{elseif $feature.feature_type == "M"}
    {foreach from=$feature.variants item="fvariant" name="ffev"}
        {$fvariant.variant|default:$fvariant.value}{if !$smarty.foreach.ffev.last}, {/if}
    {/foreach}
{elseif $feature.feature_type == "S" || $feature.feature_type == "N" || $feature.feature_type == "E"}
    {$feature.variant|default:$feature.value}
{elseif $feature.feature_type == "C"}
    {$feature.description}
{elseif $feature.feature_type == "O"}
    {$feature.value_int|floatval}
{else}
    {$feature.value}
{/if}
{if $feature.suffix}{$feature.suffix}{/if}
{if $feature.feature_type == "E" && $feature.features_hash}
			{if $addons.mcs_framework.mcs_grs_product_brand=="Y" && $addons.mcs_framework.mcs_product_brand_feature==$feature.feature_id}</span>{/if}
    	</a>
    {if $brand_feature}
    </span>
    {/if}
{/if}
{/strip}
{/function}

{if $features}
{if !$no_container}<p class="features-list description">{/if}
    {foreach from=$features name=features_list item=feature}
        {if $feature.feature_type == "D" || $feature.feature_type == "O" || $feature.feature_type == "N"}
            {$feature.description nofilter}: 
        {/if}
        {if $addons.mcs_framework.mcs_product_brand_show=='Y' || $addons.mcs_framework.mcs_product_brand_feature!=$feature.feature_id}
        	{assign var="brand_feature" value=true}
        {else}
        	{assign var="brand_feature" value=false}
        {/if}
        {feature_value feature=$feature}{if !$smarty.foreach.features_list.last}{if $feature.feature_type != "E" || !$brand_feature}, {/if}{/if}
    {/foreach}
{if !$no_container}</p>{/if}
{/strip}
{/if}

{*********************************************MCS changes************************************************}
{*Line   4-19: added lines 4 to 19																		*}
{*Line  38-40: added lines 38 to 44																		*}
{*Line  54-59: added lines 54 to 59																		*}