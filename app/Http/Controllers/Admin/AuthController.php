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
    
    public function signin(Request $r , Authentication $auth) {
        return 'Signed In...';
    }

}
