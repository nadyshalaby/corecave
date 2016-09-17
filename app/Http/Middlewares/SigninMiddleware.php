<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Libs\Concretes\Middleware;
use App\Libs\Concretes\Request;

class SigninMiddleware extends Middleware{
    

    function control(Request $r , $next) {
        if(_validate($r->getAllParams(), [
            'email' => [
                'required' => true,
                'title' => 'Your Email'
            ],
            'password' => [
                'required' => true,
                'title' => 'Your Password'
            ],
        ])->passed()){     
            return $next();
        }else{
            _goBack();
        }
    }

}
