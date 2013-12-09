{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
(function(_, $) {
    _.tr('text_items_added', '{__("text_items_added")|escape:"javascript"}');

    $.ceEvent('on', 'ce.formpost_brands_form', function(frm, elm) {

        var brands = {};

        if ($('input.cm-item:checked', frm).length > 0) {
            $('input.cm-item:checked', frm).each( function() {
                var id = $(this).val();
                brands[id] = $('#brand_' + id).text();
            });

            {literal}
            $.cePicker('add_js_item', frm.data('caResultId'), brands, 'b', {
                '{brand_id}': '%id',
                '{brand}': '%item'
            });
            {/literal}

            $.ceNotification('show', {
                type: 'N', 
                title: _.tr('notice'), 
                message: _.tr('text_items_added'), 
                message_state: 'I'
            });
        }

        return false;
    });

}(Tygh, Tygh.$));
//]]>
</script>
{/if}
</head>
<form action="{$smarty.request.extra|fn_url}" data-ca-result-id="{$smarty.request.data_id}" method="post" name="brands_form">
{if $brands}
<table width="100%" class="table table-middle">
<thead>
<tr>
    <th>
        {include file="common/check_items.tpl"}</th>
    <th>{__("brand")}</th>
</tr>
</thead>
{foreach from=$brands item=brand}
<tr>
    <td>
        <input type="checkbox" name="{$smarty.request.checkbox_name|default:"brands_ids"}[]" value="{$brand.variant_id}" class="cm-item" /></td>
    <td id="brand_{$brand.variant_id}" width="100%">{$brand.variant}</td>
</tr>
{/foreach}
</table>
{else}
    <p class="no-items">{__("no_data")}</p>
{/if}

{if $brands}
<div class="buttons-container">
    {include file="buttons/add_close.tpl" but_text=__("add_brands") but_close_text=__("add_brands_and_close") is_js=$smarty.request.extra|fn_is_empty}
</div>
{/if}

</form>
