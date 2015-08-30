<?php 
$I = new AcceptanceTester($scenario);
$I->am('Registered Site User');
$I->wantTo('Add an Address to my Profile');

$I->amLoggedAs($I->siteUser());

$I->amOnPage('/user/addresses');

$I->click('Add Address');
$I->seeCurrentUrlEquals('/user/addresses/add');

$I->fillField('street_number', '36');
$I->fillField('street_name', 'McGhie Avenue');
$I->fillField('suburb', 'Rhodene');
$I->fillField('city', 'Masvingo');
$I->fillField('province', 'Masvingo');
$I->fillField('postal_code', '9999');

$I->click('Add Address');
$I->seeCurrentUrlEquals('/user/addresses');

$I->see('New Address Saved');



