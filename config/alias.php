<?php

use App\Forgers\Auth;
use App\Forgers\R;
use App\Forgers\Request;
use App\Forgers\Response;
use App\Forgers\Validation;
use App\Forgers\View;
use App\Libs\Statics\Session;
use App\Libs\Statics\Token;
use App\Libs\Statics\Url;

/**
 * Make sure that any of classes using aliases didn't previously imported;
 * */
return [
    'Url' => Url::class,
    'Session' => Session::class,
    'Token' => Token::class,
    'View' => View::class,
    'Auth' => Auth::class,
    'R' => R::class,
    'Router' => R::class,
    'Request' => Request::class,
    'Response' => Response::class,
    'Validation' => Validation::class,
    'Validator' => Validation::class,
];
