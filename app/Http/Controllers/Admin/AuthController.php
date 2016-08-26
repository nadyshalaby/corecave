<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Authentication;
use App\Libs\Concretes\Controller;
use App\Libs\Concretes\Request;
use function twig;

class AuthController extends Controller {

    public function index() {
        return twig('admin/pages/login.html');
    }
    
    public function signin(Request $r , Authentication $auth) {
        return $r->getAllParams();
    }

}
