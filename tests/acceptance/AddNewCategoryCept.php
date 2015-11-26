<?php


var_dump('app' . env('APP_ENV', ''));
var_dump('host' . env('DB_HOST', 'localhost'));
var_dump('database' . env('DB_DATABASE', 'skills-app'));
var_dump('username' . env('DB_USERNAME', 'root'));
var_dump('password' . env('DB_PASSWORD', ''));
die();

//
//$I = new AcceptanceTester($scenario);
//
//
//

//
//$I->am('Site Administrator');
//$I->wantTo('Add a new Category');
//
//$I->amLoggedAs($I->aSiteAdministrator());
//
//
//$I->amOnPage('/admin/categories');
//
//$I->click('Add Category');
//$I->seeCurrentUrlEquals('/admin/categories/create');
//
//$I->fillField('name', 'Malt Liquor');
//$I->fillField('description', 'Malt Liquor for you to describe');
//
//$I->click('Create Category');
//$I->seeCurrentUrlEquals('/admin/categories');
//
//$I->see('New Category: Malt Liquor Created');
