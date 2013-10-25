{** block-description:myscroller **}

{*style src='addons/mcs_framework/mcs_sliders/bxslider/bxslider.pager.css'*}

<ul id="bxslider_{$block.snapping_id}">
	{foreach from=$items item="product" name="for_products"}
            <li>
            {assign var="obj_id" value="scr_`$block.block_id`000`$product.product_id`"}
            {if $block.properties.mcs_slideWidth>'0'}
            	{include file="common/image.tpl" assign="object_img" image_width=$block.properties.mcs_slideWidth image_height=$block.properties.mcs_slideWidth images=$product.main_pair no_ids=true}
            {else}
            	{include file="common/image.tpl" assign="object_img" images=$product.main_pair no_ids=true}
            {/if}
            <div class="slide">
                <div class="bximg">
                    <a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{$object_img nofilter}</a>
                    {if $block.properties.enable_quick_view == "Y"}
                        {include file="views/products/components/quick_view_link.tpl" quick_nav_ids=$quick_nav_ids}
                    {/if}
                </div>
                 <div class="center compact">
                    {if $block.properties.hide_add_to_cart_button == "Y"}
                        {assign var="_show_add_to_cart" value=false}
                    {else}
                        {assign var="_show_add_to_cart" value=true}
                    {/if}
                    {if $block.properties.show_price == "Y"}
                        {assign var="_hide_price" value=false}
                    {else}
                        {assign var="_hide_price" value=true}
                    {/if}
                    {strip}
                    {include file="blocks/list_templates/simple_list.tpl" product=$product show_trunc_name=true show_price=true show_add_to_cart=$_show_add_to_cart but_role="action" hide_price=$_hide_price hide_qty=true}
                    {/strip}
                </div>
            </div>
            </li>
        {/foreach}
</ul>

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
	/*$(".mcs-tab-block").tabs({
		activate:function(){
			var active = $(this).tabs("option", "active");
			console.log($(".mcs-tab-block ul>li a").eq(active).attr('href'));
		}
	});*/
	
	/*$(".mcs-tab-block").tabs({
		activate:function(){
			var active = $(this).tabs("option", "active");
			var id=$(this).children(".mcs-tab-content").eq(active).attr('id');
			console.log(id);
			if(id=="mcs-tab-content-{$block.snapping_id}"){
				slider.reloadSlider();	
			}
		}
	});*/
	
	$("#mcs-accordion-content-{$block.snapping_id}").parent(".mcs-accordion-block").on("accordionactivate",function(event,ui){
		slider.reloadSlider();
	});
});
</script>
