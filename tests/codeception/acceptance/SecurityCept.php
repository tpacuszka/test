<?php 
$I = new AcceptanceTester($scenario);

$I->wantTo('check if unlogged person can do something else than see records lists');

$I->amGoingTo('create new records');
$I->expect('to fail and see login pages');
$I->amOnPage("/");
$I->click(['link' => "Products"]);
$I->wait(1);
$I->click(['id' => 'create-product']);
$I->seeInCurrentUrl('login');
$I->click(['link' => "Clients"]);
$I->wait(1);
$I->click(['id' => 'create-client']);
$I->seeInCurrentUrl('login');

$I->amGoingTo('open clients and products list');
$I->expect('to see these lists');
$I->click(['link' => "Clients"]);
$I->wait(1);
$I->click(['id' => 'show-clients']);
$I->seeInCurrentUrl('clients');
$I->click(['link' => "Products"]);
$I->wait(1);
$I->click(['id' => 'show-products']);
$I->seeInCurrentUrl('products');

$I->amGoingTo('open client page and update page for client');
$I->expect('to see login page');
$I->amOnPage('/clients/5');
$I->seeInCurrentUrl('login');
$I->amOnPage('/client/update?id=5');
$I->seeInCurrentUrl('login');