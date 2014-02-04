{** block-description:mcs_social_links **}

{assign alignment $block.properties.mcs_social_icons_alignment}
{assign size $block.properties.mcs_social_icons_size}

{if $block.properties.mcs_social_icons_border=="Y"}
{assign border "icon-border"}
{/if}

{if $block.properties.mcs_social_icons_shadow=="Y"}
{assign shadow "shadow"}
{/if}

{if $block.properties.mcs_social_icons_circle=="Y"}
{assign circle "circle"}
{/if}

{if $block.properties.mcs_social_icons_color=="Y"}
{assign color "color"}
{/if}

{if $block.properties.mcs_social_icons_white=="Y"}
{assign white "white"}
{/if}

<div id="mcs_social_links_{$block.snapping_id}" class="{$shadow} {$circle} {$color} {$white} {$alignment} {$size}" >

		{if $block.content.mcs_rss!=""}			<a title="RSS feed" target="_blank" href="{$block.content.mcs_rss}"><i class="icon-feed2 {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_twitter!=""}		<a title="Twitter" target="_blank" href="{$block.content.mcs_twitter}"><i class="icon-twitter {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_facebook!=""}	<a title="Facebook" target="_blank" href="{$block.content.mcs_facebook}"><i class="icon-facebook {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_googleplus!=""}	<a title="Google Plus" target="_blank" href="{$block.content.mcs_googleplus}"><i class="icon-google-plus {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_linkedin!=""}	<a title="Linked In" target="_blank" href="{$block.content.mcs_linkedin}"><i class="icon-linkedin {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_dribbble!=""}	<a title="Dribbble" target="_blank" href="{$block.content.mcs_dribbble}"><i class="icon-dribbble {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_tumblr!=""}		<a title="Tumblr" target="_blank" href="{$block.content.mcs_tumblr}"><i class="icon-tumblr {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_instagram!=""}	<a title="Instagram" target="_blank" href="{$block.content.mcs_instagram}"><i class="icon-instagram {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_youtube!=""}		<a title="You Tube" target="_blank" href="{$block.content.mcs_youtube}"><i class="icon-youtube {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_pinterest!=""}	<a title="Pinterest" target="_blank" href="{$block.content.mcs_pinterest}"><i class="icon-pinterest {$size} {$border}"></i></a>{/if}
		{if $block.content.mcs_email!=""}		<a title="Email" target="_blank" href="mailto:{$block.content.mcs_email}"><i class="icon-envelop {$size} {$border}	"></i></a>{/if}

</div>