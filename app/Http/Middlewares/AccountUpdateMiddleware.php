<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Libs\Concretes\Middleware;
use App\Libs\Concretes\Request;

class AccountUpdateMiddleware extends Middleware {

    function control($next, Request $r) {

        if (_validate($r->getAllParams(), [
                    'fullname' => [
                        'required' => true,
                        'unicode_space' => true,
                        'min' => 2,
                        'title' => 'Last Name'
                    ],
                    'email' => [
                        'required' => true,
                        'field' => 'email',
                        'title' => 'E-mail'
                    ],
                    'mobile' => [
                        'required' => true,
                        'field' => 'phone',
                        'title' => 'Mobilr'
                    ],
                    'tel' => [
                        'field' => 'phone',
                        'title' => 'Telephone'
                    ],
                    'gender' => [
                        'equals' => ['male', 'female'],
                        'title' => 'E-mail'
                    ],
                    'pass' => [
                        'required' => true,
                        'title' => 'Your Password'
                    ],
                    'newpass' => [
                        'field' => 'nr_password',
                        'min' => 8,
                        'title' => 'New Password'
                    ],
                    'repass' => [
                        'matches' => 'newpass',
                        'title' => 'Re-password'
                    ],
                ])->passed()) {
            return $next();
        } else {
            _goBack();
        }
    }

}
