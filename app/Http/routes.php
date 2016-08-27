<?php

use App\Libs\Concretes\Request;
use App\Libs\Concretes\Response;
use App\Models\User;

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
R::ajax('/users', [
    'controller' => function (Request $r, Response $res) {
        $user = User::where('email', $r->getParam('email'))->first()->toArray();
        return $res->withJson($user);
    },
    'token' => false,
]);

R::map('/', ['controller' => 'Site\SiteController', 'name' => 'site', 'middleware' => 'LocaleMiddleware'], [
    'arabic' => [
        'path' => 'ar',
        'name' => 'arabic',
    ],
    'english' => [
        'name' => 'english',
    ],
]);
R::get('/admin', [
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
