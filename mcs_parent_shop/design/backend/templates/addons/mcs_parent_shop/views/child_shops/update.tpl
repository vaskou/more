{if $child_shop_data}
    {assign var="id" value=$child_shop_data.child_shop_id}
{else}
    {assign var="id" value=0}
{/if}

{assign var="allow_save" value=$child_shop_data|fn_allow_save_object:"child_shops"}

{capture name="mainbox"}

<form action="{""|fn_url}" method="post" class="form-horizontal form-edit  {if !$allow_save} cm-hide-inputs{/if}" name="child_shop_form" enctype="multipart/form-data">
<input type="hidden" class="cm-no-hide-input" name="fake" value="1" />
<input type="hidden" class="cm-no-hide-input" name="child_shop_id" value="{$id}" />

{capture name="tabsbox"}
<div id="content_general">
    <div class="control-group">
        <label for="elm_child_shop_domain" class="control-label cm-required">{__("mcs_child_shop_domain")}{include file="common/tooltip.tpl" tooltip=__(mcs_child_shop_domain_tooltip)}:</label>
        <div class="controls">
        <input placeholder="http://" type="text" name="child_shop_data[domain]" id="elm_child_shop_domain" value="{$child_shop_data.domain}" size="25" class="input-large" /></div>
    </div>

    {include file="common/select_status.tpl" input_name="child_shop_data[status]" id="elm_child_shop_status" obj_id=$id obj=$child_shop_data hidden=true}
</div>
{/capture}
{include file="common/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

{capture name="buttons"}
    {if !$id}
        {include file="buttons/save_cancel.tpl" but_role="submit-link" but_target_form="child_shop_form" but_name="dispatch[child_shops.update]"}
    {else}
        {if "ULTIMATE"|fn_allowed_for && !$allow_save}
            {assign var="hide_first_button" value=true}
            {assign var="hide_second_button" value=true}
        {/if}
        {include file="buttons/save_cancel.tpl" but_name="dispatch[child_shops.update]" but_role="submit-link" but_target_form="child_shop_form" hide_first_button=$hide_first_button hide_second_button=$hide_second_button save=$id}
    {/if}
{/capture}
    
</form>

{/capture}

{if !$id}
    {assign var="title" value=__("mcs_child_shop_add")}
{else}
    {assign var="title" value="{__("mcs_child_shop_editing")}: `$child_shop_data.domain`"}
{/if}
{include file="common/mainbox.tpl" title=$title content=$smarty.capture.mainbox buttons=$smarty.capture.buttons select_languages=true}