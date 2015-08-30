<?php 
$I = new AcceptanceTester($scenario);
$I->am('Unregistered User');
$I->wantTo('Register as a Site Administrator');

$I->amOnPage('/admin/register');

$I->see('Register');

$I->fillField('name', 'Bradshaw Matikinye');
$I->fillField('email', 'bradshaw@matikinye.co.za');
$I->fillField('password', 'bradshaw');
$I->fillField('password_confirmation', 'bradshaw');

$I->click('register_admin');
$I->seeCurrentUrlEquals('/admin/dashboard');

$I->see('Admin Dashboard');
