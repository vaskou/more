{capture name="mainbox"}
<form action="{""|fn_url}" method="post" class="cm-ajax">
{literal}
<script>
$(function(){
	$(document).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions) {
		var arr=JSON.parse(XMLHttpRequest.responseText);
		$(".admin-content-wrap").html(arr.text);
    });
})
</script>

{/literal}

<h1>{__("mcs_synchronization")}</h1>
{if $mcs_timestamp!=0}
	<h3>{$mcs_timestamp|date_format:"%A, %e %B, %Y, (%H:%M:%S)"}</h3>
{/if}
{if $auth.is_root == 'Y' && $mcs_child_shop_status=='A'}
    {if $mcs_timestamp==0 || !$mcs_timestamp}
        <label class="checkbox">{__("mcs_synchronize_categories")}
            <input name="mcs_sync_categ" type="checkbox" value="true"/>
        </label>
        <label class="checkbox">{__("mcs_make_products_active")}
            <input name="mcs_sync_products_enabled" type="checkbox" value="true" />
        </label>
        <input type="hidden" value="all" name="product_id" />
        <input type="submit" name="dispatch[sync.manage]" value="{__('mcs_first_time_sync')}" class="btn btn-primary" />
    {else}
        <a class="cm-ajax btn btn-primary" href="{"sync.manage&product_id=new"|fn_url}">{__("mcs_new_products_sync")}</a>
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
            <td><a href="admin.php?dispatch=products.update&product_id={$product.product_id}" target="_blank">{$product.name}</a></td>
        </tr>
    {/foreach}
    </tbody>
</table>
{/if}
</form>
{/capture}

{include file="common/mainbox.tpl" title=__("mcs_synchronization") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons no_sidebar=true}