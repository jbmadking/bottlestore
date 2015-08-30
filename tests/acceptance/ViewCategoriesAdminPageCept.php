<?php
$I = new AcceptanceTester($scenario);

$I->am('Site Administrator');
$I->wantTo('View all categories');

$I->amLoggedAs($I->aSiteAdministrator());

$I->amOnPage('/admin/dashboard');

$I->click('Categories');
$I->seeCurrentUrlEquals('/admin/categories');

$I->see('Categories Administration');
