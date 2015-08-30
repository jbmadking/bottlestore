<?php
$I = new AcceptanceTester($scenario);
$I->am('Registered User');
$I->wantTo('View my saved Addresses');

$I->amLoggedAs($I->siteUser());

$I->amOnPage('/user/dashboard');

$I->click('Manage Addresses');
$I->seeCurrentUrlEquals('/user/addresses');

$I->see('Address Management');
$I->see('Add Address');

