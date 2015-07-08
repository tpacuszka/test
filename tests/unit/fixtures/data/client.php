<?php

use dektrium\user\models\User;

$users = User::find()->indexBy('username')->all();

return [
    'client1' => [
        'name' => 'client1',
        'address' => 'address1',
        'postal_code' => '30-303',
        'created_at' => time(),
        'created_by' => $users['user1']->id,
        'owned_by' => $users['user1']->id,
    ],
    'client2' => [
        'name' => 'client2',
        'address' => 'address2',
        'postal_code' => '30-303',
        'created_at' => time(),
        'created_by' => $users['user1']->id,
        'owned_by' => $users['user1']->id,
    ],
    'client3' => [
        'name' => 'client3',
        'address' => 'address3',
        'postal_code' => '30-303',
        'created_at' => time(),
        'created_by' => $users['user2']->id,
        'owned_by' => $users['user2']->id,
    ]
];