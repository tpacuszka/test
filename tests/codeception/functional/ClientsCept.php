<?php 

$I = new FunctionalTester($scenario);
$I->wantTo('login and check if client functionalities work');

$I->amOnPage('/user/login');
$I->submitForm('#login-form', ['login-form[login]' => 'user1',
                                'login-form[password]' => 'user1user1']);
$I->click('#log-in');
$I->wait(2);

$I->amGoingTo('create new client and see if it shows me his page after saving');
$I->wantTo('create new client');
$I->amOnPage('/client/create');
$I->seeInCurrentUrl('create');
$I->submitForm('#w0', ['Client[name]' => 'Client one',
                       'Client[address]' => 'Client one address',
                        'Client[postal_code]' => '33-333']);
$I->wait(2);
$I->dontSeeInCurrentUrl('create');
$I->see('Client one address');

$I->amGoingTo('update client and see if it updates');
$I->click(['link' => 'Update']);
$I->submitForm('#w0', ['Client[name]' => 'Client one update',
                       'Client[address]' => 'Client one address update',
                        'Client[postal_code]' => '33-333']);
$I->wait(2);
$I->dontSeeInCurrentUrl('update');
$I->see('Client one address update');

$I->amGoingTo('delete client and check if it vanishes');
$I->click(['link' => 'Delete']);
$I->acceptPopup();
$I->wait(2);
$I->dontSee('Client one address update');



