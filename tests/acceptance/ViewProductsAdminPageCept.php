<?php
$I = new AcceptanceTester($scenario);

$I->am('Site Administrator');
$I->wantTo('View all products');

$I->amLoggedAs($I->aSiteAdministrator());

$I->amOnPage('/admin/dashboard');

$I->click('Products');
$I->seeCurrentUrlEquals('/admin/products');

$I->see('Products Administration');
