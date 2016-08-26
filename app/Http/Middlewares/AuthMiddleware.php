<?php
namespace App\Http\Middlewares;

use App\Classes\Authentication;
use App\Classes\User;
use App\Libs\Concretes\Middleware;
use App\Libs\Statics\Session;
use App\Libs\Statics\Url;
use function goBack;

class AuthMiddleware extends Middleware{
    public function control($next , Authentication $auth ) {
        if($auth->alive()){
            goBack();
        }else{
            return $next();
        }
    }

}
