<?php
$I = new AcceptanceTester($scenario);
$I->am('Site Administrator');
$I->wantTo('Log in as a Site Administrator');

$I->amOnPage('/admin/login');
$I->fillField('email', 'joshua@matikinye.com');
$I->fillField('password', 'joshua');
$I->click('login_admin');

$I->seeCurrentUrlEquals('/admin/dashboard');
$I->see('Admin Dashboard');
