{assign var="product_category" value=$product.main_category|fn_get_category_data}
{assign var="categories_path_ids" value="/"|explode:$product_category.id_path}
{assign var="categories_path" value=""}
{assign var="loop_counter" value="0"}

{strip}
{foreach $categories_path_ids as $categories_path_id}
	{if $loop_counter=="0"} 
	{else}
	{assign var="categories_path" value="`$categories_path` > "}
	{/if}
	{assign var="product_path_category" value=$categories_path_id|fn_get_category_data}
	{assign var="categories_path" value="`$categories_path``$product_path_category.category`"}
	{assign var="loop_counter" value="1"}
{/foreach}
{/strip}


<div class="product_category">
<span class="label">{__("category")}:</span> <span itemprop="category" content="{$categories_path}">{$product_category.category}</span>
</div>