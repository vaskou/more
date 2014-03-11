{assign icon_size $block.properties.mcs_contact_block_icons_size}

<div class="mcs_contact_block block_id_{$block.block_id} {$block.properties.mcs_contact_block_alignment} {$block.properties.mcs_contact_block_text_alignment}">
	
	{if $block.properties.mcs_contact_block_text_pre!=""}
		<div class="section text-pre">
			{$block.properties.mcs_contact_block_text_pre nofilter}
		</div>
	{/if}	
	
	<div class="section name-wrapper">
		{if $block.properties.mcs_contact_block_copyright=="Y"}
			<span class="copyright">©</span>
		{/if}
		{if $block.properties.mcs_contact_block_start_year=="Y"}
			<span class="start_year">{$settings.Company.company_start_year}</span>
		{/if}
		
		{if $block.properties.mcs_contact_block_name=="Y"}
			<span class="name">{$settings.Company.company_name}</span>
		{/if}
	
	</div>
	

			<div class="section address-wrapper">
			
	{if $block.properties.mcs_contact_block_address_link!=""&&$block.properties.mcs_contact_block_address=="Y"&&$block.properties.mcs_contact_block_address!=""}
		<a class="map link" href="{$block.properties.mcs_contact_block_address_link}" target="_blank"> 
			
	{/if}			
					<i class="icon-location {$icon_size}"></i>
					<span class="address">{$settings.Company.company_address}</span> 
				{if $block.properties.mcs_contact_block_city=="Y"&&$block.properties.mcs_contact_block_city!=""}
					<span class="city">{$settings.Company.company_city}</span> 
				{/if}
				
				{if $block.properties.mcs_contact_block_zipcode=="Y"&&$block.properties.mcs_contact_block_zipcode!=""}
					<span class="zipcode">{$settings.Company.company_zipcode}</span> 
				{/if}

				{if $block.properties.mcs_contact_block_state=="Y"&&$block.properties.mcs_contact_block_state!=""}
					<span class="state">{$settings.Company.company_state}</span> 
				{/if}

				{if $block.properties.mcs_contact_block_country=="Y"&&$block.properties.mcs_contact_block_country!=""}
					<span class="country">{$settings.Company.company_country}</span> 
				{/if}
				
	{if $block.properties.mcs_contact_block_address_link!=""}
		</a>
	{/if}

	</div>

	
	<div class="section phones-wrapper">
		{if $block.properties.mcs_contact_block_phone=="Y"&&$block.properties.mcs_contact_block_phone!=""}
			<a class="phone link" title="{__(company_phone)}" href="tel:{$settings.Company.company_phone}" target="_blank"> 
				<i class="icon-phone3 {$icon_size}"></i><span>{$settings.Company.company_phone}</span>
			</a>
		{/if}
			
		{if $block.properties.mcs_contact_block_phone_2=="Y"&&$block.properties.mcs_contact_block_phone_2!=""}
			<a class="phone_2 link" title="{__(company_phone)} 2" href="tel:{$settings.Company.company_phone_2}" target="_blank"> 
				<i class="icon-mobile {$icon_size}"></i><span>{$settings.Company.company_phone_2}</span>
			</a>
		{/if}
		
		{if $block.properties.mcs_contact_block_fax=="Y"&&$block.properties.mcs_contact_block_fax!=""} 
			<a class="fax link" title="{__(fax)}" href="tel:{$settings.Company.company_fax}" target="_blank"> 
				<i class="icon-phone {$icon_size}"></i><span>{$settings.Company.company_fax}</span>
			</a>
		{/if}
		
		{if $block.properties.mcs_contact_block_skype!=""} 
			<a class="fax link" title="Skype" href="tel:{$block.properties.mcs_contact_block_skype}" target="_blank"> 
				<i class="icon-skype {$icon_size}"></i><span>{$block.properties.mcs_contact_block_skype}</span>
			</a>
		{/if}

		</div>
	
	{if $block.properties.mcs_contact_block_website=="Y"&&$block.properties.mcs_contact_block_website!=""}
		<div class="section website-wrapper">

			<a class="website link" title="{__(website)}" href="{$settings.Company.company_website}"> 
				<i class="icon-link {$icon_size}"></i><span>{$settings.Company.company_website}</span>
			</a>
		</div>
	{/if}

	
	{if $block.properties.mcs_contact_block_users_department=="Y"||$block.properties.mcs_contact_block_site_administrator=="Y"||$block.properties.mcs_contact_block_orders_department=="Y"||$block.properties.mcs_contact_block_support_department=="Y"||$block.properties.mcs_contact_block_newsletter_email=="Y"}
		
		<div class="section emails-wrapper">
			
			{if $block.properties.mcs_contact_block_users_department=="Y"}	
				<a class="users_department link" href="mailto:{$settings.Company.company_users_department}"> 
					<i class="icon-envelop {$icon_size}"></i><span>{$settings.Company.company_users_department}</span>
				</a>
			{/if}

			{if $block.properties.mcs_contact_block_site_administrator=="Y"}
				<a class="site_administrator link" href="mailto:{$settings.Company.company_site_administrator}"> 
					<i class="icon-envelop {$icon_size}"></i><span>{$settings.Company.company_site_administrator}</span>
				</a>
			{/if}


			{if $block.properties.mcs_contact_block_orders_department=="Y"}
				<a class="orders_department link" href="mailto:{$settings.Company.company_orders_department}"> 
					<i class="icon-envelop {$icon_size}"></i><span>{$settings.Company.company_orders_department}</span>
				</a>
			{/if}

			{if $block.properties.mcs_contact_block_support_department=="Y"}
				<a class="support_department link" href="mailto:{$settings.Company.company_support_department}"> 
					<i class="icon-envelop {$icon_size}"></i><span>{$settings.Company.company_support_department}</span>
				</a>
			{/if}	

			{if $block.properties.mcs_contact_block_newsletter_email=="Y"}
				<a class="newsletter_email link" href="mailto:{$settings.Company.company_newsletter_email}"> 
					<i class="icon-envelop {$icon_size}"></i><span>{$settings.Company.company_newsletter_email}</span>
				</a>
			{/if}
		</div>
		
	{/if}
	
	{if $block.properties.mcs_contact_block_form_link!=""}
		<div class="section form-wrapper">

			<a class="form link" title="{__(contact_us)}" href="{$block.properties.mcs_contact_block_form_link}"> 
				<i class="icon-pen {$icon_size}"></i><span>{__(contact_us)}</span>
			</a>
		</div>
	{/if}
	
	{if $block.properties.mcs_contact_block_text_post!=""}
		<div class="section text-post">
			{$block.properties.mcs_contact_block_text_post nofilter}
		</div>
	{/if}	
</div>

<style type="text/css">
	{literal}
	.mcs_contact_block,.mcs_contact_block div,.mcs_contact_block span{
		color:{/literal} {$block.properties.mcs_contact_block_text_color}{literal}!important;
	}		
	.mcs_contact_block a,.mcs_contact_block a i, .mcs_contact_block a span{
		color:{/literal} {$block.properties.mcs_contact_block_link_color}{literal}!important;
	}
	.mcs_contact_block a:hover,.mcs_contact_block a:hover i, .mcs_contact_block a:hover span{
		color:{/literal} {$block.properties.mcs_contact_block_link_hover_color}{literal}!important;
		-moz-transition: all 0.5s ease;
	-webkit-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	-ms-transition: all 0.5s ease;
	transition: all 0.5s ease;
	}
	{/literal}
</style>