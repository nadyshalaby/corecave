<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Authentication;
use App\Libs\Concretes\Controller;
use App\Libs\Concretes\Request;
use App\Libs\Concretes\Validation;

class AuthController extends Controller {

    public function index(Validation $v) {
        return twig('admin/pages/login.html');
    }

    public function signin(Request $r, Authentication $auth) {
        if ($auth->login($r->getParam('email'), $r->getParam('password'), $r->hasParam('remember'))) {
            redirect(route('home'));
        } else {
            goBack()->flash('error', 'Invalid credentials, try again...');
        }
    }

}
