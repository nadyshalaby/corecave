<?php

namespace App\Http\Controllers;

use App\Classes\User;
use App\Libs\Concretes\Controller;
use App\Libs\Statics\Hash;
use Request;
use Response;
use App\Libs\Statics\Session;
use App\Models\FacebookModel;
use App\Models\GoogleModel;
use App\Models\UserModel;
use Google_Client;

class LoginController extends Controller {

    public function index() {
        return twig('login.html');
    }

    public function logout() {
        $u = new User;
        $u->logout();
        redirect(route('home'));
    }

    public function signin() {
        $email = Request::getParam('email');
        $pass = Request::getParam('pass');

        $user = UserModel::first('email = ?', [$email]);

        if ($user && Hash::match($pass, $user->pass)) {
            
            $u = new User($user->remember_me);
            $u ->login();
            redirect(route('user.profile'));
            
        } else {
            Session::flash("msg", '<li><span class="msg-warning">Warning: </span> Ooops!... wrong email or password, let\'s try one more time!</li>');
            goBack();
        }
    }

    public function signup() {
        $f_name = Request::getParam('fname');
        $l_name = Request::getParam('lname');
        $email = Request::getParam('email');
        $pass = Request::getParam('pass');
        $role = Request::getParam('_role');
        $slug = UserModel::getSlug("$f_name $l_name");
        $remember_me = UserModel::getHash();
        $user_columns = [
            'f_name' => $f_name,
            'l_name' => $l_name,
            'email' => $email,
            'pass' => Hash::make($pass),
            'slug' => $slug,
            'national_id' => Hash::unique(30),
            'remember_me' => $remember_me,
            'role' => $role,
            'avatar' => '',
        ];

        if (UserModel::insert($user_columns)) {
            $u = new User($remember_me);
            $u->login();

            redirect(route('user.profile'));
        } else {
            // return UserModel::getError();          
            Response::error(401);
        }
    }

    public function google() {
        $client = new Google_Client;
        $auth = new GoogleModel($client);
        if ($auth->updateUserInformation()) {
            $u = new User($auth->getUserRememberMe());
            $u->login();

            redirect(route('user.profile'));
            return;
        }
        Response::error(401);
    }

    public function facebook() {
        $fb = new FacebookModel();
        $fb->setLoginHelper();
        if ($fb->updateUserInformation()) {
            $u = new User($fb->getUserRememberMe());
            $u->login();

            redirect(route('user.profile'));
            return;
        }
        Response::error(401);
    }

}
