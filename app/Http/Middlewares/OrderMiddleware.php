<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Libs\Concretes\Middleware;
use App\Libs\Concretes\Request;

class OrderMiddleware extends Middleware {

    public function control($next, Request $r) {
        if (_validate($r->getAllParams(), [
                    'order-firstname' => [
                        'required' => true,
                        'title' => 'First name',
                    ],
                    'order-lastname' => [
                        'required' => true,
                        'title' => 'Last name',
                    ],
                    'order-social' => [
                        'required' => true,
                        'num' => true,
                        'min' => 14,
                        'max' => 14,
                        'title' => 'Social number',
                    ],
                    'order-plan' => [
                        'required' => true,
                        'title' => 'Plan type',
                    ],
                    'order-mobile' => [
                        'field' => 'phone',
                        'title' => 'Mobile',
                    ],
                    'order-tel' => [
                        'required' => true,
                        'field' => 'phone',
                        'title' => 'Telephone',
                    ],
                    'order-address_1' => [
                        'required' => true,
                        'title' => 'Address 1',
                    ],
                    'order-state' => [
                        'required' => true,
                        'title' => 'State',
                    ],
                    'order-city' => [
                        'required' => true,
                        'title' => 'City',
                    ],
                    'order-email' => [
                        'required' => true,
                        'field' => 'email',
                        'title' => 'Email',
                    ],
                    'order-site' => [
                        'field' => 'url',
                        'title' => 'Your website',
                    ],
                    'order-project' => [
                        'required' => true,
                        'title' => 'Project Name',
                    ],
                    'order-description' => [
                        'required' => true,
                        'title' => 'Description',
                    ],
                ])->passed()) {
            return $next();
        } else {
            _goBack();
        }
    }

}
