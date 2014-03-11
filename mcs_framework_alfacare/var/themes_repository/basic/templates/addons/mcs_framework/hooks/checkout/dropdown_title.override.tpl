{if $smarty.session.cart.amount}
    <i class="{$addons.mcs_framework.mcs_block_icons_cart_block} filled"></i>
    <span class="minicart-title hand">{$smarty.session.cart.amount}<span class="mcs-phone-hide">&nbsp;{__("items")} {__("for")}&nbsp;{include file="common/price.tpl" value=$smarty.session.cart.display_subtotal}</span><i class="icon-down-micro"></i></span>
{else}
    <i class="{$addons.mcs_framework.mcs_block_icons_cart_block} empty"></i>
    <span class="minicart-title empty-cart hand"><span class="mcs-phone-hide">{__("cart_is_empty")}</span><i class="icon-down-micro"></i></span>
{/if}