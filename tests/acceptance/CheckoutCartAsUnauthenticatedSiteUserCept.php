<?php

use Illuminate\Support\Facades\Auth;
use Step\Acceptance\SiteUser;

$I = new SiteUser($scenario);

$I->am('Site User');
$I->wantTo('Check my shopping cart as an unauthenticated Site User');

$I->amOnPage('/');
$I->click('.add-to-cart');

$I->amOnPage('/checkout/index');
$I->seeCurrentUrlEquals('/checkout/index');

$I->click('Proceed to Checkout');
$I->seeCurrentUrlEquals('/checkout/register');

$I->click('Log Me In');
$I->seeCurrentUrlEquals('/checkout/login');

$I->fillInLoginForm();

$I->proceedToPayment($I->addresses());