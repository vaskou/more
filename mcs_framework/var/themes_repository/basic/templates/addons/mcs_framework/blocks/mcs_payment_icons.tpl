{assign var=icons value="\n"|explode:$block.content.payment_icons}

{if $block.properties.size=="32"}
	{assign var=width value="32"}
	{assign var=height value="20"}
{/if}
{if $block.properties.size=="64"}
	{assign var=width value="64"}
	{assign var=height value="40"}
{/if}

{if $block.properties.text_pre!=""}
<div class="text_pre">{$block.properties.text_pre nofilter}</div>
{/if}

<div id="mcs_payment_icons" class="{$block.properties.color} {$block.properties.hover}_hover"  style="text-align:{$block.properties.alignment};">
	{foreach from=$icons item=icon}
		<img  src="design/themes/{$settings.theme_name}/media/images/addons/mcs_framework/{$icon}.png" width={$width} height={$height} title="{$icon}" alt="{$icon}"  />
	{/foreach}
</div>

{if $block.properties.text_post!=""}
<div class="text_post">{$block.properties.text_post nofilter}</div>
{/if}