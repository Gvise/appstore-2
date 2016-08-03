<?php
return [
    'title' => 'Cunt',
    'basepath' => 'appstore/',
    'views' => __ROOT__.'templates/',
    'db' => [
        'host' => 'localhost',
        'db' => 'appstore',
        'user' => 'root',
        'password' => ''
    ],
    'security' => [
        'salt' => 'appstore_salt',
        'enckey' => 'appstore_enckey'
    ],
    'mindeposit' => 5000,
    'minwithdraw' => 5000,
    'transaction' => [
        'deposit' => 1,
        'withdraw' => 2
    ],

    'iconpath' => 'storage/icons/',
    'sspath' => 'storage/screenshots/',
    'apppath' => 'storage/applications/'
];
