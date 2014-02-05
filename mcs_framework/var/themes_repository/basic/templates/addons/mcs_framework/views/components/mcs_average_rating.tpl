{if $addons.mcs_framework.mcs_grs_product_reviews=="Y"&&$product.discussion}
	{assign var="average_rating" value=$product.product_id|fn_get_average_rating:"P"}
	{if $average_rating}
		<div class="product_reviews" style="min-height:26px;">
			<div class="product_reviews_stars" >
				{include file="addons/discussion/views/discussion/components/average_rating.tpl" object_id=$product.product_id object_type="P"}
			</div>
			<div class="product_reviews_average" style="line-height:26px;">
				<span itemprop="review" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
					<span class="label">{__("rating")}:</span> <span itemprop="rating">{$average_rating|round:"1"}</span> - <span itemprop="count">{$product.discussion.search.total_items}</span> {__("discussion_title_product")}
				</span>
			</div>
			
		</div>
	{/if}
{/if}