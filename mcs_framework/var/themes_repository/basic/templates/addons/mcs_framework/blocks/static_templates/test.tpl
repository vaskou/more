{** block-description:mytest **}
{assign var=params value=['filter_id' => "10",'variant_id' => '0','view_all' => "Y",'get_custom' => "Y"]}
{assign var=view_all_filter value=$params|fn_get_filters_products_count}
{*$view_all_filter|@print_r*}

{if $view_all_filter}
{assign var="filter_qstring" value=$smarty.request.q|fn_url}
{assign var="filter_qstring" value=$filter_qstring|fn_query_remove:"result_ids":"filter_id":"features_hash"}
{split data=$view_all_filter size="4" assign="splitted_filter" preverse_keys=true}
<div class="mcs-brand-scroller">
    <ul id="brands">
        {foreach from=$splitted_filter.0.1 item="ranges" key="index"}
                {if $ranges}
                    {foreach from=$ranges item="range"}
                        {assign var="_features_hash" value=$params.features_hash|fn_add_range_to_url_hash:$range}
                        <li class="brand-box">
                            <a href="{if $range.feature_type == "E"}{"product_features.view?variant_id=`$range.range_id``$cur_features_hash`"|fn_url}{else}{"`$filter_qstring`&features_hash=`$_features_hash`"|fn_url}{/if}">
                                {assign var=variant_data value=$range.range_id|fn_get_product_feature_variant}
                                <div class="brand-image">
                                	{if $variant_data.image_pair}
                                    	{include file="common/image.tpl" images=$variant_data.image_pair}
                                	{/if}
                                </div>
                                
                                <span class="brand-name">
                                    {$range.range_name|fn_text_placeholders}
                                </span>
                            </a>
                        </li>
                    {/foreach}
                {else}&nbsp;{/if}
        {/foreach}
    </ul>

<script type="text/javascript">
$(document).ready(function(){
	$('#brands').bxSlider({
		maxSlides:4,
		slideWidth:220,
		
	});
	
});
</script>
</div>
{/if}