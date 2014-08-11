{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="child_shops_form" class=" cm-hide-inputs" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />


{if $child_shops}
<table class="table table-middle">
<thead>
<tr>
    <th width="1%" class="left">
        {include file="common/check_items.tpl" class="cm-no-hide-input"}</th>
    <th>{__("mcs_child_shop")}</th>
	<th width="20%">{__("website")}</th>
	<th width="20%"><i class="icon-time icon-black"></span></th>
	<th width="6%">&nbsp;</th>
    <th width="10%" class="right">{__("status")}</th>
</tr>
</thead>
{foreach from=$child_shops item=cs}

{if $cs.timestamp=="0"}
{assign var=last_sync_date value=__("never")}
{else}
{assign var=last_sync_date value=$cs.timestamp|date_format:"%A, %e %B, %Y, (%H:%M:%S)"}
{/if}

<tr class="cm-row-status-{$cs.status|lower}">
    {assign var="allow_save" value=$cs|fn_allow_save_object:"child_shops"}

    {if $allow_save}
        {assign var="no_hide_input" value="cm-no-hide-input"}
    {else}
        {assign var="no_hide_input" value=""}
    {/if}

    <td class="left">
        <input type="checkbox" name="child_shops_ids[]" value="{$cs.child_shop_id}" class="cm-item {$no_hide_input}" />
	</td>
    <td class="{$no_hide_input}">
        <a class="row-status" href="{"child_shops.update?child_shop_id=`$cs.child_shop_id`"|fn_url}">{$cs.domain}</a>
    </td>
    <td>
        <a class="row-status" target="_blank" href="http://{$cs.domain}"><i class="icon-shopping-cart icon-black"></i></a>
    </td>
    <td>
        <div class="row-status">{$last_sync_date}</i></div>
    </td>
	<td>
        {capture name="tools_list"}
            <li>{btn type="list" text=__("edit") href="child_shops.update?child_shop_id=`$cs.child_shop_id`"}</li>
        {if $allow_save}
            <li>{btn type="list" class="cm-confirm" text=__("delete") href="child_shops.delete?child_shop_id=`$cs.child_shop_id`"}</li>
        {/if}
        {/capture}
        <div class="hidden-tools">
            {dropdown content=$smarty.capture.tools_list}
        </div>
    </td>
    <td class="right">
        {include file="common/select_popup.tpl" id=$cs.child_shop_id status=$cs.status hidden=true object_id_name="child_shop_id" table="mcs_child_shops" popup_additional_class="`$no_hide_input` dropleft"}
    </td>	
</tr>
{/foreach}
</table>
{else}
    <p class="no-items">{__("no_data")}</p>
{/if}

{capture name="buttons"}
    {capture name="tools_list"}
        {if $child_shops}
            <li>{btn type="delete_selected" dispatch="dispatch[child_shops.m_delete]" form="child_shops_form"}</li>
        {/if}
    {/capture}
    {dropdown content=$smarty.capture.tools_list}
{/capture}
{capture name="adv_buttons"}
    {include file="common/tools.tpl" tool_href="child_shops.add" prefix="top" hide_tools="true" title=__("mcs_child_shop_add") icon="icon-plus"}
{/capture}

</form>


{/capture}

{include file="common/mainbox.tpl" title=__("mcs_child_shops") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons adv_buttons=$smarty.capture.adv_buttons select_languages=true}


