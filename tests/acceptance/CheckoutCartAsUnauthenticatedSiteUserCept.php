<?php

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

$I->amOnPage('/checkout/register');

$I->fillInRegistrationForm();

$I->proceedToPayment();

//$I->fillInLoginForm();

//$I->seeCurrentUrlEquals('/checkout/login');

