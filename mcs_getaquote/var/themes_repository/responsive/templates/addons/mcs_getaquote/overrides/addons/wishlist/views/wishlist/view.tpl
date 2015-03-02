{assign var="columns" value=4}
{if !$wishlist_is_empty}

    {script src="js/tygh/exceptions.js"}

    {assign var="show_hr" value=false}
    {assign var="location" value="cart"}
{/if}

{if $vendor_products}	
    {foreach from=$vendor_products item="products" key="vid"}
    	<div class="ty-mainbox-container mcs-wishlist-view">
            <div class="ty-feature">
                <div class="ty-feature__image">
                	<a href="{"product_features.view&variant_id=`$vid`"|fn_url}">
                    	{include file="common/image.tpl" images=$vendors.$vid.image_pair image_width="160"}
                    </a>
                    <div class="mcs-producer-link">
                    	<a href="{"product_features.view&variant_id=`$vid`"|fn_url}">{__("mcs_view_producer_page")}</a>
                    </div>
                </div>
                <div class="ty-feature__description ty-wysiwyg-content">
                    {$vendors.$vid.description nofilter}
                </div>
            </div>
            {include file="blocks/list_templates/grid_list.tpl" 
                columns=$columns
                show_empty=true
                show_trunc_name=true 
                show_old_price=true 
                show_price=true 
                show_clean_price=true 
                show_list_discount=true
                no_pagination=true
                no_sorting=true
                show_add_to_cart=false
                is_wishlist=true}
            <form class="cm-ajax cm-ajax-full-render" action="{""|fn_url}" method="post" name="vendor_form_{$vid}" enctype="multipart/form-data">
                <input type="hidden" name="redirect_url" value="{$config.current_url}" />
                <input type="hidden" name="result_ids" value="cart_status*,wish_list*" />
                {assign var=prod_data value=array()}
                {foreach from=$products item="_product"}
                	<input type="hidden" name="product_data[{$_product.product_id}][product_id]" value="{$_product.product_id}" />
                    <input type="hidden" name="product_data[{$_product.product_id}][amount]" value="1" />
					{append var=prod_data value=['product_id'=>$_product.product_id,'product_name'=>$_product.product,'main_pair'=>$_product.main_pair,'product_code'=>$_product.product_code] index=$_product.product_id}
                {/foreach}
				{assign var=prod_data value=$prod_data|json_encode}
                {assign var=vendor_id value=$vid|fn_mcs_getaquote_get_vendor_id}
                <div class="buttons-container ty-wish-list__buttons">
                    {include file="buttons/button.tpl" but_text=__("add_all_to_cart") but_id="vendor_button_`$vid`" but_meta="ty-btn__secondary" but_name="dispatch[checkout.add]" but_role="action"}
					<input type="hidden" name="mcs_product_data" value="{$prod_data}" />
					<input type="hidden" name="page_id" value="{$addons.mcs_getaquote.mcs_getaquote_pages_list}" />
					<input type="hidden" name="mcs_variant_id" value="wishlist" />
					<input type="hidden" name="mcs_vendor_id" value="{$vendor_id}" />
                    {assign var=show_getaquote value=$vendor_id|fn_mcs_getaquote_show_getaquote_block}
                    {if $show_getaquote}
						{include file="buttons/button.tpl" but_text=__("get_a_quote") but_id="communicate_vendor_button_`$vid`" but_meta="ty-btn__secondary" but_name="dispatch[pages.view]" but_role="action"}
                    {/if}
                </div>
            </form>
		</div>
    {/foreach}
{else}
    {math equation="100 / x" x=$columns|default:"2" assign="cell_width"}
    <div class="grid-list {if $wishlist_is_empty}wish-list-empty{/if}">
        {assign var="iteration" value=0}
        {capture name="iteration"}{$iteration}{/capture}
            {hook name="wishlist:view"}
            {/hook}
        {assign var="iteration" value=$smarty.capture.iteration}
        {if $iteration == 0 || $iteration % $columns != 0}
            {math assign="empty_count" equation="c - it%c" it=$iteration c=$columns}
            {section loop=$empty_count name="empty_rows"}
                <div class="ty-column{$columns}">
                    <div class="ty-product-empty">
                        <span class="ty-product-empty__text">{__("empty")}</span>
                    </div>
                </div>
            {/section}
        {/if}
    </div>
{/if}

{if !$wishlist_is_empty}
    <div class="buttons-container ty-wish-list__buttons">
        {include file="buttons/button.tpl" but_text=__("clear_wishlist") but_href="wishlist.clear" but_meta="ty-btn__tertiary"}
        {include file="buttons/continue_shopping.tpl" but_href=$continue_url|fn_url but_role="text"}
    </div>
{else}
    <div class="buttons-container ty-wish-list__buttons ty-wish-list__continue">
        {include file="buttons/continue_shopping.tpl" but_href=$continue_url|fn_url but_role="text"}
    </div>
{/if}

{capture name="mainbox_title"}{__("wishlist_content")}{/capture}