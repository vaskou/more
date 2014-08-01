{capture name="mainbox"}
<form action="admin.php" method="post" class="cm-ajax">
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

<h1>{__("mcs_synchronization")} {$mcs_timestamp}</h1>
{if $mcs_timestamp==0 || !$mcs_timestamp}
	{*include file="buttons/button.tpl" but_text="First Time Synchronization" but_role="action" but_href="sync.manage&product_id=all" but_id="btn_sync"*}
	<label class="checkbox">Synchronize Categories
    	<input name="mcs_sync_categ" type="checkbox" value="true"/>
    </label>
    <label class="checkbox">Make Products Active
    	<input name="mcs_sync_enabled" type="checkbox" value="true" />
    </label>
    <input type="hidden" value="all" name="product_id" />
    {*<a class="cm-ajax btn" href="{"sync.manage&product_id=all"|fn_url}">First Time Synchronization</a>*}
    <input type="submit" name="dispatch[sync.manage]" value="First Time Synchronization" class="btn" />
{else}
	{*include file="buttons/button.tpl" but_text="New Products Synchronization" but_role="action" but_href="sync.manage&product_id=new" but_id="btn_sync"*}
    <a class="cm-ajax btn" href="{"sync.manage&product_id=new"|fn_url}">New Products Synchronization</a>
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