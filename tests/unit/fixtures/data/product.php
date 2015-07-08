<?php

use dektrium\user\models\User;
use app\models\Client;

$users = User::find()->indexBy('username')->all();
$clients = Client::find()->indexBy('name')->all();

return [
    'product1' => [
        'product_name' => 'product1',
        'price' => 100,
        'created_at' => time(),
        'created_by' => $users['user1']->id,
        'client_id' => $clients['client1']->id,
        'owned_by' => $users['user1']->id,
        'deleted' => 1
    ],
    'product2' => [
        'product_name' => 'product2',
        'price' => 100,
        'created_at' => time(),
        'created_by' => $users['user1']->id,
        'client_id' => $clients['client1']->id,
        'owned_by' => $users['user1']->id,
        'deleted' => 1
    ],
    'product3' => [
        'product_name' => 'product3',
        'price' => 100,
        'created_at' => time(),
        'created_by' => $users['user1']->id,
        'client_id' => $clients['client2']->id,
        'owned_by' => $users['user1']->id,
        'deleted' => 1
    ],
    'product4' => [
        'product_name' => 'product4',
        'price' => 100,
        'created_at' => time(),
        'created_by' => $users['user1']->id,
        'client_id' => $clients['client2']->id,
        'owned_by' => $users['user1']->id
    ],
    'product5' => [
        'product_name' => 'product5',
        'price' => 100,
        'created_at' => time(),
        'created_by' => $users['user2']->id,
        'client_id' => $clients['client3']->id,
        'owned_by' => $users['user2']->id
    ],
    'product6' => [
        'product_name' => 'product6',
        'price' => 100,
        'created_at' => time(),
        'created_by' => $users['user2']->id,
        'client_id' => $clients['client3']->id,
        'owned_by' => $users['user2']->id
    ],
    'product7' => [
        'product_name' => 'product7',
        'price' => 100,
        'created_at' => time(),
        'created_by' => $users['user2']->id,
        'client_id' => $clients['client3']->id,
        'owned_by' => $users['user2']->id
    ],
];