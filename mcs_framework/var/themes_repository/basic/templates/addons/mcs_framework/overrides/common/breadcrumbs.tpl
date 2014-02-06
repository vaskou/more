{if $addons.mcs_framework.mcs_grs_breadcrumbs=="Y"}
	{assign var=bc_enabled value="Y"}
{/if}

<div id="breadcrumbs_{$block.block_id}">

{if $breadcrumbs && $breadcrumbs|@sizeof > 1}
    <div class="breadcrumbs clearfix">
    	<i class="icon-home3 breadcrumbs-icon"></i>
        {strip}
            {foreach from=$breadcrumbs item="bc" name="bcn" key="key"}
                {if $key != "0"}
                    <i class="icon-right-open-thin"></i>
                {/if}
                {if $bc.link}
					{if $bc_enabled=="Y"}<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">{/if}
						<a {if $bc_enabled=="Y"}itemprop="url"{/if} href="{$bc.link|fn_url}"{if $additional_class} class="{$additional_class}"{/if}{if $bc.nofollow} rel="nofollow"{/if}>{if $bc_enabled=="Y"}<span itemprop="title">{/if}{$bc.title|strip_tags|escape:"html" nofilter}{if $bc_enabled=="Y"}</span>{/if}</a>
					{if $bc_enabled=="Y"}</span>{/if}
				{else}
					{if $bc_enabled=="Y"}<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">{/if}
						<span {if $bc_enabled=="Y"}itemprop="title"{/if}>{$bc.title|strip_tags|escape:"html" nofilter}</span>
					{if $bc_enabled=="Y"}</span>{/if}
                {/if}
            {/foreach}
            {include file="common/view_tools.tpl"}
        {/strip}
    </div>
{/if}

<!--breadcrumbs_{$block.block_id}--></div>

{*********************************************MCS changes************************************************}
{*Line    1-3: added lines																				*}
{*Line      9: added i																					*}
{*Line  16-22: added lines																				*}