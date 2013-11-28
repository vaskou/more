{if $grid.alpha}<div class="row{if $addons.mcs_responsive.mcs_fluid_enabled=='true'}-fluid{/if}">{/if}
    <div class="span{$grid.width}{if $grid.offset} offset{$grid.offset}{/if} {$grid.user_class}" >
        {if $grid.status == "A" && $content}
            {$content nofilter}
        {/if}
    </div>
{if $grid.omega}</div>{/if}

{*********************************************CSP changes************************************************}
{*Line   1: added {if $addons.mcs_responsive.mcs_fluid_enabled=='true'}-fluid{/if}						*}