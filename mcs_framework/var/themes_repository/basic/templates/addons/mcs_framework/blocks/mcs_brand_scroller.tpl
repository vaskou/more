{** block-description:mcs_brand_scroller **}
{assign var=params value=['filter_id' => "10",'variant_id' => '0','view_all' => "Y",'get_custom' => "Y"]}
{assign var=view_all_filter value=$params|fn_get_filters_products_count}
{*$view_all_filter|@print_r*}

{if $view_all_filter}
{assign var="filter_qstring" value=$smarty.request.q|fn_url}
{assign var="filter_qstring" value=$filter_qstring|fn_query_remove:"result_ids":"filter_id":"features_hash"}
{split data=$view_all_filter size="4" assign="splitted_filter" preverse_keys=true}
<div class="mcs-brand-scroller-{$block.snapping_id}">
    <ul id="brands_{$block.snapping_id}">
        {foreach from=$view_all_filter.1 item="ranges" key="index"}
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
    
    {if $block.properties.mcs_customControls=='true'}
    	<div id="c_controls">
        	<span id="slider-prev-{$block.snapping_id}"></span><span id="slider-next-{$block.snapping_id}"></span>
        </div>
        {assign var="mcs_nextSelector" value="#slider-next-{$block.snapping_id}"}
        {assign var="mcs_prevSelector" value="#slider-prev-{$block.snapping_id}"}
    {/if}
    
    {assign var="mcs_easings" value=['linear','ease','ease-in','ease-out','ease-in-out']}
    {$mcs_useCSS='false'}
    {foreach from=$mcs_easings item=easing}
    	{if $easing==$block.properties.mcs_easing}
        	{$mcs_useCSS='true'}
        {/if}
    {/foreach}
    
    {if $mcs_useCSS=="false"}
		{script src="js/addons/mcs_framework/mcs_sliders/bxslider/plugins/jquery.easing.1.3.js"}
	{/if}

<script type="text/javascript">
$(document).ready(function(){
	
	var slider=$('#brands_{$block.snapping_id}').bxSlider({
		mode:'{$block.properties.mcs_mode}',
		speed:{$block.properties.mcs_speed},
		slideMargin:{$block.properties.mcs_slideMargin},
		/*startSlide:{$block.properties.mcs_startSlide},*/
		/*randomStart:{$block.properties.mcs_randomStart},*/
		infiniteLoop:{$block.properties.mcs_infiniteLoop},
		hideControlOnEnd:{$block.properties.mcs_hideControlOnEnd},
		easing:'{$block.properties.mcs_easing}',
		useCSS:{$mcs_useCSS},
		/*captions:{$block.properties.mcs_captions},*/
		ticker:{$block.properties.mcs_ticker},
		tickerHover:{$block.properties.mcs_tickerHover},
		/*adaptiveHeight:{$block.properties.mcs_adaptiveHeight},
		adaptiveHeightSpeed:{$block.properties.mcs_adaptiveHeightSpeed},*/
		/*video:{$block.properties.mcs_video},*/
		responsive:{$block.properties.mcs_responsive},
		/*preloadImages:'{$block.properties.mcs_preloadImages}',*/
		/*touchEnabled:{$block.properties.mcs_touchEnabled},
		swipeThreshold:{$block.properties.mcs_swipeThreshold},
		oneToOneTouch:{$block.properties.mcs_oneToOneTouch},
		preventDefaultSwipeX:{$block.properties.mcs_preventDefaultSwipeX},
		preventDefaultSwipeY:{$block.properties.mcs_preventDefaultSwipeY},*/
		pager:{$block.properties.mcs_pager},
		/*pagerType:'{$block.properties.mcs_pagerType}',
		pagerShortSeparator:'{$block.properties.mcs_pagerShortSeparator}',
		pagerCustom:'{$mcs_pagerCustom}',*/
		
		controls:{$block.properties.mcs_controls},
		nextText:'{$block.properties.mcs_nextText}',
		prevText:'{$block.properties.mcs_prevText}',
		nextSelector:'{$mcs_nextSelector}',
		prevSelector:'{$mcs_prevSelector}',
		/*autoControls:{$block.properties.mcs_autoControls},
		autoControlsCombine:{$block.properties.mcs_autoControlsCombine},
		startText:'{$block.properties.mcs_startText}',
		stopText:'{$block.properties.mcs_stopText}',
		autoControlsSelector:'{$mcs_autoControlsSelector}',*/
		
		auto:{$block.properties.mcs_auto},
		pause:{$block.properties.mcs_pause},
		autoStart:{$block.properties.mcs_autoStart},
		autoDirection:'{$block.properties.mcs_autoDirection}',
		autoHover:{$block.properties.mcs_autoHover},
		autoDelay:{$block.properties.mcs_autoDelay},
		minSlides:{$block.properties.mcs_minSlides},
		maxSlides:{$block.properties.mcs_maxSlides},
		moveSlides:{$block.properties.mcs_moveSlides},
		slideWidth:{$block.properties.mcs_slideWidth},		
	});
  

	$("#mcs-tab-content-{$block.snapping_id}").parent(".mcs-tab-block").on("tabsactivate",function(event,ui){
		var active = $(this).tabs("option", "active");
			var id=$(this).children(".mcs-tab-content").eq(active).attr('id');
			console.log(id);
			if(id=="mcs-tab-content-{$block.snapping_id}"){
				slider.reloadSlider();	
			}
	});

	$("#mcs-accordion-content-{$block.snapping_id}").parent(".mcs-accordion-block").on("accordionactivate",function(event,ui){
		slider.reloadSlider();
	});
	
});
</script>
</div>
{/if}