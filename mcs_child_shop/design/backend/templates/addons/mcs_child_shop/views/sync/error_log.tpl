{capture name="mainbox"}
{if $auth['is_root']=='Y'}
    {if $mcs_error_log}
        {foreach from=$mcs_error_log item=line}
            <p>{$line}</p>
        {/foreach}
    {/if}
    
    <hr />
    <a href="{"sync.error_log?clear=true"|fn_url}" class="btn">{__("mcs_clear_error_log")}</a>
{/if}
{/capture}

{include file="common/mainbox.tpl" title=__("mcs_error_log") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons no_sidebar=true}