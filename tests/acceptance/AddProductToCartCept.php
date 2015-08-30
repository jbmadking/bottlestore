<?php 
$I = new AcceptanceTester($scenario);

$I->am('Guest Site User');

$I->wantTo('Add a Product to the Shopping Cart');

$I->amOnPage('/');

$I->click('.add-to-cart');

