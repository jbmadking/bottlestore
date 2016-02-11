<?php

use Step\Acceptance\SiteUser;

$I = new SiteUser($scenario);

$I->am('Unregistered User');
$I->wantTo('Register as a Site User');

$I->amOnPage('/');

$I->click('Register');
$I->seeCurrentUrlEquals('/register/user');

$I->fillInRegistrationForm();

$I->seeCurrentUrlEquals('/user/dashboard');

$I->see('Lindsay Matikinye');
$I->see('Log Out');
