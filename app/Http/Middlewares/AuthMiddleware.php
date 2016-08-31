<?php
namespace App\Http\Middlewares;

use App\Classes\Authentication;
use App\Libs\Concretes\Middleware;

class AuthMiddleware extends Middleware{
    public function control($next , Authentication $auth ) {
        if($auth->alive()){
            return $next();
        }else{
            redirect(route('auth.signin'))->flash('Warning','Please Login first, and com back.');
        }
    }

}
