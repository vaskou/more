{capture name="mainbox"}

<h1>TEST {$mcs_timestamp}</h1>
{if $mcs_timestamp==0 || !$mcs_timestamp}
	{include file="buttons/button.tpl" but_text="First Time Synchronization" but_role="action" but_href="sync.manage&product_id=all"}
{else}
	{include file="buttons/button.tpl" but_text="New Products Synchronization" but_role="action" but_href="sync.manage&product_id=new"}
{/if}

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
{/capture}

{include file="common/mainbox.tpl" title=__("banners") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons no_sidebar=true}