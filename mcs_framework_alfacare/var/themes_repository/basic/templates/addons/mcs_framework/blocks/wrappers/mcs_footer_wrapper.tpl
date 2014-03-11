{if $content|trim}
    {if $anchor}
    <a name="{$anchor}"></a>
    {/if}
    <div class="footer-wrapper-container{if isset($hide_wrapper)} cm-hidden-wrapper{/if}{if $hide_wrapper} hidden{/if}{if $block.user_class} {$block.user_class}{/if}{if $content_alignment == "RIGHT"} float-right{elseif $content_alignment == "LEFT"} float-left{/if}">
        <h3 class="footer-wrapper-title clearfix">
            {hook name="wrapper:footer_wrapper_title"}
            {if $smarty.capture.title|trim}
                {$smarty.capture.title nofilter}
            {else}
                <span>{$title nofilter}</span>
            {/if}
            {/hook}
        </h3>
        <div class="footer-wrapper-body">{$content nofilter}</div>
        <div class="footer-wrapper-bottom"><span></span></div>
    </div>
{/if}