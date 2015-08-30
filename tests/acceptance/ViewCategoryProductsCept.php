<?php 
$I = new AcceptanceTester($scenario);
$I->am('Guest Site User');
$I->wantTo('View Products that belong to a specific Category');

$I->amOnPage('/');

$I->click('Abbott');

$I->seeInCurrentUrl('/category/');

$I->see('Category');


