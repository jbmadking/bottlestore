<?php

use Step\Acceptance\SiteUser;

$I = new SiteUser($scenario);

$I->am('Registered Site User');
$I->wantTo('Check out cart as an authenticated Site User');

$I->amLoggedAs($I->siteUser());

$I->amOnPage('/');
$I->click('.add-to-cart');

$I->amOnPage('/checkout/index');
$I->seeCurrentUrlEquals('/checkout/index');

$I->click('Proceed to Checkout');

$I->seeCurrentUrlEquals('/checkout/addresses');

$I->fillInBillingAddress();
$I->fillInShippingAddress();

$I->click('Add Billing Address');

$I->seeCurrentUrlEquals('/checkout/addresses/save');

$userAddresses = Auth::user()->addresses()->get()->toArray();

$I->selectOption('billing', $userAddresses[0]['id']);
$I->selectOption('shipping', $userAddresses[1]['id']);

$I->click('Proceed to Payment');

$I->seeCurrentUrlEquals('/checkout/payment');