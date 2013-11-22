{if $item_number == "Y"}
    {assign var="cur_number" value=1}
{/if}

{math equation="16 / x" x=$columns|default:"2" format="%.0f" assign="span_no"}
{math equation="16 % x" x=$columns|default:"2" format="%.0f" assign="modulus"}
{$i=$columns}
{script src="js/tygh/product_image_gallery.js"}

{if $settings.Appearance.enable_quick_view == 'Y'}
{$quick_nav_ids = $products|fn_fields_from_multi_level:"product_id":"product_id"}
{/if}
<div class="mcs_enfold_grid">
	<ul class="bxslider products" id="bxslider_{$block.snapping_id}">
        {foreach from=$products item="product" name="sproducts"}
            <li class="product">
            	 {if $product}
                    {assign var="obj_id" value=$product.product_id}
                    {assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
                    {include file="common/product_data.tpl" product=$product}
                    
                    <div class="product-wrapper">
                
                        {assign var="form_open" value="form_open_`$obj_id`"}
                        {$smarty.capture.$form_open nofilter}
                        {hook name="products:product_multicolumns_list"}
                        {capture name="main_icon"}
                            <a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="thumb">
                                {include file="common/image.tpl" obj_id=$obj_id_prefix images=$product.main_pair image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height }
                            </a>
                        {/capture}
                        
                        {if $product.list_discount_prc}
                        <span class="thumb-discount-label">
                            {strip}    
                                {__("save_discount")} {$product.list_discount_prc}%
                            {/strip}
                        </span>
                        {/if}
                        
                        {if $product.image_pairs}
                            <div class="prod_img multi_img" style="height:{$settings.Thumbnails.product_lists_thumbnail_height}px;">
                                {foreach from=$product.image_pairs item="image_pair"}
                                    {if $image_pair}
                                        <a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="thumb">
                                        {include file="common/image.tpl" obj_id="`$obj_id_prefix`_`$image_pair.image_id`" images=$image_pair image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height}</a>
                                    {/if}
                                {/foreach}
                                {if $product.main_pair}
                                    {$smarty.capture.main_icon nofilter}
                                {/if}
                                <div class="progress-bar"></div>
                            </div>
                            
                        {else}
                            <div class="prod_img" style="height:{$settings.Thumbnails.product_lists_thumbnail_height}px;">
                            {$smarty.capture.main_icon nofilter}
                            </div>
                        {/if}
                        
                        {if $item_number == "Y"}<span class="item-number">{$cur_number}.&nbsp;</span>{math equation="num + 1" num=$cur_number assign="cur_number"}{/if}
                        
                        {assign var="name" value="name_$obj_id"}
                        <div class="product_info">
                            <h3>{$smarty.capture.$name nofilter}</h3>
                            {if $hide_price!=true}
                            <span class="price-wrapper">
                                
                                {assign var="old_price" value="old_price_`$obj_id`"}
                                {if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price nofilter}{/if}
                            
                                {assign var="price" value="price_`$obj_id`"}
                                {$smarty.capture.$price nofilter}  
                                 
                                {assign var="clean_price" value="clean_price_`$obj_id`"}
                                {$smarty.capture.$clean_price nofilter}
                                
                                {assign var="list_discount" value="list_discount_`$obj_id`"}
                                {$smarty.capture.$list_discount nofilter}
                                
                            </span>
                            {/if}
                        </div>
                        <div class="product_extra_info">
                            {if $addons.mcs_master.mcs_features=='Y'}
                                <div class="features">{assign var="product_features" value="product_features_`$obj_id`"}{$smarty.capture.$product_features nofilter}</div>
                            {/if}
                            {if $addons.mcs_master.mcs_rating=='Y'}
                                <div class="mcs_rating">
                                    {assign var="rating" value="rating_$obj_id"}
                                    {$smarty.capture.$rating nofilter}
                                </div>
                            {/if}
                            {if $addons.mcs_master.mcs_points=='Y'}
                                <div class="mcs_points">
                                    {if $product.points_info.price}
                                        <div class="control-group{if !$capture_options_vs_qty} product-list-field{/if}">
                                            <label>{__("price_in_points")}:</label>
                                            <span id="price_in_points_{$obj_prefix}{$obj_id}">{$product.points_info.price}&nbsp;{__("points_lower")}</span>
                                        </div>
                                    {/if}
                                    <div class="control-group product-list-field{if !$product.points_info.reward.amount} hidden{/if}">
                                        <label>{__("reward_points")}:</label>
                                        <span id="reward_points_{$obj_prefix}{$obj_id}" >{$product.points_info.reward.amount}&nbsp;{__("points_lower")}</span>
                                    </div>
                                </div>
                            {/if}
                            
                        </div>
                        
                        <div class="product-meta">
                            <div class="product-meta-wrapper">
                                
                                <div class="classic-rating"></div>
                                {if !$enable_quick_view && !$show_add_to_cart}
                                	{assign var="half_height" value="style=height:2.5em;"}
                                {/if}
                                <div class="buttons-list-wrapper" {$half_height}>
                                {$top_buttons='false'}
                                {if $addons.wishlist.status=='A' || $product.feature_comparison == "Y"}
                                    {$top_buttons='true'}
                                {/if}
                                    <div class="add-buttons-wrap {if $cart_button_exists || (($product.out_of_stock_actions == "S") && ($product.tracking != "O"))} no-margin{/if} {if $top_buttons=='false'} no_top_buttons{/if}">
                                        <div class="add-buttons-inner-wrap">
                                            {if $addons.wishlist.status=="A"}
                                                <div id="cart_buttons_block_{$obj_prefix}{$obj_id}" class="add-buttons add-to-wish {if $product.feature_comparison == 'N'}full_width{/if}">
                                                    {hook name="products:buy_now"}
                                                    {/hook}
                                                </div>
                                            {/if}
                                            {if $product.feature_comparison == "Y"}
                                                <div class="add-to-compare {if $addons.wishlist.status=='D'}full_width{/if}">
                                                    {include file="buttons/add_to_compare_list.tpl" product_id=$product.product_id}
                                                </div>
                                            {/if}
                                        </div>
                                    </div>
                                    
                                    <div class="bottom_buttons">
                                        {if $enable_quick_view}
                                        	{if !$show_add_to_cart}{$class='full_width'}{/if}
                                            {include file="views/products/components/quick_view_link.tpl" quick_nav_ids=$quick_nav_ids _class=$class }
                                        {/if}
                                        <div class="add_cart_button {if !$enable_quick_view}full_width{/if}">
                                        {if $show_add_to_cart}
                                            {assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
                                            {$smarty.capture.$add_to_cart nofilter}
                                        {/if}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                          
                    {/hook}
                    {assign var="form_close" value="form_close_`$obj_id`"}
                    {$smarty.capture.$form_close nofilter}
            		<div style="clear:both"></div>
                    </div>
                    
                {/if}
            </li>
        {/foreach}
	</ul>
</div>