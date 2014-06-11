{*$general_settings|var_dump*}
<table class="table">
<thead>
<th>object_id</th>
<th>name</th>
<th>value</th>
</thead>

{foreach from=$general_settings item="item"}
<tr>
	<td>{$item.object_id}</td>
    <td>{$item.name}</td>
    <td>{$item.value}</td>
</tr>
{/foreach}

</table>

</br>

{*$vendor_settings|var_dump*}
<table class="table">
<thead>
<th>object_id</th>
<th>name</th>
<th>value</th>
<th>company_id</th>
</thead>

{foreach from=$vendor_settings item="item"}
<tr>
	<td>{$item.object_id}</td>
    <td>{$item.name}</td>
    <td>{$item.value}</td>
    <td>{$item.company_id}</td>
</tr>
{/foreach}

</table>