<?php 
$I = new AcceptanceTester($scenario);
$I->am('Registered User');
$I->wantTo('View my Orders');

$I->amLoggedAs($I->siteUser());

$I->amOnPage('/user/dashboard');

$I->click('View Orders');
$I->seeCurrentUrlEquals('/user/orders');

$I->see('User Orders');
$I->see('Address');

