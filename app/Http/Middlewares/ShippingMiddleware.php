<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use Request;
use App\Libs\Statics\Session;
use Validation;

class ShippingMiddleware extends \App\Libs\Concretes\Middleware {
    
    function control($next) { echo 'shipping'; return $next(); }

//    function control($next) {
//        $shipping_data = Request::getALlParams();
//        Validation::check($shipping_data, [
//            'address_1' => [
//                'required' => true,
//                'title' => 'First Address'
//            ],
//            'city' => [
//                'required' => true,
//                'title' => 'City'
//            ],
//            'country' => [
//                'required' => true,
//                'title' => 'Country'
//            ],
//            'state' => [
//                'required' => true,
//                'title' => 'State'
//            ],
//            'tel' => [
//                'required' => true,
//                'field' => 'phone',
//                'min' => 10,
//                'unique' => 'shipping',
//                'title' => 'Telephone'
//            ],
//            'zip' => [
//                'required' => true,
//                'zip' => 'EG',
//                'title' => 'Postal Code'
//            ],
//        ]);
//
//        if (Validation::passed()) {
//            return $next();
//        }else{
//            //collecting the error messages
//            $msgs = Validation::getAllErrorMsgs();
//            if (count($msgs)) {
//                foreach ($msgs as $msg) {
//                    $str .= '<li><span class="msg-error" >Error: </span> ' . $msg . '</li>';
//                }
//            }
//            Session::flash('msg', $str);
//            Session::flash('data', $shipping_data);
//            goBack();
//        }
//    }
}
