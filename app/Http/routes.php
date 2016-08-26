<?php

use App\Libs\Concretes\Middleware;
use Illuminate\Support\Facades\Request;

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
R::get('/', [
    'controller' => 'Admin\HomeController@index',
    'name' => 'home',
]);

R::get('/messages', [
    'controller' => 'Admin\MessageController@index',
    'name' => 'messages',
]);

R::get('/orders', [
    'controller' => 'Admin\OrderController@index',
    'name' => 'orders',
]);

R::map('/signin',['controller'=>'Admin\\AuthController','name' => 'auth'], [
    'index' => [
        'name' => 'signin',
    ],
    'signin' => [
        'method' => 'post'
    ]
]);
