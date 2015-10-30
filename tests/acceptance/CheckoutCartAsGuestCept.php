<?php
use Illuminate\Support\Facades\Auth;
use Step\Acceptance\SiteUser;

$I = new SiteUser($scenario);

$I->am('Guest User');
$I->wantTo('Check out my shopping cart as a Guest user');

$I->amOnPage('/');

$I->click('.add-to-cart');
$I->amOnPage('/checkout/index');

$I->seeCurrentUrlEquals('/checkout/index');

$I->click('Proceed to Checkout');

$I->seeCurrentUrlEquals('/checkout/register');

$I->fillInRegistrationForm();


$userAddresses = Auth::user()->addresses()->get()->toArray();

$I->proceedToPayment($userAddresses);


