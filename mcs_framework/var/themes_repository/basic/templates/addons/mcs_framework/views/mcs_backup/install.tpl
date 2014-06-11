{*$map_settings|var_dump*}

<table class="table">
<thead>
<th>object_id</th>
<th>name</th>
</thead>

{foreach from=$map_settings item="item"}
<tr>
	<td>{$item.object_id}</td>
    <td>{$item.name}</td>
</tr>
{/foreach}

</table>