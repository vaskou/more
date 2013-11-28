{if $content|trim}
    <div id="mcs-tab-content-{$block.snapping_id}" class="mcs-tab-content clearfix{if isset($hide_wrapper)} cm-hidden-wrapper{/if}{if $hide_wrapper} hidden{/if}{if $block.user_class} {$block.user_class}{/if}{if $content_alignment == "RIGHT"} float-right{elseif $content_alignment == "LEFT"} float-left{/if}"
     data-title="{if $title || $smarty.capture.title|trim}
     				{if $smarty.capture.title|trim}
                    	{$smarty.capture.title nofilter}
	                {else}
    	                <span>{$title nofilter}</span>
        	        {/if}
                {/if}" data-snapping-id={$block.snapping_id} 
                data-hover={$addons.mcs_framework.mcs_tab_block_hover}>
       
        {$content nofilter}
    </div>
{/if}