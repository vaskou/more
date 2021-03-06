{hook name="products:prices_block"}
    {if $product.price|floatval || $product.zero_price_action == "P" || ($hide_add_to_cart_button == "Y" && $product.zero_price_action == "A")}
        <span class="price{if !$product.price|floatval && !$product.zero_price_action} hidden{/if}" id="line_discounted_price_{$obj_prefix}{$obj_id}">{if $details_page}{/if}{include file="common/price.tpl" value=$product.price span_id="discounted_price_`$obj_prefix``$obj_id`" class="price-num"}</span>
    {elseif $product.zero_price_action == "A" && $show_add_to_cart}
        {assign var="base_currency" value=$currencies[$smarty.const.CART_PRIMARY_CURRENCY]}
        <span class="price-curency"><span>{__("enter_your_price")}: {if $base_currency.after != "Y"}{$base_currency.symbol}{/if}</span><input class="input-text-short" type="text" size="3" name="product_data[{$obj_id}][price]" value="" />{if $base_currency.after == "Y"}{$base_currency.symbol}{/if}</span>
    {elseif $product.zero_price_action == "R"}
    	{assign var=mcs_feature_id value=$addons.mcs_getaquote.mcs_getaquote_features_list}
    	{assign var=mcs_variant_id value=$product.header_features.$mcs_feature_id.variant_id}
        {assign var=mcs_vendor_id value=$mcs_variant_id|fn_mcs_getaquote_get_vendor_id}
        {append var=prod_data value=['product_id'=>$product.product_id,'product_name'=>$product.product,'main_pair'=>$product.main_pair,'product_code'=>$product.product_code] index=$product.product_id}
        {assign var=prod_data value=$prod_data|json_encode}
        <input type="hidden" name="mcs_product_data" value="{$prod_data}" />
    	<input type="hidden" name="page_id" value="{$addons.mcs_getaquote.mcs_getaquote_pages_list}" />
        <input type="hidden" name="mcs_variant_id" value="{$mcs_variant_id}" />
        <input type="hidden" name="mcs_vendor_id" value="{$mcs_vendor_id}" />
        {if $auth.user_id}
        	{include file="buttons/button.tpl" but_text=__("contact_us_for_price") but_id="communicate_vendor_button_`$block.block_id`" but_meta="ty-btn__secondary mcs-contact-us-btn" but_name="dispatch[pages.view]" but_role="action"}
        {else}
            <span id="wrap_communicate_vendor_button_{$block.block_id}" class="button-submit-action button-wrap-left">
                <span class="button-action button-wrap-right">
                    <a href="{if $runtime.controller == "auth" && $runtime.mode == "login_form"}{$config.current_url|fn_url}{else}{"auth.login_form?return_url=`$config.current_url`"|fn_url}{/if}" {if $settings.General.secure_auth != "Y"} data-ca-target-id="login_block{$block.snapping_id}" class="cm-dialog-opener cm-dialog-auto-size ty-btn__secondary mcs-contact-us-btn"{else}class="account"{/if} rel="nofollow">{__("contact_us_for_price")}</a>
                </span>
            </span>	
        {/if}
        {assign var="show_qty" value=false}
    {/if}
{/hook}