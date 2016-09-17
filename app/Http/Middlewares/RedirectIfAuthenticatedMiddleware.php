<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Classes\Authentication;
use App\Libs\Concretes\Middleware;

class RedirectIfAuthenticatedMiddleware extends Middleware {
    public function control($next , Authentication $auth ) {
        if($auth->alive()){
            _redirect(_route('home'))->flash('error','You are already signed in.');
        }else{
            return $next();
        }
    }
}
