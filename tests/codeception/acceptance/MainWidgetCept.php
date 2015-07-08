<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('check if widgets cant be seen by guests');
$I->amOnPage("/");
$I->dontSee('Newest products');
$I->dontSee('Newest clients');

$I->wantTo('check if widgets are loading');
$I->amOnPage('/user/login');
$I->fillField('#login-form-login', 'user1');
$I->fillField('#login-form-password', 'user1user1');
$I->click(['id' => 'log-in']);
$I->amOnPage("/");
$I->see('Newest products');
$I->see('Newest clients');