{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

<p>{l s='Your order on %s is complete.' sprintf=[$shop_name] d='Modules.Checkpayment.Shop'}</p>
<p>{l s='Your check must include:' d='Modules.Checkpayment.Shop'}</p>

<ul>
	<li>
		{l s='Payment amount.' d='Modules.Checkpayment.Shop'}
		<span class="price"><strong>{$total_to_pay}</strong></span>
	</li>

	<li>
		{l s='Payable to the order of' d='Modules.Checkpayment.Shop'}
		<strong>{if $checkName}{$checkName}{else}___________{/if}</strong>
	</li>

	<li>
		{l s='Mail to' d='Modules.Checkpayment.Shop'}
		<strong>{if $checkAddress}{$checkAddress nofilter}{else}___________{/if}</strong>
	</li>

	<li>
		{l s='Do not forget to insert your order reference %s.' sprintf=[$reference] d='Modules.Checkpayment.Shop'}
	</li>
</ul>

<p>{l s='An email has been sent to you with this information.' d='Modules.Checkpayment.Shop'}</p>
<p><strong>{l s='Your order will be sent as soon as we receive your payment.' d='Modules.Checkpayment.Shop'}</strong></p>

<p>{l s='For any questions or for further information, please contact our' d='Modules.Checkpayment.Shop'}
	<a href="{$link->getPageLink('contact', true)|escape:'html'}">{l s='customer service department.' d='Modules.Checkpayment.Shop'}</a>.
</p>
