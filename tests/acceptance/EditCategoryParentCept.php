<?php 
$I = new AcceptanceTester($scenario);

$I->am('Site Administrator');

$I->wantTo('Edit a Category\'s Parent Category');

$I->amLoggedAs($I->aSiteAdministrator());

$I->amOnPage('/admin/categories');

$I->click('Schulist');

$I->seeCurrentUrlEquals('/admin/categories/11/edit');

$I->selectOption('parent_id', '4');
$I->fillField('name', 'Malt Liquor');
$I->fillField('description', 'Malt Liquor for you to describe');

$I->click('Update Category');
$I->seeCurrentUrlEquals('/admin/categories/11');

//$I->see('Category: Malt Liquor Updated');
