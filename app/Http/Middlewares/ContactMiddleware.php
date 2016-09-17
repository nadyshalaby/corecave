<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Libs\Concretes\Middleware;
use App\Libs\Concretes\Request;

use function goBack;

class ContactMiddleware extends Middleware {
    
    public function control($next,  Request $r) {
        if(_validate($r->getAllParams(), [
            'contact-name' => [
                'required' => true,
                'title' => 'Your Name'
            ],
            'contact-email' => [
                'required' => true,
                'field' => 'email',
                'title' => 'Your Email'
            ],
            'contact-msg' => [
                'required' => true,
                'max' => 350,
                'title' => 'Your Message'
            ],
        ])->passed()){
            return $next();
        }else{
            _goBack();
        }
    }
}
