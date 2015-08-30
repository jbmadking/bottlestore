<?php 
$I = new AcceptanceTester($scenario);
$I->am('Guest Site User');
$I->wantTo('View a Product\'s Details Page');

$I->amOnPage('/');

$I->click('View');

$I->seeInCurrentUrl('/product/details/');

$I->see('Product Description');
$I->see('Checkout');
$I->see('Add To Cart');