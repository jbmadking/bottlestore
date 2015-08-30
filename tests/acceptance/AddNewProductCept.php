<?php
$I = new AcceptanceTester($scenario);

$I->am('Site Administrator');
$I->wantTo('Add a new Product');

$I->amLoggedAs($I->aSiteAdministrator());
$I->amOnPage('/admin/products');

$I->click('Add Product');
$I->seeCurrentUrlEquals('/admin/products/create');

$I->selectOption('category', '6');
$I->fillField('name', 'Malt Liquor');
$I->fillField('description', 'Malt Liquor for you to describe');
$I->fillField('price', '34.00');
$I->fillField('quantity', '150');
$I->selectOption('status', '1');

$I->attachFile('image', 'roundrect8537796.gif');

$I->click('Create Product');
$I->seeCurrentUrlEquals('/admin/products');

$I->see('New Product: Malt Liquor Created');
