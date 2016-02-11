<?php

$I = new AcceptanceTester($scenario);
$I->am('Site User');
$I->wantTo('Log in as a Site User');

$I->amOnPage('/');

$I->click('Login');
$I->seeCurrentUrlEquals('/auth/login');

$I->fillField('email', 'jbmatikinye@gmail.com');
$I->fillField('password', 'joshua');
$I->click('login_user');

$I->seeCurrentUrlEquals('/user/dashboard');

$I->see('User Dashboard');
