<?php 
$I = new AcceptanceTester($scenario);

$I->wantTo('check if i can login with random password');
$I->amOnPage('/');
$I->click(['link' => 'Sign In']);
$I->seeCurrentUrlEquals('/index-test.php/user/login');
$I->fillField('#login-form-login', 'user1');
$I->fillField('#login-form-password', 'blabla');
$I->click(['id' => 'log-in']);
$I->dontSeeCurrentUrlEquals('/index-test.php');

$I->amOnPage('/');
$I->seeCurrentUrlEquals('/index-test.php/');
$I->wantTo('check if logging in works');
$I->click(['link' => 'Sign In']);
$I->seeCurrentUrlEquals('/index-test.php/user/login');
$I->amOnPage('/user/login');
$I->fillField('#login-form-login', 'user1');
$I->fillField('#login-form-password', 'user1user1');
$I->click(['id' => 'log-in']);
$I->expect('I see homepage again, and new links in menu');
$I->wait(3);
$I->seeCurrentUrlEquals('/index-test.php');

