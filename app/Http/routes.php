<?php

/**
 * For Routing you can use: 
 * -----------------------
 * 1) $route [ Instance ]
 * 2) Router [ Forger ]
 * 3) R [ Short-Hand Forger ]
 * 
 * EXAMPLE:-
 * - $route->get(...);
 * - Router::get(...);
 * - R::get(...);
 */
R::map('/', ['controller' => 'Site\\SiteController', 'name' => 'site', 'middleware' => 'LocaleMiddleware'], [
    'arabic' => [
        'path' => 'ar',
        'name' => 'arabic',
    ],
    'english' => [
        'name' => 'english',
    ],
]);

R::map('/', 'Site\\SiteController', [
    'contact' => [
        'method' => 'post',
        'path' => 'contact',
        'middleware' => 'ContactMiddleware',
        'name' => 'contact',
    ],
    'order' => [
        'method' => 'post',
        'path' => 'order',
        'middleware' => 'OrderMiddleware',
    ]
]);

R::get('/admin', [
    'controller' => 'Admin\\HomeController@index',
    'middleware' => 'AuthMiddleware',
    'name' => 'home',
]);
R::get('/download/:file', [
    'controller' => 'Admin\\HomeController@download',
    'middleware' => 'AuthMiddleware',
]);

R::map('orders/', 'Admin\\OrderController', [
    'index' => [
        'middleware' => 'AuthMiddleware',
        'name' => 'orders',
    ],
    'view' => [
        'path' => 'view/:id',
        'method' => 'ajax|post',
    ],
    'filter' => [
        'path' => 'filter/:filter',
        'method' => 'ajax|post',
    ],
    'action' => [
        'path' => 'action/:action',
        'method' => 'ajax|post',
    ],
    'search' => [
        'path' => 'search',
        'method' => 'ajax|post',
    ],
]);
R::map('messages/', 'Admin\\MessageController', [
    'index' => [
        'middleware' => 'AuthMiddleware',
        'name' => 'messages',
    ],
    'view' => [
        'path' => 'view/:id',
        'method' => 'ajax|post',
    ],
    'filter' => [
        'path' => 'filter/:filter',
        'method' => 'ajax|post',
    ],
    'action' => [
        'path' => 'action/:action',
        'method' => 'ajax|post',
    ],
    'search' => [
        'path' => 'search',
        'method' => 'ajax|post',
    ],
]);
R::map('profile/', 'Admin\\ProfileController', [
    'index' => [
        'middleware' => 'AuthMiddleware',
        'name' => 'profile',
    ],
    'logout' => [
        'path' => 'signout',
        'name' => 'logout',
    ],
    'update' => [
        'path' => 'update',
        'middleware' => 'AccountUpdateMiddleware',
        'method' => 'put',
        'name' => 'update',
    ]
]);

R::map('/signin', [
    'controller' => 'Admin\\AuthController',
    'name' => 'auth',
    'middleware' => 'RedirectIfAuthenticatedMiddleware'
        ], [
    'index' => [
        'name' => 'signin',
    ],
    'signin' => [
        'method' => 'post',
        'middleware' => 'SigninMiddleware'
    ]
]);
