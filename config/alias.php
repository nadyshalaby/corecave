<?php

use App\Core\Http\Bags\DI\Container;
use App\Core\Support\Url;
use App\Forgers\Auth;
use App\Forgers\Cookie;
use App\Forgers\Hash;
use App\Forgers\R;
use App\Forgers\Request;
use App\Forgers\Response;
use App\Forgers\Session;
use App\Forgers\Token;
use App\Forgers\Twig;
use App\Forgers\Validation;
use App\Forgers\View;

/**
 * Make sure that any of classes using aliases didn't previously imported;
 * */
return [
    'Url' => Url::class,
    'Session' => Session::class,
    'Cookie' => Cookie::class,
    'Token' => Token::class,
    'View' => View::class,
    'Hash' => Hash::class,
    'Twig' => Twig::class,
    'Auth' => Auth::class,
    'Container' => Container::class,
    'R' => R::class,
    'Router' => R::class,
    'Request' => Request::class,
    'Response' => Response::class,
    'Validation' => Validation::class,
    'Validator' => Validation::class,
];
