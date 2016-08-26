<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Classes\User;
use App\Libs\Concretes\Middleware;
use App\Libs\Statics\Hash;
use App\Libs\Statics\Session;
use App\Models\UserModel;
use Request;
use Validation;
use function goBack;
use function path;
use function scanImageToPng;

class AccountUpdateMiddleware extends Middleware{
    public function control($next) { return $next(); }

//    function control($next) {
//        $user_data = Request::getALlParams();
//        Validation::check($user_data, [
//            'fname' => [
//                'required' => true,
//                'unicode_space' => true,
//                'min' => 2,
//                'title' => 'First Name'
//            ],
//            'lname' => [
//                'required' => true,
//                'unicode_space' => true,
//                'min' => 2,
//                'title' => 'Last Name'
//            ],
//            'email' => [
//                'required' => true,
//                'field' => 'email',
//                'title' => 'E-mail'
//            ],
//            'national_id' => [
//                'num' => true,
//                'min' => 14,
//                'max' => 14,
//                'title' => 'National Id'
//            ],
//            'role' => [
//                'equals' => ['client','boss','normal'],
//                'title' => 'Role'
//            ],
//            'newpass' => [
//                'field' => 'nr_password',
//                'min' => 8,
//                'title' => 'New Password'
//            ],
//            'repass' => [
//                'matches' => 'newpass',
//                'title' => 'Re-password'
//            ],       
//        ]);
//
//        $avatar = Request::getFile('avatar');
//        $str = '';
//
//        if (Validation::passed()) {
//            // grapping the current user data
//            $user = User::getData();
//            
//            $pass_f = false;
//            // password check for social
//            if($user->pass == 'freeziana'){
//                $pass_f = true;
//            }else if (!empty (Request::getParam('pass'))) {
//                $pass_f = Hash::match(Request::getParam('pass'), $user->pass);
//            }
//            
//            if ($pass_f) {
//                // if the avatar is set it will be tested
//                $avatarFlag = true;
//                if (!empty($avatar)) {
//                    $avatarFlag = ($avatar->size <= 100000 && scanImageToPng($avatar->tmp_name, path("resources/images/avatars/{$avatar->name}")));
//                    
//                    if (!$avatarFlag) {
//                        $str .= '<li><span class="msg-error" >Error: </span> The Avatar must be an image and less that 10 MB</li>';
//                    }
//                    // if a previous avatar exist, unset it
//                    else if (!empty($user->avatar) && is_file(path('resources/'.$user->avatar))){
//                        @unlink(path('resources/'.$user->avatar));
//                    }
//                }
//
//                //if the email changed it will be tested 
//                $email = Request::getParam('email');
//                $emailFlag = true;
//                if ($user->email != $email && UserModel::findBy([
//                            'email' => $email
//                        ])) {
//                    $emailFlag = false;
//                    $str .= '<li><span class="msg-error" >Error: </span> The Email already Exists choose another one</li>';
//                }
//
//                //if the national_id changed it will be tested 
//                $national_id = Request::getParam('national_id');
//                $national_idFlag = true;
//                if ($user->national_id != $national_id && UserModel::findBy([
//                            'national_id' => $national_id
//                        ])) {
//                    $national_idFlag = false;
//                    $str .= '<li><span class="msg-error" >Error: </span> The National Id already Exists choose another one</li>';
//                }
//
//                // if the avatar test and the email test and the telephone test are passed,
//                //  move to next step
//                if ($avatarFlag && $emailFlag && $national_idFlag) {
//                    return $next();
//                }
//            } else {
//                $str .= '<li><span class="msg-error" >Error: </span> The Password doesn\'t match the current one</li>';
//            }
//        }
//
//        $msgs = Validation::getAllErrorMsgs();
//        if (count($msgs)) {
//            foreach ($msgs as $msg) {
//                $str .= '<li><span class="msg-error" >Error: </span> ' . $msg . '</li>';
//            }
//        }
//        Session::flash('msg', $str);
//        Session::flash('data', $user_data);
//        goBack();
//    }

}
