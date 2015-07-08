<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('log in and check if popup works');

$I->amOnPage('/user/login');
$I->fillField('#login-form-login', 'user1');
$I->fillField('#login-form-password', 'user1user1');
$I->click(['id' => 'log-in']);

$I->amGoingTo('open related product popup');
$I->expect('to see create product form');
$I->amOnPage('/clients/1');
$I->dontSee('Product Name');
$I->dontSee('Price');
$I->dontSee('Owner');
$I->click(['id' => 'add-product']);
$I->wait(2);
$I->see('Product Name');
$I->see('Price');
$I->see('Owner');