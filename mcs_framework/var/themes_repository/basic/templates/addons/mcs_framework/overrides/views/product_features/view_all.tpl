{if $view_all_filter}
{assign var="filter_qstring" value=$smarty.request.q|fn_url}
{assign var="filter_qstring" value=$filter_qstring|fn_query_remove:"result_ids":"filter_id":"features_hash"}
{split data=$view_all_filter size="1" assign="splitted_filter" preverse_keys=true}
    {if $smarty.request.filter_id==10}
    	<div class="mcs-brands-page">
        	<div class="mcs-list-filter">
                <ul>
                	<li id="li-ALL"><a href="#">ALL</a></li>
                {foreach from=$view_all_filter item="ranges" key="index"}
                    <li id="li-{$index}"><a href="#">{$index}</a></li>
                {/foreach}
                <div class="clearfix"></div>
                </ul>
            </div>
        	{foreach from=$view_all_filter item="ranges" key="index"}
            <div class="mcs-brands-row row-fluid li-{$index}">
                {if $ranges}
                    <h2 id="{$index}" class="subheader">{$index}</h2>
                    <ul class="brand-list">
                    {assign var='i' value=0}
                    {foreach from=$ranges item="range"}
                        {assign var="_features_hash" value=$params.features_hash|fn_add_range_to_url_hash:$range}
                        <li class="brand-box span4 {if $i!=4}{assign var='i' value=$i+1}{else}{$i=0}first{/if}">
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
                </ul>
                {else}&nbsp;{/if}
            </div>
      
        	{/foreach}
        </div>
        {literal}
        	<script>
				$(function(){
					$(".mcs-list-filter ul li").click(function(){
						a=$(this).attr('id');
						$(".mcs-brands-row").show();
						if(a!="li-ALL"){
							$(".mcs-brands-row").not("."+a).hide();
						}
					});
				});
			</script>
        {/literal}       
    {else}
        <table class="view-all table-width">
        {foreach from=$splitted_filter item="group"}
        <tr class="valign-top">
            {foreach from=$group item="ranges" key="index"}
            <td class="center" style="width: 25%">
                <div>
                    {if $ranges}
                        {include file="common/subheader.tpl" title=$index}
                        <ul>
                        {foreach from=$ranges item="range"}
                            {assign var="_features_hash" value=$params.features_hash|fn_add_range_to_url_hash:$range}
                            <li><a href="{if $range.feature_type == "E"}{"product_features.view?variant_id=`$range.range_id``$cur_features_hash`"|fn_url}{else}{"`$filter_qstring`&features_hash=`$_features_hash`"|fn_url}{/if}">{$range.range_name|fn_text_placeholders}</a></li>
                        {/foreach}
                    </ul>
                    {else}&nbsp;{/if}
                </div>
            </td>
            {/foreach}
        </tr>
        {/foreach}
        </table>
    {/if}
{/if}