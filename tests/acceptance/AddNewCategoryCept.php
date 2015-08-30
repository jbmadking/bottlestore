<?php
$I = new AcceptanceTester($scenario);

$I->am('Site Administrator');
$I->wantTo('Add a new Category');

$I->amLoggedAs($I->aSiteAdministrator());

$I->amOnPage('/admin/categories');

$I->click('Add Category');
$I->seeCurrentUrlEquals('/admin/categories/create');

$I->selectOption('parent_id', '7');

$I->fillField('name', 'Malt Liquor');
$I->fillField('description', 'Malt Liquor for you to describe');

$I->click('Create Category');
$I->seeCurrentUrlEquals('/admin/categories');

$I->see('New Category: Malt Liquor Created');
