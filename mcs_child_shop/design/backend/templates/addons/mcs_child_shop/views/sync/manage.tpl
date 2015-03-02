{capture name="mainbox"}
<div id="mcs_results">
<form action="{""|fn_url}" method="post" class="cm-ajax cm-ajax-full-render">
<input type="hidden" name="result_ids" value="mcs_results" />
{*literal}
<script>
$(function(){
	$(document).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions) {
		var arr=JSON.parse(XMLHttpRequest.responseText);
		console.log(XMLHttpRequest);
		//$(".admin-content-wrap").html(arr.text);
    });
})
</script>

{/literal*}

{if $mcs_timestamp!=0}
	<h3>{__("mcs_last_synchronization")}</h3>
    <h4>{$mcs_timestamp|date_format:"%A, %e %B %Y"}</h4>
{/if}
{if $auth.is_root == 'Y' && $mcs_child_shop_status=='A'}
    {if $mcs_timestamp==0 || !$mcs_timestamp}
        <label class="checkbox">{__("mcs_synchronize_categories")}
            <input name="mcs_sync_categ" type="checkbox" value="true"/>
        </label>
        <label class="checkbox">{__("mcs_make_products_active")}
            <input name="mcs_sync_products_enabled" type="checkbox" value="true" />
        </label>
        <input type="hidden" value="all" name="sync_mode" />
        <input type="submit" name="dispatch[sync.manage]" value="{__('mcs_first_time_sync')}" class="btn btn-primary" />
    {else}
        {if $mcs_products_to_sync}
            <table class="table table-striped">
                <thead>
                    <tr>
                    	<th class="left">
                            {include file="common/check_items.tpl" check_statuses=''}
                        </th>
                        <th style="width:70px"><span>{__('product_id')}</span></th>
                        <th><span>{__('product_name')}</span></th>
                        <th><span>{__('update_status')}</span></th>
                    </tr>
                </thead>
                <tbody>
                {foreach from=$mcs_products_to_sync item=product}
                	{if $product.update_status=='N'}
                    	{assign var="product_url" value="`$addons.mcs_child_shop.mcs_general_parent_url`index.php?dispatch=products.view&product_id=`$product.product_id`"}
                    {else}
                    	{assign var=product_url value="products.update&product_id=`$product.product_id`"|fn_url}
                    {/if}
                    <tr>
                    	<td class="left">
                        	<input type="checkbox" name="product_ids[]" value="{$product.product_id}" class="checkbox cm-item cm-item-status-a" {if $product.update_status=='L'}disabled{/if} >
                        </td>
                        <td>{$product.product_id}</td>
                        <td><a href="{$product_url}" target="_blank">{$product.name}</a></td>
                        <td>{__("mcs_product_`$product.update_status|lower`")}</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
            <input type="hidden" value="{$mcs_products_to_sync_ids}" name="unsynced_products" />
            <input type="hidden" value="new" name="sync_mode" />
	        <input type="submit" name="dispatch[sync.manage]" value="{__('mcs_new_products_sync')}" class="btn btn-primary" />
        {else}
            <input type="hidden" value="check" name="sync_mode" />
        	<input type="submit" name="dispatch[sync.manage]" value="{__('mcs_check_products_to_sync')}" class="btn btn-primary" />
            
        {/if}
    {/if}
{else}
	<h3>{__("mcs_you_cant_sync")}</h3>
{/if}
{if $mcs_sync_result}
<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:100px">Product ID</th>
            <th>Product Name</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$mcs_sync_result item=product}
        <tr>
            <td>{$product.product_id}</td>
            <td><a href="{"products.update&product_id=`$product.product_id`"|fn_url}" target="_blank">{$product.name}</a></td>
        </tr>
    {/foreach}
    </tbody>
</table>
{*$mcs_unsynced_products|var_dump*}
{/if}



</form><!--mcs_results--></div>
{/capture}

{include file="common/mainbox.tpl" title=__("mcs_synchronization") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons no_sidebar=true}