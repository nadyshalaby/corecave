<?php

return [
    'maintenance' => false,
    'debugging' => true,
    'url' => [
        'prefix' => '/zakaa/',
        'error' => [
            '301' => 'error/301.php',
            '401' => 'error/401.php',
            '403' => 'error/403.php',
            '404' => 'error/404.html',
            '500' => 'error/500.php',
        ]
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '',
        'database' => 'zakaa',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'dbfile' => 'freeziana.sql', // filename to be used for auto-importing for the database
        'dbrestore' => false, // flag to determine whether to restore the database or not
        'fetch_mode' => PDO::FETCH_CLASS,
        'prefix' => '',
        'strict' => false,
        'engine' => null,
    ],
    // is a global middleware for every request will be made 
    // (eg. 'app_middleware' => 'App')
    // (eg. 'app_middleware' => ['Middleware1','Middleware2', ... ])
    // (eg. 'app_middleware' => function ($next) { ... return $next(); } )   
    'app_middleware' => ''
    
];
