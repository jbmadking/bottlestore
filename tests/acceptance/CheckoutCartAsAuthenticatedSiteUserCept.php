<?php

use Illuminate\Support\Facades\Auth;
use Step\Acceptance\SiteUser;

$I = new SiteUser($scenario);

$I->am('Site User');
$I->wantTo('Check out my shopping cart as an authenticated Site User');

$I->amLoggedAs($I->siteUser());

$I->amOnPage('/');
$I->click('.add-to-cart');

$I->amOnPage('/checkout/index');
$I->seeCurrentUrlEquals('/checkout/index');

$I->click('Proceed to Checkout');

$userAddresses = \App\Repositories\UserAddress::get()->toArray();
$I->proceedToPayment($userAddresses);