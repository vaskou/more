{capture name="mainbox"}
<div id="mcs_results">
<form action="{""|fn_url}" method="post" name="mcs_child_shop_sync_form" class="cm-ajax cm-ajax-full-render">
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

{*assign var="category_name" value=$master_category_id|fn_get_category_name}
{assign var="url" value="{"products.manage?cid=`$master_category_id`"|fn_url}"}
{__("mcs_sync_complete_message", ["[category_name]" => $category_name,"[url]" => $url])*}


{if  $mcs_child_shop_status=='A'}
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
    	{if $mcs_timestamp!=0}
            <h3>{__("mcs_last_synchronization")} : {$mcs_timestamp|date_format:"%A, %e %B %Y"}</h3>
        {/if}
    	{if $mcs_products_to_sync}        
            <table class="table table-striped">
                <thead>
                    <tr>
                    	<th class="left">
                            {include file="common/check_items.tpl" check_statuses=''}
                        </th>
                        <th style="width:85px"><span>{__('product_id')}</span></th>
                        <th><span>{__('product_name')}</span></th>
                        <th style="width:200px"></th>
                        <th style="width:190px"><span>{__('update_status')}</span></th>
                    </tr>
                </thead>
                <tbody>
                {foreach from=$mcs_products_to_sync item=product}
                	{$tooltip=""}
                	{if $product.update_status!='N'}
                    	{assign var="tooltip" value="mcs_product_`$product.update_status|lower`_tooltip"}
                    {/if}
                    {assign var="view_product" value="`$addons.mcs_child_shop.mcs_general_parent_url`?dispatch=products.view&product_id=`$product.product_id`"}
                    {assign var="edit_product" value="products.update&product_id=`$product.product_id`"|fn_url}
                    <tr>
                    	<td class="left">
                        	<input type="checkbox" name="product_ids[]" value="{$product.product_id}" class="checkbox cm-item cm-item-status-a" {if $product.update_status=='L'}disabled{/if} >
                        </td>
                        <td>{$product.product_id}</td>
                        <td>
                        	{$product.name}
                        </td>
                        <td class="">
                        	<a href="{$view_product}" target="_blank" class="btn ">{__("view")}</a>
                            {if $product.update_status != 'N'}
	                            <a href="{$edit_product}" target="_blank" class="btn ">{__("edit")}</a>
                            {/if}
                        </td>
                        <td>
                        	{if $tooltip}{include file="common/tooltip.tpl" tooltip={__($tooltip)}}{/if}
                        	{__("mcs_product_`$product.update_status|lower`")}
                        	
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
            <h5>{__("mcs_db_backup_attention")}</h5>
            <input type="hidden" value="{$mcs_products_to_sync_ids}" name="unsynced_products" />
            <input type="hidden" value="new" name="sync_mode" />
	        <input type="submit" name="dispatch[sync.manage]" value="{__('mcs_new_products_sync')}" class="btn btn-primary" />
        {else}
                        
        {/if}
    {/if}
{else}
	<h3>{__("mcs_you_cant_sync")}</h3>
{/if}
{if $mcs_sync_result}
    
    {assign var="category_name" value=$master_category_id|fn_get_category_name}
    {assign var="url" value="{"products.manage?cid=`$master_category_id`"|fn_url}"}
    {__("mcs_sync_complete_message", ["[category_name]" => $category_name,"[url]" => $url])}
    
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

{capture name="buttons"}
	{include file="buttons/button.tpl" but_href="sync.manage?sync_mode=check" but_text="{__('mcs_check_products_to_sync')}" but_role="text" but_meta="btn btn-primary cm-ajax" but_target_id="mcs_results"}
{/capture}

</form><!--mcs_results--></div>
{/capture}

{include file="common/mainbox.tpl" title=__("mcs_synchronization") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons no_sidebar=true}