{if $smarty.session.cart.amount}
    <i class="ty-minicart__icon ty-icon-basket filled"></i>
    <span class="ty-minicart-title ty-hand">{$smarty.session.cart.amount}<span class="hidden-phone">&nbsp;{__("items")} {__("for")}&nbsp;{include file="common/price.tpl" value=$smarty.session.cart.display_subtotal}</span></span>
    <i class="ty-icon-down-micro"></i>
{else}
    <i class="ty-minicart__icon ty-icon-basket empty"></i>
    <span class="ty-minicart-title empty-cart ty-hand">{__("cart_is_empty")}</span>
    <i class="ty-icon-down-micro"></i>
{/if}