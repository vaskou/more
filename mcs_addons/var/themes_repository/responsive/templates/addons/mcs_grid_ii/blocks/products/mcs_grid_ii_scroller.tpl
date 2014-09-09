{** block-description:mcs_grid_ii_scroller **}

{if $block.properties.enable_quick_view == "Y"}
    {$quick_nav_ids = $items|fn_fields_from_multi_level:"product_id":"product_id"}
{/if}

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

{assign var="show_trunc_name" value=true}
{assign var="show_old_price" value=true}
{assign var="show_price" value=true}
{assign var="show_rating" value=true}
{assign var="show_clean_price" value=true}
{assign var="show_list_discount" value=true}
{assign var="show_add_to_cart" value=true}
{assign var="but_role" value="action"}
{assign var="show_discount_label" value=true}
{assign var="show_features" value=true}
{assign var="show_list_buttons" value=false}
{assign var="show_descr" value=true}

<div id="scroll_list_{$block.block_id}" class="owl-carousel ty-scroller-list mcs-grid-ii-scroller">
{foreach from=$items item="product"}

{if $product}
    {assign var="obj_id" value=$product.product_id}
    {assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
    {include file="common/product_data.tpl" product=$product}

    <div class="mcs-grid-ii-list__item ty-quick-view-button__wrapper">
        {assign var="form_open" value="form_open_`$obj_id`"}
        {$smarty.capture.$form_open nofilter}
        {hook name="products:product_multicolumns_list"}
                <div class="mcs-grid-ii-list__image">
                    {*include file="views/products/components/product_icon.tpl" product=$product show_gallery=true*}
                    {capture name="main_icon"}
                        <a href="{"products.view?product_id=`$product.product_id`"|fn_url}">
                            {include file="common/image.tpl" obj_id=$obj_id_prefix images=$product.main_pair image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height}
                        </a>
                    {/capture}
                    
                    {if $product.image_pairs}
                    <div class="ty-center-block multi-img slides-container">
                        
                            {if $product.main_pair}
                                
                                    {$smarty.capture.main_icon nofilter}
                                
                            {/if}
                            {foreach from=$product.image_pairs item="image_pair"}
                                {if $image_pair}
                                    
                                        <a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="slide">
                                            {include file="common/image.tpl" no_ids=true images=$image_pair image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height}
                                        </a>
                                    
                                {/if}
                            {/foreach}
                            <div class="progress-bar"></div>
                    </div>
                    {else}
                        {$smarty.capture.main_icon nofilter}
                    {/if}

                    {assign var="discount_label" value="discount_label_`$obj_prefix``$obj_id`"}
                    {$smarty.capture.$discount_label nofilter}
                </div>

                <div class="mcs-grid-ii-list__item-name">
                    {if $item_number == "Y"}
                        <span class="item-number">{$cur_number}.&nbsp;</span>
                        {math equation="num + 1" num=$cur_number assign="cur_number"}
                    {/if}

                    {assign var="name" value="name_$obj_id"}
                    {$smarty.capture.$name nofilter}
                </div>
                
                <div class="mcs-grid-list-ii__description">
                    {*assign var="prod_descr" value="prod_descr_`$obj_id`"}
                    {$smarty.capture.$prod_descr nofilter*}
                    {if $product.short_description}
                        {$product.short_description|strip_tags|truncate:60 nofilter}
                    {else}
                        {$product.full_description|strip_tags|truncate:60 nofilter}
                    {/if}
                </div>
                
                {assign var="rating" value="rating_$obj_id"}
                {if $smarty.capture.$rating}
                    <div class="mcs-grid-ii-list__rating">
                        {$smarty.capture.$rating nofilter}
                    </div>
                {/if}
                
                {if $_hide_price == false}
                    <div class="mcs-grid-ii-list__price {if $product.price == 0}ty-grid-list__no-price{/if}">
                        {assign var="old_price" value="old_price_`$obj_id`"}
                        {if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price nofilter}{/if}
                        
                        {assign var="price" value="price_`$obj_id`"}
                        {$smarty.capture.$price nofilter} 
    
                        {assign var="clean_price" value="clean_price_`$obj_id`"}
                        {$smarty.capture.$clean_price nofilter}
    
                        {assign var="list_discount" value="list_discount_`$obj_id`"}
                        {$smarty.capture.$list_discount nofilter}
                    </div>
                {/if}

                <div class="mcs-grid-ii-list__control">
                    {if $block.properties.enable_quick_view == 'Y'}
                        {include file="views/products/components/quick_view_link.tpl" quick_nav_ids=$quick_nav_ids}
                    {/if}

                    {if $_show_add_to_cart}
                        <div class="button-container">
                            {assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
                            {$smarty.capture.$add_to_cart nofilter}
                        </div>
                    {/if}
                </div>
        {/hook}
        {assign var="form_close" value="form_close_`$obj_id`"}
        {$smarty.capture.$form_close nofilter}
    </div>
{/if}

{/foreach}

</div>

{script src="js/lib/owlcarousel/owl.carousel.min.js"}
<script type="text/javascript">
(function(_, $) {
    $.ceEvent('on', 'ce.commoninit', function(context) {
        var elm = context.find('#scroll_list_{$block.block_id}');

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