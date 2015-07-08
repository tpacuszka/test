<?php 

$I = new FunctionalTester($scenario);
$I->wantTo('login and check if product functionalities work');

$I->amOnPage('/user/login');
$I->submitForm('#login-form', ['login-form[login]' => 'user1',
                                'login-form[password]' => 'user1user1']);
$I->click('#log-in');
$I->wait(2);

$I->amGoingTo('create new product and see if it shows me its page after saving');
$I->amOnPage('/product/create');
$I->seeInCurrentUrl('create');
/*
$I->fillField('Product[product_name]', 'Product test one');
$option = $I->grabTextFrom('#product-owned_by option:nth-child(1)');
$I->selectOption('#product-owned_by', $option);
$I->fillField('Product[price]', '199');
$I->fillField('#product-client_id', 1);
$I->click();
$I->submitForm('#w0', ['Product[product_name]' => 'Product test one',
                       'Product[price]' => '199',
                        'Product[client_id]' => 1]);
$I->wait(2);
$I->dontSeeInCurrentUrl('create');
$I->see('Product test one');
*/

$I->amOnPage('/products/5');
$I->amGoingTo('update product and see if it updates');
$I->click(['link' => 'Update']);
$I->submitForm('#w0', ['Product[product_name]' => 'Product test update one',
                       'Product[price]' => '1999']);
$I->wait(2);
$I->dontSeeInCurrentUrl('update');
$I->see('1999');

$I->amGoingTo('delete product and check if it vanishes');
$I->click(['link' => 'Delete']);
$I->acceptPopup();
$I->wait(2);
$I->dontSee('Product one address update');

