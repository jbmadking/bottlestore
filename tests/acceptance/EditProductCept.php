<?php

use Step\Acceptance\SiteUser;

$I = new SiteUser($scenario);

$I->am('Site Administrator');
$I->wantTo('Edit an Existing Product');

$I->amLoggedAs($I->aSiteAdministrator());
$I->amOnPage('/admin/products');

$products = $I->products()->toArray();

$productName = $products[5]['name'];
$productId = $products[5]['id'];

$I->click($productName);

$I->seeCurrentUrlEquals('/admin/products/' . $productId . '/edit');

$category = \App\Repositories\Category::get()->toArray();

$I->selectOption('category', $category[1]['id']);
$I->fillField('name', 'Malt Liquors');
$I->fillField('description', 'Malt Liquors for you to describe');
$I->fillField('price', '39.00');
$I->fillField('quantity', '150');
$I->selectOption('status', '1');

$I->attachFile('image', 'roundrect8537796.gif');

$I->click('Update Product');
$I->seeCurrentUrlEquals('/admin/products');

$I->see('Product Updated');

