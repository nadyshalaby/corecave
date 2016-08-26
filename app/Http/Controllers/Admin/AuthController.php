<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Authentication;
use App\Libs\Concretes\Controller;
use App\Libs\Concretes\Request;
use App\Libs\Concretes\Validation;
use function twig;

class AuthController extends Controller {

    public function index(Validation $v) {
        $v->addError('nady', 'nady', 'bad');
        
        return twig('admin/pages/login.html');
    }
    
    public function signin(Request $r , Authentication $auth) {
        
    }

}
