<?php
$I = new AcceptanceTester($scenario);

$I->am('Site Administrator');

$I->wantTo('Edit a Category');

$I->amLoggedAs($I->aSiteAdministrator());

$I->amOnPage('/admin/categories');

$category = \App\Repositories\Category::get()->toArray();

$I->click($category[0]['name']);

$I->seeCurrentUrlEquals('/admin/categories/1/edit');

$category = \App\Repositories\Category::get()->toArray();

$I->selectOption('parent_id', $category[2]['id']);

$I->fillField('name', 'Roobeer');
$I->fillField('description', 'Roober Test Category');

$I->click('Update Category');

$I->seeCurrentUrlEquals('/admin/categories');

$I->see('Category: Roobeer Updated');