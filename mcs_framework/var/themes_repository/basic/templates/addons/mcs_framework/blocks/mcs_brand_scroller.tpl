{** block-description:mcs_brand_scroller **}

{if $items}
<div class="mcs-brand-scroller-{$block.snapping_id}">
    <ul id="brands_{$block.snapping_id}">
        {foreach from=$items item="brand"}
        <li class="brand-box">
            <a href="{"product_features.view?variant_id=`$brand.variant_id`"|fn_url}">

                <div class="brand-image">
                        {include file="common/image.tpl" images=$brand.image_pair}
                </div>
                
                <span class="brand-name">
                    {$brand.variant|fn_text_placeholders}
                </span>
            </a>
        </li>
        {/foreach}
    </ul>
    
    {if $block.properties.mcs_customControls=='true'}
    	<div id="c_controls">
        	<span id="slider-prev-{$block.snapping_id}"></span><span id="slider-next-{$block.snapping_id}"></span>
        </div>
        {assign var="mcs_nextSelector" value="#slider-next-{$block.snapping_id}"}
        {assign var="mcs_prevSelector" value="#slider-prev-{$block.snapping_id}"}
    {/if}
    
    {assign var="filter_data" value=$addons.mcs_framework.mcs_product_brand_feature|fn_mcs_product_get_feature_filter}
    {assign var="filter_id" value=$filter_data|key}
    {assign var="filter_name" value=$filter_data[$filter_id]}
    {if $block.properties.mcs_brand_scroller_button=='Y'}
    	<div class="mcs-brand-scroller-button">
    		<a href="index.php?dispatch=product_features.view_all&filter_id={$filter_id}"><i class="{$block.properties.mcs_brand_scroller_button_icon}"></i>{$filter_name}</a>
	    </div>
    {/if}
    
    {assign var="mcs_easings" value=['linear','ease','ease-in','ease-out','ease-in-out']}
    {$mcs_useCSS='false'}
    {foreach from=$mcs_easings item=easing}
    	{if $easing==$block.properties.mcs_easing}
        	{$mcs_useCSS='true'}
        {/if}
    {/foreach}
    
    {if $mcs_useCSS=="false"}
		{script src="js/addons/mcs_framework/libs/jquery.easing.1.3.js"}
	{/if}

<script type="text/javascript">
$(document).ready(function(){
	var deviceType='{$mobiledetect.deviceType}';
	var pagerValue={$block.properties.mcs_pager};
	var maxSlidesValue={$block.properties.mcs_maxSlides};
	var slideWidthValue={$block.properties.mcs_slideWidth};
	{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
		if(deviceType=='phone'){
			pagerValue=false;
			maxSlidesValue=1;
			slideWidthValue=500;
		}
	{/if}
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
		pager:pagerValue,
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
		maxSlides:maxSlidesValue,
		moveSlides:{$block.properties.mcs_moveSlides},
		slideWidth:slideWidthValue,		
	});
  

	$("#mcs-block-grouping-content-{$block.snapping_id}").parent(".mcs-tabs-grid").on("tabsactivate",function(event,ui){
		var active = $(this).tabs("option", "active");
		var id=$(this).children(".mcs-block-grouping-content").eq(active).attr('id');
		//console.log(id);
		if(id=="mcs-block-grouping-content-{$block.snapping_id}"){
			slider.reloadSlider();	
		}
	});

	$("#mcs-block-grouping-content-{$block.snapping_id}").parent(".mcs-accordion-grid").on("accordionactivate",function(event,ui){
		slider.reloadSlider();
	});
	
});
</script>
</div>
{/if}