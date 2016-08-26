<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Classes\User;
use Request;
use App\Libs\Statics\Session;
use Validation;


class SubClientMiddleware extends \App\Libs\Concretes\Middleware {

    function control($next) {
        $client_data = Request::getALlParams();
        Validation::check($client_data, [
            'name' => [
                'required' => true,
                'unicode_space' => true,
                'min' => 2,
                'title' => 'First Name'
            ],
            'craft' => [
                'required' => true,
                'title' => 'Client Craft'
            ],
            'address' => [
                'required' => true,
                'title' => 'Last Name'
            ],
            'email' => [
                'required' => true,
                'unique' => 'sub_clients',
                'field' => 'email',
                'title' => 'E-mail'
            ],
            'tel' => [
                'required' => true,
                'unique' => 'sub_clients',
                'field' => 'phone',
                'title' => 'Telephone'
            ],
        ]);

        $avatar = Request::getFile('avatar');
        $str = '';

        if (Validation::passed()) {
            // grapping the current user data
            $user = User::getData();

            // if the avatar is set it will be tested
            $avatarFlag = true;
            if (!empty($avatar)) {
                $avatarFlag = ($avatar->size <= 100000 && scanImageToPng($avatar->tmp_name, path("resources/images/avatars/{$avatar->name}")));
                if (!$avatarFlag) {
                    $str .= '<li><span class="msg-error" >Error: </span> The Avatar must be an image and less that 10 MB</li>';
                }
            }
            if ($avatarFlag) {
                return $next();
            }
        }

        $msgs = Validation::getAllErrorMsgs();
        if (count($msgs)) {
            foreach ($msgs as $msg) {
                $str .= '<li><span class="msg-error" >Error: </span> ' . $msg . '</li>';
            }
        }
        Session::flash('msg', $str);
        Session::flash('data', $client_data);
        goBack();
    }

}
