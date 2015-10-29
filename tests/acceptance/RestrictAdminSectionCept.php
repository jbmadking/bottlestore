<?php 
$I = new AcceptanceTester($scenario);
$I->am('Site User');
$I->wantTo('Be restricted from the Administrator\'s section');

$I->amLoggedAs($I->siteUser());

$I->amOnPage('/admin/dashboard');
$I->seeCurrentUrlEquals('/user/dashboard');
$I->see('Restricted Access!!!');

$I->amOnPage('/admin/categories');
$I->seeCurrentUrlEquals('/user/dashboard');
$I->see('Restricted Access!!!');

$I->amOnPage('/admin/products');
$I->seeCurrentUrlEquals('/user/dashboard');
$I->see('Restricted Access!!!');

$I->amOnPage('/admin/administrators');
$I->seeCurrentUrlEquals('/user/dashboard');
$I->see('Restricted Access!!!');


$I->amOnPage('/admin/clients');
$I->seeCurrentUrlEquals('/user/dashboard');
$I->see('Restricted Access!!!');