{if $addons.mcs_framework.mcs_product_categories_general_category_image=='Y'}
<div class="mcs-category-image">
	{if $category_data.main_pair}
		{include file="common/image.tpl" images=$category_data.main_pair}
    {/if}
</div>
{/if}