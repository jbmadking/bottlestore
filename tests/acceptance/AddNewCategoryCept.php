<?php
$I = new AcceptanceTester($scenario);

$I->am('Site Administrator');
$I->wantTo('Add a new Category');

$I->amLoggedAs($I->aSiteAdministrator());

echo 'host' . env('DB_HOST', 'localhost');
echo 'database' . env('DB_DATABASE', 'skills-app');
echo 'username' . env('DB_USERNAME', 'root');
echo 'password' . env('DB_PASSWORD', '');

$I->amOnPage('/admin/categories');

$I->click('Add Category');
$I->seeCurrentUrlEquals('/admin/categories/create');

$I->fillField('name', 'Malt Liquor');
$I->fillField('description', 'Malt Liquor for you to describe');

$I->click('Create Category');
$I->seeCurrentUrlEquals('/admin/categories');

$I->see('New Category: Malt Liquor Created');
