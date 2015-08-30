<?php 
$I = new AcceptanceTester($scenario);
$I->am('Site Administrator');
$I->wantTo('Edit an Existing Product');

$I->amLoggedAs($I->aSiteAdministrator());
$I->amOnPage('/admin/products');

$I->click('October');
$I->seeCurrentUrlEquals('/admin/products/2/edit');

$I->selectOption('category', '6');
$I->fillField('name', 'Malt Liquors');
$I->fillField('description', 'Malt Liquors for you to describe');
$I->fillField('price', '39.00');
$I->fillField('quantity', '150');
$I->selectOption('status', '1');

$I->attachFile('image', 'roundrect8537796.gif');

$I->click('Update Product');
$I->seeCurrentUrlEquals('/admin/products/2');

//$I->see('New Product: Malt Liquor Created');

