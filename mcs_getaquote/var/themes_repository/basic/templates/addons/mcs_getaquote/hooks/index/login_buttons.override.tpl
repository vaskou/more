{* Get a quote button login popup *}
{hook name="index:login_buttons"}
    {if $style != "checkout"}
        <div class="{if $style == "popup"}buttons-container{/if}">
    {/if}
        <div class="body-bc clearfix">
            <div class="float-right">
                {include file="buttons/login.tpl" but_name="dispatch[auth.login]" but_role="submit"}
            </div>
            <div class="remember-me-chekbox">
                <label for="remember_me_{$id}" class=""><input class="checkbox" type="checkbox" name="remember_me" id="remember_me_{$id}" value="Y" />{__("remember_me")}</label>
            </div>
            {if $show_register}
            <div class="mcs-register-button">
            	<span class="mcs-register-question">{__("mcs_you_dont_have_an_account")}</span>
                {include file="buttons/register.tpl" but_href="profiles.add" but_role="action"}
            </div>
            {/if}
        </div>
    {if $style != "checkout"}
        </div>
    {/if}
{/hook}