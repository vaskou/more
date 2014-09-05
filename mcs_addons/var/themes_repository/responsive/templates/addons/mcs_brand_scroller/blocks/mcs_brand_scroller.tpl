{** block-description:mcs_brand_scroller **}

{if $items}
<div class="mcs-brand-scroller-{$block.snapping_id}">
    <div id="brands_{$block.snapping_id}" class="owl-carousel">
        {foreach from=$items item="brand"}
        <div class="brand-box with-image">
            <a href="{"product_features.view?variant_id=`$brand.variant_id`"|fn_url}">

                <div class="brand-image">
                        {include file="common/image.tpl" images=$brand.image_pair}
                </div>
                
                <span class="brand-name">
                    {$brand.variant|fn_text_placeholders}
                </span>
            </a>
        </div>
        {/foreach}
    </div>
    
    {assign var="filter_data" value=$block.properties.mcs_brand_scroller_brand_feature_id|fn_mcs_product_get_feature_filter}
    {assign var="filter_id" value=$filter_data|key}
    {assign var="filter_name" value=$filter_data[$filter_id]}
    {if $block.properties.mcs_brand_scroller_button=='Y'}
    	<div class="mcs-brand-scroller-button">
    		<a href="index.php?dispatch=product_features.view_all&filter_id={$filter_id}"><i class="{$block.properties.mcs_brand_scroller_button_icon}"></i>{$filter_name}</a>
	    </div>
    {/if}

{script src="js/lib/owlcarousel/owl.carousel.min.js"}
<script type="text/javascript">
(function(_, $) {
    $.ceEvent('on', 'ce.commoninit', function(context) {
        var elm = context.find('#brands_{$block.snapping_id}');

        if (elm.length) {
            elm.owlCarousel({
                items: {$block.properties.item_quantity|default:1},
                {if $block.properties.scroll_per_page == "Y"}
                scrollPerPage: true,
                {/if}
                {if $block.properties.not_scroll_automatically == "Y"}
                autoPlay: false,
                {else}
                autoPlay: '{$block.properties.pause_delay * 1000|default:0}',
                {/if}
                slideSpeed: {$block.properties.speed|default:400},
                stopOnHover: true,
                navigation: true,
                navigationText: ['<i class="ty-icon-left-open"></i>', '<i class="ty-icon-right-open"></i>'],
                pagination: false
            });
        }
    });
}(Tygh, Tygh.$));
</script>

</div>
{/if}