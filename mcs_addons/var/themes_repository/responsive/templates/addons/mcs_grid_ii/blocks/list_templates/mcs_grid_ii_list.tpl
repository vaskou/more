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
    <div class="mcs-grid-ii-list">
        {strip}
            {foreach from=$splitted_products item="sproducts" name="sprod"}
                {foreach from=$sproducts item="product" name="sproducts"}
                    <div class="ty-column{$columns}">
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
                                        
                                        {assign var="rating" value="rating_$obj_id"}
                                        {if $smarty.capture.$rating}
                                            <div class="mcs-grid-ii-list__rating">
                                                {$smarty.capture.$rating nofilter}
                                            </div>
                                        {/if}
                        
                                        <div class="mcs-grid-ii-list__control">
                                            {*if $settings.Appearance.enable_quick_view == 'Y'}
                                                {include file="views/products/components/quick_view_link.tpl" quick_nav_ids=$quick_nav_ids}
                                            {/if*}

                                            {if $show_add_to_cart}
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
        {script src="js/addons/mcs_grid_ii/mcs_grid_ii.js"}
    </div>

    {if !$no_pagination}
        {include file="common/pagination.tpl"}
    {/if}

{/if}

{capture name="mainbox_title"}{$title}{/capture}