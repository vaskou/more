{if $addons.mcs_framework.mcs_grs_product_availability=="Y"}

{capture name="product_amount_`$obj_id`"}
{if $show_product_amount && $product.is_edp != "Y" && $settings.General.inventory_tracking == "Y"}
	<div class="cm-reload-{$obj_prefix}{$obj_id} stock-wrap" id="product_amount_update_{$obj_prefix}{$obj_id}">
		<input type="hidden" name="appearance[show_product_amount]" value="{$show_product_amount}" />
		{if !$product.hide_stock_info}
			{if $settings.Appearance.in_stock_field == "Y"}
				{if $product.tracking != "D"}
					{if ($product_amount > 0 && $product_amount >= $product.min_qty) && $settings.General.inventory_tracking == "Y" || $details_page}
						{if ($product_amount > 0 && $product_amount >= $product.min_qty) && $settings.General.inventory_tracking == "Y"}
							<div class="control-group product-list-field">
								<label>{__("availability")}:</label>
								<span itemprop="availability" content="in_stock" id="qty_in_stock_{$obj_prefix}{$obj_id}" class="qty-in-stock">{__("in_stock")}</span>
								<span itemprop="quantity" style="padding:0px;">{$product_amount}</span>&nbsp;{__("items")}   
							</div>
						{elseif $settings.General.inventory_tracking == "Y" && $settings.General.allow_negative_amount != "Y"}
							<div class="control-group product-list-field">
								<label>{__("in_stock")}:</label>
								<span itemprop="availability" content="out_of_stock" class="qty-out-of-stock">{$out_of_stock_text}</span>
							</div>
						{/if}
					{/if}
				{/if}
			{else}
				{if ((($product_amount > 0 && $product_amount >= $product.min_qty) || $product.tracking == "D") && $settings.General.inventory_tracking == "Y" && $settings.General.allow_negative_amount != "Y") || ($settings.General.inventory_tracking == "Y" && $settings.General.allow_negative_amount == "Y")}
					<div class="control-group product-list-field">
						<label>{__("availability")}:</label>
						<span itemprop="availability" content="in_stock" class="qty-in-stock" id="in_stock_info_{$obj_prefix}{$obj_id}">{__("in_stock")}</span>
					</div>
				{elseif $details_page && ($product_amount <= 0 || $product_amount < $product.min_qty) && $settings.General.inventory_tracking == "Y" && $settings.General.allow_negative_amount != "Y"}
					<div class="control-group product-list-field">
						<label>{__("availability")}:</label>
						<span itemprop="availability" content="out_of_stock" class="qty-out-of-stock" id="out_of_stock_info_{$obj_prefix}{$obj_id}">{$out_of_stock_text}</span>
					</div>
				{/if}
			{/if}
		{/if}
	<!--product_amount_update_{$obj_prefix}{$obj_id}--></div>
{/if}
{/capture}
{if $no_capture}
	{assign var="capture_name" value="product_amount_`$obj_id`"}
	{$smarty.capture.$capture_name nofilter}
{/if}

{/if}

{if $addons.mcs_framework.mcs_grs_product_sku=="Y"}

{capture name="sku_`$obj_id`"}
	{if $show_sku}
		<div class="control-group product-list-field cm-reload-{$obj_prefix}{$obj_id}{if !$product.product_code} hidden{/if}" id="sku_update_{$obj_prefix}{$obj_id}">
			<input type="hidden" name="appearance[show_sku]" value="{$show_sku}" />
			<label id="sku_{$obj_prefix}{$obj_id}">{__("sku")}:</label>
			<span itemprop="identifier" content="sku:{$product.product_code}" id="product_code_{$obj_prefix}{$obj_id}">{$product.product_code}</span>
		<!--sku_update_{$obj_prefix}{$obj_id}--></div>
	{/if}
{/capture}
{if $no_capture}
	{assign var="capture_name" value="sku_`$obj_id`"}
	{$smarty.capture.$capture_name nofilter}
{/if}
	
{/if}

{********************** Price *********************}
{if $addons.mcs_framework.mcs_grs_product=="Y"}

{capture name="price_`$obj_id`"}
	<span class="cm-reload-{$obj_prefix}{$obj_id} price-update" id="price_update_{$obj_prefix}{$obj_id}">
		<input type="hidden" name="appearance[show_price_values]" value="{$show_price_values}" />
		<input type="hidden" name="appearance[show_price]" value="{$show_price}" />
		{if $show_price_values}
			{if $show_price}
			{hook name="products:prices_block"}
				<span itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
				<meta itemprop="currency" content="{$secondary_currency}" />
				{if $product.price|floatval || $product.zero_price_action == "P" || ($hide_add_to_cart_button == "Y" && $product.zero_price_action == "A")}
					<span itemprop="price" class="price{if !$product.price|floatval && !$product.zero_price_action} hidden{/if}" id="line_discounted_price_{$obj_prefix}{$obj_id}">{if $details_page}{/if}{include file="common/price.tpl" value=$product.price span_id="discounted_price_`$obj_prefix``$obj_id`" class="price-num"}</span>
				{elseif $product.zero_price_action == "A"}
					{assign var="base_currency" value=$currencies[$smarty.const.CART_PRIMARY_CURRENCY]}
					<span class="price-curency"><span>{__("enter_your_price")}: {if $base_currency.after != "Y"}{$base_currency.symbol}{/if}</span><input class="input-text-short" type="text" size="3" name="product_data[{$obj_id}][price]" value="" />{if $base_currency.after == "Y"}{$base_currency.symbol}{/if}</span>
				{elseif $product.zero_price_action == "R"}
					<span class="no-price">{__("contact_us_for_price")}</span>
					{assign var="show_qty" value=false}
				{/if}
				</span>
			{/hook}
			{/if}
		{elseif $settings.General.allow_anonymous_shopping == "hide_price_and_add_to_cart" && !$auth.user_id}
			<span class="price">{__("sign_in_to_view_price")}</span>
		{/if}
	<!--price_update_{$obj_prefix}{$obj_id}--></span>
{/capture}
{if $no_capture}
	{assign var="capture_name" value="price_`$obj_id`"}
	{$smarty.capture.$capture_name nofilter}
{/if}

{/if}