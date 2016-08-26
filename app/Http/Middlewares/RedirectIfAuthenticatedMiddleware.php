<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Classes\Authentication;
use App\Libs\Concretes\Middleware;
use function goBack;

class RedirectIfAuthenticatedMiddleware extends Middleware {
    public function control($next , Authentication $auth ) {
        if($auth->alive()){
            goBack();
        }else{
            return $next();
        }
    }
}
