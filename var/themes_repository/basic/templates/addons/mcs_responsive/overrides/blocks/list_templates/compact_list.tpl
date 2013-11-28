{if $products}

{script src="js/tygh/exceptions.js"}

{if !$no_pagination}
    {include file="common/pagination.tpl"}
{/if}

{if !$no_sorting}
    {include file="views/products/components/sorting.tpl"}
{/if}

<form {if !$config.tweaks.disable_dhtml}class="cm-ajax cm-ajax-full-render"{/if} action="{""|fn_url}" method="post" name="short_list_form{$obj_prefix}">
<input type="hidden" name="result_ids" value="cart_status*,wish_list*" />
<input type="hidden" name="redirect_url" value="{$config.current_url}" />

<table class="table products table-width row-fluid">

{foreach from=$products item="product" key="key" name="products"}
    {assign var="obj_id" value=$product.product_id}
    {assign var="obj_id_prefix" value="`$obj_prefix``$product.product_id`"}
    {include file="common/product_data.tpl" product=$product}
    {hook name="products:product_compact_list"}
    <tr class="valign {cycle values=',table-row'}{if $smarty.foreach.products.last} last{/if} row-fluid" style="border-bottom:1px solid #e3e3e3;">
        <td class=" span2 mcs_span_img" style="border:none;">
            <a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{include file="common/image.tpl" image_width="150" image_height="150" images=$product.main_pair obj_id=$obj_id_prefix}</a>
        </td>
        <td class="compact span8" style="border:none;">
            {assign var="name" value="name_$obj_id"}{$smarty.capture.$name nofilter}

            <br/>
            {strip}
            {assign var="old_price" value="old_price_`$obj_id`"}
            {if $smarty.capture.$old_price|trim}{$smarty.capture.$old_price nofilter}&nbsp;{/if}

            {assign var="price" value="price_`$obj_id`"}{$smarty.capture.$price nofilter}
            {/strip}
        </td>

        {if $show_add_to_cart}
        <td class="nowrap right span6" style="border:none;">

            {if !$smarty.capture.capt_options_vs_qty}
            {assign var="product_options" value="product_options_`$obj_id`"}
            {$smarty.capture.$product_options nofilter}
            
            {assign var="qty" value="qty_`$obj_id`"}
            {$smarty.capture.$qty nofilter}
            {/if}
            

            {assign var="add_to_cart" value="add_to_cart_`$obj_id`"}{$smarty.capture.$add_to_cart nofilter}
        </td>
        {/if}
    </tr>
    {/hook}
{/foreach}
</table>

</form>

{if !$no_pagination}
    {include file="common/pagination.tpl" force_ajax=$force_ajax}
{/if}

{/if}

{*********************************************CSP changes************************************************}
{*Line  17: added class row-fluid																		*}
{*Line  24: added class row-fluid and style border-bottom:1px solid #e3e3e3;							*}
{*Line  25: removed class product-image and added class span2, mcs_span_img and style border:none;		*}
{*Line  26: changed variables image-width and image height from 40 to 150								*}
{*Line  28: removed class compact and added span8 and style border:none 								*}
{*Line  41: added class span6 and style border:none 													*}