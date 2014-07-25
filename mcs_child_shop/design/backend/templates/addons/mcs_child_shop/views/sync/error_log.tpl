{capture name="mainbox"}

<h1>Error Log</h1>

{if $mcs_error_log}
	{foreach from=$mcs_error_log item=line}
    	<p>{$line}</p>
    {/foreach}
{/if}

{/capture}

{include file="common/mainbox.tpl" title="Error Log" content=$smarty.capture.mainbox buttons=$smarty.capture.buttons no_sidebar=true}