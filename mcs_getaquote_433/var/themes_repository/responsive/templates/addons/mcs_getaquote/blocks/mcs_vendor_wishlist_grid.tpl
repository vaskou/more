{if $products}

    {script src="js/tygh/exceptions.js"}
    

    {if !$no_pagination}
        {include file="common/pagination.tpl"}
    {/if}
    
    {if !$no_sorting}
        {include file="views/products/components/sorting.tpl"}
    {/if}

    {if !$show_empty}
        {split data=$products size=$columns|default:"2" assign="splitted_products"}
    {else}
        {split data=$products size=$columns|default:"2" assign="splitted_products" skip_complete=true}
    {/if}

    {math equation="100 / x" x=$columns|default:"2" assign="cell_width"}
    {if $item_number == "Y"}
        {assign var="cur_number" value=1}
    {/if}

    {* FIXME: Don't move this file *}
    {script src="js/tygh/product_image_gallery.js"}

    {if $settings.Appearance.enable_quick_view == 'Y'}
        {$quick_nav_ids = $products|fn_fields_from_multi_level:"product_id":"product_id"}
    {/if}
    <div class="mcs-vendor-list" id="mcs_vendor_list_{$block.snapping_id}">
        {strip}
            {foreach from=$splitted_products item="sproducts" name="sprod"}
                {foreach from=$sproducts item="product" name="sproducts"}
                    <div class="ty-column{$columns}">
                        {if $product}
                            {assign var="obj_id" value=$product.product_id}
                            {assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
                            {include file="common/product_data.tpl" product=$product}

                            <div class="mcs-vendor-list__item">
                                {assign var="form_open" value="form_open_`$obj_id`"}
                                {$smarty.capture.$form_open nofilter}
                                
                                {if $is_wishlist}
                                    <div class="ty-twishlist-item">
                                    	<input type="hidden" name="mcs_cart_id" value="{$product.cart_id}" />
                                        <input type="hidden" name="variant_id" value="{$variant_data.variant_id}"/>
                                        <a class="ty-twishlist-item__remove ty-remove cm-submit" title="{__("remove")}" data-ca-dispatch="dispatch[wishlist.delete]"><i class="ty-remove__icon ty-icon-cancel-circle"></i><span class="ty-twishlist-item__txt ty-remove__txt">{__("remove")}</span></a>
                                    </div>
                                {/if}
                                <div class="mcs-vendor-list__image">
                                	<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">
                                        {include file="common/image.tpl" obj_id=$obj_id_prefix images=$product.main_pair image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height vs_lazy_mobile=false}
                                    </a>

                                    {assign var="discount_label" value="discount_label_`$obj_prefix``$obj_id`"}
                                    {$smarty.capture.$discount_label nofilter}
                                </div>
                                {assign var="form_close" value="form_close_`$obj_id`"}
                                {$smarty.capture.$form_close nofilter}
                            </div>
                        {/if}
                    </div>
                {/foreach}
                {if $show_empty && $smarty.foreach.sprod.last}
                    {assign var="iteration" value=$smarty.foreach.sproducts.iteration}
                    {capture name="iteration"}{$iteration}{/capture}
                    {hook name="products:products_multicolumns_extra"}
                    {/hook}
                    {assign var="iteration" value=$smarty.capture.iteration}
                    {if $iteration % $columns != 0}
                        {math assign="empty_count" equation="c - it%c" it=$iteration c=$columns}
                        {section loop=$empty_count name="empty_rows"}
                            <div class="ty-column{$columns}">
                                <div class="ty-product-empty">
                                    <span class="ty-product-empty__text">{__("empty")}</span>
                                </div>
                            </div>
                        {/section}
                    {/if}
                {/if}
            {/foreach}
        {/strip}
    </div>

    {if !$no_pagination}
        {include file="common/pagination.tpl"}
    {/if}

{/if}

{capture name="mainbox_title"}{$title}{/capture}