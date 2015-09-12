<?php 
$I = new AcceptanceTester($scenario);
$I->am('Site Administrator');
$I->wantTo('Edit an Existing Product');

$I->amLoggedAs($I->aSiteAdministrator());
$I->amOnPage('/admin/products');

$I->click('Carling Black Label 6 Pack');
$I->seeCurrentUrlEquals('/admin/products/44/edit');

$category = \App\Repositories\Category::get()->toArray();

$I->selectOption('category', $category[1]['id']);
$I->fillField('name', 'Malt Liquors');
$I->fillField('description', 'Malt Liquors for you to describe');
$I->fillField('price', '39.00');
$I->fillField('quantity', '150');
$I->selectOption('status', '1');

$I->attachFile('image', 'roundrect8537796.gif');

$I->click('Update Product');
$I->seeCurrentUrlEquals('/admin/products/44');

//$I->see('New Product: Malt Liquor Created');

