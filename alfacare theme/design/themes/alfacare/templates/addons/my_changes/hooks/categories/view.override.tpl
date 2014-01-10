<div id="category_products_{$block.block_id}">
	<div class="mcs_alpha_category_view">
		
		{assign var="subcategories_no" value=$subcategories|@count}

		{if $subcategories_no<=3||$subcategories_no==5||$subcategories_no==6}
		{assign var="subcat_block_width" value=33.33}
        {assign var="span_no" value=5}
        {assign var="columns" value=3}
		{/if}

		{if $subcategories_no==4||$subcategories_no==7||$subcategories_no==8||$subcategories_no>=11}
		{assign var="subcat_block_width" value=25}
        {assign var="span_no" value=4}
        {assign var="columns" value=4}
		{/if}
		
		{if $subcategories_no==9||$subcategories_no==10}
		{assign var="subcat_block_width" value=20}
        {assign var="span_no" value=3}
        {assign var="columns" value=5}
		{/if}

		{if $span_no==3||$span_no==5}
        {assign var="offset" value="first_offset"}
        {elseif $span_no==4}
        {assign var="offset" value="first"}
        {/if}
        
		{if $subcategories or $category_data.description || $category_data.main_pair}
		{math equation="ceil(n/c)" assign="rows" n=$subcategories|count c=$columns|default:"2"}
		{split data=$subcategories size=$rows assign="splitted_subcategories"}

		{if $category_data.description && $category_data.description != ""}
			<div class="compact wysiwyg-content margin-bottom">{$category_data.description nofilter}</div>
		{/if}

		<div class="clearfix">
			{if $subcategories}
			<div class="subcategories">
			<ul>
			{foreach from=$splitted_subcategories item="ssubcateg"}
				{foreach from=$ssubcateg item=category name="ssubcateg"}
                	{if $i!=$columns}
                        {$i=$i+1}
                    {else}
                        {$i=1}
                    {/if}
					{if $category}
						<li class="span{$span_no} {if $i==1}{$offset}{/if}">
                        	<div class="cat-img">
                                <a href="{"categories.view?category_id=`$category.category_id`"|fn_url}">
                                {*if $category.main_pair*}
                                    {include file="common/image.tpl"
                                        show_detailed_link=false
                                        images=$category.main_pair
                                        no_ids=true
                                        image_id="category_image"
                                        image_width=$settings.Thumbnails.category_lists_thumbnail_width
                                        image_height=$settings.Thumbnails.category_lists_thumbnail_height
                                    }
    
                                {*/if*}
                                </a>
                            </div>
                            <div class="cat-title">
                                <a href="{"categories.view?category_id=`$category.category_id`"|fn_url}">
                                {$category.category}
                                </a>
                            </div>
                        </li>
					{/if}
				{/foreach}
			{/foreach}
			</ul>
			</div>
			{/if}
		</div>
		{/if}

		{if $smarty.request.advanced_filter}
			{include file="views/products/components/product_filters_advanced_form.tpl" separate_form=true}
		{/if}

		{if $products}
		{assign var="layouts" value=""|fn_get_products_views:false:0}
		{if $category_data.product_columns}
			{assign var="product_columns" value=$category_data.product_columns}
		{else}
			{assign var="product_columns" value=$settings.Appearance.columns_in_products_list}
		{/if}

		{if $layouts.$selected_layout.template}
			{include file="`$layouts.$selected_layout.template`" columns=$product_columns}
		{/if}

		{elseif !$subcategories}
		<p class="no-items">{__("text_no_products")}</p>
		{/if}
		<!--category_products_{$block.block_id}-->

	</div>
</div>

{capture name="mainbox_title"}{$category_data.category}{/capture}
