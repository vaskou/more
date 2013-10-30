{** block-description:mcs_enfold_scroller **}
{*style src='addons/mcs_framework/mcs_sliders/bxslider/bxslider.pager.css'*}

{if $items}
    {include file="addons/mcs_master/blocks/mcs_scroller_template/mcs_enfold_scroller.tpl" 
    products=$items 
    show_trunc_name=true 
    show_old_price=true 
    show_price=true 
    show_clean_price=true 
    show_list_discount=true 
    show_add_to_cart=$show_add_to_cart|default:true 
    but_role="action" 
    show_features=true
    show_rating=true}
    
    {if $block.properties.mcs_customAutoControls=='true'}
    	<div id="autoCtrl"></div>
        {assign var="mcs_autoControlsSelector" value="#autoCtrl"}
    {/if}
    
    {if $block.properties.mcs_customControls=='true'}
    	<div>
        	<p><span id="slider-prev"></span> | <span id="slider-next"></span></p>
        </div>
        {assign var="mcs_nextSelector" value="#slider-next"}
        {assign var="mcs_prevSelector" value="#slider-prev"}
    {/if}
    
    {if $block.properties.mcs_pagerThumbs=='true'}
    	<div id="bx-pager_{$block.snapping_id}">
        	{foreach from=$items item="banner" key="key" name="foo"}
            	{if $banner.type == "G" && $banner.main_pair.image_id}
                	<a data-slide-index="{$smarty.foreach.foo.index}" href="">
                    	<div>
                        	{include file="common/image.tpl" images=$banner.main_pair}
                        </div>
                    </a>
                {else}
                	<a data-slide-index="{$smarty.foreach.foo.index}" href="">
                    	<div class="wysiwyg-content">
                        	{$banner.description nofilter}
                    	</div>
                    </a>
                {/if}
        	{/foreach}
		</div>
        {capture name="mcs_pagerCustom"}#bx-pager_{$block.snapping_id}{/capture}
        {assign var="mcs_pagerCustom" value=$smarty.capture.mcs_pagerCustom}
    {/if}
    
    {assign var="mcs_easings" value=['linear','ease','ease-in','ease-out','ease-in-out']}
    {$mcs_useCSS='false'}
    {foreach from=$mcs_easings item=easing}
    	{if $easing==$block.properties.mcs_easing}
        	{$mcs_useCSS='true'}
        {/if}
    {/foreach}
    
{/if}

{*$block.properties.mcs_useCSS*}
{if $mcs_useCSS=="false"}
	{script src="js/addons/mcs_framework/mcs_sliders/bxslider/plugins/jquery.easing.1.3.js"}
{/if}
{if $block.properties.mcs_video=='true'}
	{script src="js/addons/mcs_framework/mcs_sliders/bxslider/plugins/jquery.fitvids.js"}
{/if}

<script type="text/javascript">
$(document).ready(function(){
	var slider=$('#bxslider_{$block.snapping_id}').bxSlider({
		mode:'{$block.properties.mcs_mode}',
		speed:{$block.properties.mcs_speed},
		slideMargin:{$block.properties.mcs_slideMargin},
		startSlide:{$block.properties.mcs_startSlide},
		randomStart:{$block.properties.mcs_randomStart},
		infiniteLoop:{$block.properties.mcs_infiniteLoop},
		hideControlOnEnd:{$block.properties.mcs_hideControlOnEnd},
		easing:'{$block.properties.mcs_easing}',
		useCSS:{$mcs_useCSS},
		captions:{$block.properties.mcs_captions},
		ticker:{$block.properties.mcs_ticker},
		tickerHover:{$block.properties.mcs_tickerHover},
		adaptiveHeight:{$block.properties.mcs_adaptiveHeight},
		adaptiveHeightSpeed:{$block.properties.mcs_adaptiveHeightSpeed},
		video:{$block.properties.mcs_video},
		responsive:{$block.properties.mcs_responsive},
		preloadImages:'{$block.properties.mcs_preloadImages}',
		touchEnabled:{$block.properties.mcs_touchEnabled},
		swipeThreshold:{$block.properties.mcs_swipeThreshold},
		oneToOneTouch:{$block.properties.mcs_oneToOneTouch},
		preventDefaultSwipeX:{$block.properties.mcs_preventDefaultSwipeX},
		preventDefaultSwipeY:{$block.properties.mcs_preventDefaultSwipeY},
		pager:{$block.properties.mcs_pager},
		pagerType:'{$block.properties.mcs_pagerType}',
		pagerShortSeparator:'{$block.properties.mcs_pagerShortSeparator}',
		pagerCustom:'{$mcs_pagerCustom}',
		
		controls:{$block.properties.mcs_controls},
		nextText:'{$block.properties.mcs_nextText}',
		prevText:'{$block.properties.mcs_prevText}',
		nextSelector:'{$mcs_nextSelector}',
		prevSelector:'{$mcs_prevSelector}',
		autoControls:{$block.properties.mcs_autoControls},
		autoControlsCombine:{$block.properties.mcs_autoControlsCombine},
		startText:'{$block.properties.mcs_startText}',
		stopText:'{$block.properties.mcs_stopText}',
		autoControlsSelector:'{$mcs_autoControlsSelector}',
		
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

