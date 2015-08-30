<?php
use Step\Acceptance\SiteUser;

$I = new SiteUser($scenario);

$I->am('Unregistered User');
$I->wantTo('Check out cart as a Guest user');

$I->amOnPage('/');

$I->click('.add-to-cart');
$I->amOnPage('/checkout/index');

$I->seeCurrentUrlEquals('/checkout/index');

$I->click('Proceed to Checkout');

$I->seeCurrentUrlEquals('/checkout/register');

$I->fillInRegistrationForm();

$I->seeCurrentUrlEquals('/checkout/address');

$I->fillInBillingAddress();
$I->fillInShippingAddress();

$I->click('Add Billing Address');

$I->seeCurrentUrlEquals('/checkout/address');

$userAddresses = Auth::user()->addresses()->get()->toArray();

$I->selectOption('billing', $userAddresses[0]['id']);
$I->selectOption('shipping', $userAddresses[1]['id']);

$I->click('Proceed to Payment');

$I->seeCurrentUrlEquals('/checkout/payment');



