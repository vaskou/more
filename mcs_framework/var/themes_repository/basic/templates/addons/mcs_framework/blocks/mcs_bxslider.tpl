{** block-description:mcs_bxslider **}
{if $block.properties.mcs_speed==""}{$block.properties.mcs_speed=500}{/if}
{if $block.properties.mcs_slideMargin==""}{$block.properties.mcs_slideMargin=0}{/if}
{if $block.properties.mcs_startSlide==""}{$block.properties.mcs_startSlide=0}{/if}
{if $block.properties.mcs_adaptiveHeightSpeed==""}{$block.properties.mcs_adaptiveHeightSpeed=500}{/if}
{if $block.properties.mcs_swipeThreshold==""}{$block.properties.mcs_swipeThreshold=50}{/if}
{if $block.properties.mcs_pause==""}{$block.properties.mcs_pause=4000}{/if}
{if $block.properties.mcs_autoDelay==""}{$block.properties.mcs_autoDelay=0}{/if}
{if $block.properties.mcs_minSlides==""}{$block.properties.mcs_minSlides=1}{/if}
{if $block.properties.mcs_maxSlides==""}{$block.properties.mcs_maxSlides=1}{/if}
{if $block.properties.mcs_moveSlides==""}{$block.properties.mcs_moveSlides=0}{/if}
{if $block.properties.mcs_slideWidth==""}{$block.properties.mcs_slideWidth=0}{/if}

{if $addons.mcs_framework.mcs_general_bxslider_enable=='Y'}
{if $items}
<div class="mcs_slider_{$block.snapping_id}" {if $block.properties.mcs_slideWidth!=0}style="max-width:{$block.properties.mcs_slideWidth}px;margin:auto;"{/if}>
	<ul class="bxslider" id="bxslider_{$block.snapping_id}">
        {foreach from=$items item="banner" key="key"}
            <li>
            	<div class="bximg">
		            {if $banner.type == "G" && $banner.main_pair.image_id}
        		        {if $banner.url != ""}<a href="{$banner.url|fn_url}" {if $banner.target == "B"}target="_blank"{/if}>{/if}
                		{include file="common/image.tpl" images=$banner.main_pair}
		                {if $banner.url != ""}</a>{/if}
                        {if $banner.description!=""}
                            <div class="wysiwyg-content mcs-slider-text">
                                {$banner.description nofilter}
                            </div>
                        {/if}
        		    {else}
                		<div class="wysiwyg-content">
		                    {$banner.description nofilter}
        		        </div>
		            {/if}
      			</div>
            </li>
        {/foreach}
	</ul>
    
    {if $block.properties.mcs_customAutoControls=='true'}
    	<div id="autoCtrl"></div>
        {assign var="mcs_autoControlsSelector" value="#autoCtrl"}
    {/if}
    
    {if $block.properties.mcs_customControls=='true'}
    	<div id="c_controls">
        	<span id="slider-prev-{$block.snapping_id}"></span><span id="slider-next-{$block.snapping_id}"></span>
        </div>
        {assign var="mcs_nextSelector" value="#slider-next-{$block.snapping_id}"}
        {assign var="mcs_prevSelector" value="#slider-prev-{$block.snapping_id}"}
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


{*$block.properties.mcs_useCSS*}
{if $mcs_useCSS=="false"}
	{script src="js/addons/mcs_framework/libs/jquery.easing.1.3.js"}
{/if}
{if $block.properties.mcs_video=='true'}
	{script src="js/addons/mcs_framework/libs/jquery.fitvids.js"}
{/if}

<script type="text/javascript">
$(document).ready(function(){
	var deviceType='{$mobiledetect.deviceType}';
	var pagerValue={$block.properties.mcs_pager};
	if(deviceType=='phone'){
		pagerValue=false;
	}
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
		pager:pagerValue,
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

{else}
	<div class="mcs-warning">
    	<h1 class="error-text"><i class="icon-warning"></i> You must enable the bxSlider from More CS-Cart Framework.</h1>
    </div>
{/if}
