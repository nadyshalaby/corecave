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

class SignupMiddleware extends \App\Libs\Concretes\Middleware{
    
    function control($next) { return $next(); }

//    function control($next) {
//        $user_data = Request::getALlParams();
//        Validation::check($user_data, [
//            'fname' => [
//                'required' => true,
//                'unicode_space' => true,
//                'min' => 2,
//                'title' => 'First name'
//            ],
//            'lname' => [
//                'required' => true,
//                'unicode_space' => true,
//                'min' => 2,
//                'title' => 'Last name'
//            ],
//            'email' => [
//                'required' => true,
//                'field' => 'email',
//                'unique' => 'users',
//                'title' => 'E-mail'
//            ],
//            'pass' => [
//                'required' => true,
//                'field' => 'nr_password',
//                'min' => 8,
//                'title' => 'Password'
//            ],
//            'repass' => [
//                'required' => true,
//                'matches' => 'pass',
//                'title' => 'Re-password'
//            ],
//            'accept' => [
//                'required' => true,
//                'equals' => ['on','checked'],
//                'title' => 'Terms'
//            ],
//            '_role' => [
//                'required' => true,
//                'equals' => ['normal','client','boss'],
//                'title' => 'User role'
//            ],
//        ]);
//        
//        if(Validation::passed()){     
//            return $next();
//        }else{
//            $msgs = Validation::getAllErrorMsgs();
//            $str = '';
//            foreach ($msgs as $msg) {
//                $str .= '<li><span class="msg-error" >Error: </span> '.$msg.'</li>';
//            }
//            Session::flash('msg',$str);
//            goBack();
//        }
//    }

}
