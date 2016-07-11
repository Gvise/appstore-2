<?php
return [
    'basepath' => 'appstore/',
    'views' => __ROOT__.'templates/',
    'db' => [
        'host' => 'localhost',
        'table' => 'table1',
        'db' => 'test',
        'user' => 'root',
        'password' => ''
    ],
    'security' => [
        'salt' => 'appstore_salt',
        'enckey' => 'appstore_enckey'
    ]
];
