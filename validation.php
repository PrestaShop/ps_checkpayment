<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

/**
 * @deprecated 1.5.0 This file is deprecated, use moduleFrontController instead
 */

include(dirname(__FILE__).'/../../config/config.inc.php');
Tools::displayFileAsDeprecated();

include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/ps_checkpayment.php');

$context = Context::getContext();
$cart = $context->cart;
$psCheckpayment = new Ps_Checkpayment();

if ($cart->id_customer == 0 or $cart->id_address_delivery == 0 or $cart->id_address_invoice == 0 or !$psCheckpayment->active) {
    Tools::redirect('index.php?controller=order&step=1');
}

// Check that this payment option is still available in case the customer changed his address just before the end of the checkout process
$authorized = false;
foreach (Module::getPaymentModules() as $module) {
    if ($module['name'] == 'ps_checkpayment') {
        $authorized = true;
        break;
    }
}
if (!$authorized) {
    die($psCheckpayment->trans('This payment method is not available.', array(), 'Modules.Checkpayment.Admin'));
}

$customer = new Customer($cart->id_customer);

if (!Validate::isLoadedObject($customer)) {
    Tools::redirect('index.php?controller=order&step=1');
}

$currency = $context->currency;
$total = (float)$cart->getOrderTotal(true, Cart::BOTH);

$psCheckpayment->validateOrder((int)$cart->id, Configuration::get('PS_OS_CHEQUE'), $total, $psCheckpayment->displayName, null, array(), (int)$currency->id, false, $customer->secure_key);

Tools::redirect('index.php?controller=order-confirmation&id_cart='.(int)($cart->id).'&id_module='.(int)($psCheckpayment->id).'&id_order='.$psCheckpayment->currentOrder.'&key='.$customer->secure_key);
