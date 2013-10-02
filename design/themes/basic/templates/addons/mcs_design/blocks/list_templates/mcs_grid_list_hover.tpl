{if $products}

{script src="js/tygh/exceptions.js"}

{if !$no_pagination}
    {include file="common/pagination.tpl"}
{/if}

{if !$no_sorting}
    {include file="views/products/components/sorting.tpl"}
{/if}

{if !$show_empty}
    {if $products|sizeof < $columns}
        {assign var="columns" value=$products|@sizeof}
    {/if}
{/if}

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
<div class="mcs_hover">
<ul class="products row-fluid">{$k=0}
{foreach from=$products item="product" name="sproducts"}
    {if $i!=$columns}
        {$i=$i+1}
    {else}
        {$i=1}
    {/if}
    {$k=$k+1}
	
    

    <li class="product span{$span_no} {if $i==1}{if $modulus!=0}first_offset{else}first{/if}{/if} {if $i==$columns}last{/if} ">
    {if $product}
        {assign var="obj_id" value=$product.product_id}
        {assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
        {include file="common/product_data.tpl" product=$product}
        
        
    
	        {assign var="form_open" value="form_open_`$obj_id`"}
    	    {$smarty.capture.$form_open nofilter}
        	{hook name="products:product_multicolumns_list"}
            {capture name="main_icon"}
            	<a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="thumb">
	            	{include file="common/image.tpl" obj_id=$obj_id_prefix images=$product.main_pair image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height }
                </a>
            {/capture}
            
            {capture name="name_price"}
            	{assign var="name" value="name_$obj_id"}
                <div class="name-price">
                    <h3>{$smarty.capture.$name nofilter}</h3>
                    <span class="price-wrapper">
                        
                        {assign var="old_price" value="old_price_`$obj_id`"}
                        {if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price nofilter}&nbsp;{/if}
                    
                        {assign var="price" value="price_`$obj_id`"}
                        {$smarty.capture.$price nofilter}  
                         
                        {assign var="clean_price" value="clean_price_`$obj_id`"}
                        {$smarty.capture.$clean_price nofilter}
                        
                        {assign var="list_discount" value="list_discount_`$obj_id`"}
                        {$smarty.capture.$list_discount nofilter}
                        
                    </span>
                </div>
            {/capture}
            
            
            {if $product.list_discount_prc}
            <span class="thumb-discount-label">
            	{strip}    
                    {__("save_discount")} {$product.list_discount_prc}%
            	{/strip}
            </span>
            {/if}
            
            
            <!--<div class="prod_img">-->
            	{*$smarty.capture.main_icon nofilter*}
                {*$smarty.capture.name_price nofilter*}
            <!--</div>-->
            
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
            	<div class="prod_img">
            	{$smarty.capture.main_icon nofilter}
                </div>
            {/if}
            {$smarty.capture.name_price nofilter}
            
            {if $item_number == "Y"}<span class="item-number">{$cur_number}.&nbsp;</span>{math equation="num + 1" num=$cur_number assign="cur_number"}{/if}
            
            <div class="prod_info">
            	<div class="prod_info_wrapper">
                   {$smarty.capture.name_price nofilter}                    
                    
                    <div class="features">
                        {assign var="product_features" value="product_features_`$obj_id`"}{$smarty.capture.$product_features nofilter}
                    </div>
                    {if $settings.Appearance.enable_quick_view == 'Y'}
                        {include file="views/products/components/quick_view_link.tpl" quick_nav_ids=$quick_nav_ids}
                    {/if}
                    {if $show_add_to_cart}
                        {assign var="add_to_cart" value="add_to_cart_`$obj_id`"}
                        {$smarty.capture.$add_to_cart nofilter}
                    {/if}
                </div>
            </div>
           
                              
        {/hook}
        {assign var="form_close" value="form_close_`$obj_id`"}
        {$smarty.capture.$form_close nofilter}

        
    {/if}
    </li>
{/foreach}
</ul>
</div>

{if !$no_pagination}
    {include file="common/pagination.tpl"}
{/if}

{/if}

{capture name="mainbox_title"}{$title}{/capture}
