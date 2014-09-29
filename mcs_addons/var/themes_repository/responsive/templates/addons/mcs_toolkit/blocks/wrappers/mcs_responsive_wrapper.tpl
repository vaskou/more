{if $content|trim}
    <div id="mcs_responsive_wrapper_{$block.snapping_id}" class="mcs-responsive-wrapper {if isset($hide_wrapper)} cm-hidden-wrapper{/if}{if $hide_wrapper} hidden{/if}{if $details_page} details-page{/if}{if $block.user_class} {$block.user_class}{/if}{if $content_alignment == "RIGHT"} ty-float-right{elseif $content_alignment == "LEFT"} ty-float-left{/if}">
        {if $title || $smarty.capture.title|trim}
            <p class="mcs-responsive-wrapper__header cm-combination" id="sw_mcs_responsive_wrapper_header_{$block.snapping_id}">
                {hook name="wrapper:mcs_responsive_wrapper_title"}
                <span>
                    {if $smarty.capture.title|trim}
                        {$smarty.capture.title nofilter}
                    {else}
                        {$title nofilter}
                    {/if}
                </span>
                {/hook}
                <i class="mcs-responsive-wrapper__icon-open ty-icon-down-open"></i>
			    <i class="mcs-responsive-wrapper__icon-hide ty-icon-up-open"></i>
            </p>
        {/if}
        <div class="mcs-responsive-wrapper__body" id="mcs_responsive_wrapper_header_{$block.snapping_id}">{$content nofilter}</div>
    </div>
{/if}