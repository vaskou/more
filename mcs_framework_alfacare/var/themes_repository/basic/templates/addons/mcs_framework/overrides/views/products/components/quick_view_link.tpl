<div class="quick-view {$_class}">
    <span class="button button-wrap-left">
        {$current_url = $config.current_url|urlencode}
        {$quick_view_url = "products.quick_view?product_id=`$product.product_id`&prev_url=`$current_url`"}
        {if $block.type && $block.type != 'main'}
            {$quick_view_url = $quick_view_url|fn_link_attach:"n_plain=Y"}
        {/if}
        {if $quick_nav_ids} 
            {$quick_nav_ids = ","|implode:$quick_nav_ids}
            {$quick_view_url = $quick_view_url|fn_link_attach:"n_items=`$quick_nav_ids`"}
        {/if}
        <span class="button button-wrap-right">
        	<i class="icon_wrap icon-eye3"></i>
            <a class="cm-dialog-opener cm-dialog-auto-size" data-ca-view-id="{$product.product_id}" data-ca-target-id="product_quick_view" href="{$quick_view_url|fn_url}" data-ca-dialog-title="{__("quick_product_viewer")}">{__("quick_view")}</a>
        </span>
    </span>
</div>

{*********************************************MCS changes************************************************}
{*Line      1: added {$_class}																			*}
{*Line     13: added i with class=icon_wrap																*}