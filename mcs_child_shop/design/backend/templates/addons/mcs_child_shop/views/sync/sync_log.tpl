{capture name="mainbox"}

<div id="sync_log">

{if $mcs_files}
<form class="cm-ajax cm-ajax-full-render form-inline" action="{""|fn_url}" method="post" name="sync_log">
    <input type="hidden" name="result_ids" value="sync_log" />
    
    <select name="fname" id="f_select">
    	{foreach from=$mcs_files key=fkey item=file}
        	{assign var=tstamp value=".log"|str_replace:"":$file}
            {assign var=f_name value="Y-m-d H:i:s"|date:$tstamp}
        	<option value="{$tstamp}" {if $mcs_fname==$tstamp}selected="selected"{/if}>{$f_name}</option>
        {/foreach}
    </select>
    
    {include file="buttons/button.tpl" but_text=__("mcs_show_log") but_id="sync_log_button" but_meta="ty-btn__secondary" but_name="dispatch[sync.sync_log]" but_role="submit"}
</form>
{else}
	<div>
    	<h3>{__("mcs_no_sync_logs")}</h3>
    </div>
{/if}
{if $mcs_sync_log}
    <table class="table table-striped">
    <thead>
        <tr>
            <th style="width:100px">{__('product_id')}</span></th>
            <th><span>{__('product_name')}</span></th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$mcs_sync_log item=product}
        <tr>
            <td>{$product.product_id}</td>
            <td><a href="{"products.update&product_id=`$product.product_id`"|fn_url}" target="_blank">{$product.name}</a></td>
        </tr>
    {/foreach}
    </tbody>
</table>
{/if}

<!--sync_log--></div>
{/capture}

{include file="common/mainbox.tpl" title=__("mcs_sync_log") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons no_sidebar=true}