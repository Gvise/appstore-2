<?php
return [
    'title' => 'Gavity',
    'basepath' => 'appstore/',
    'views' => __ROOT__.'templates/',
    'db' => [
        'host' => 'localhost',
        'db' => 'test',
        'user' => 'root',
        'password' => ''
    ],
    'security' => [
        'salt' => 'appstore_salt',
        'enckey' => 'appstore_enckey'
    ]
];
