<?php
namespace App\Http\Middlewares;

use App\Classes\Authentication;
use App\Libs\Concretes\Middleware;
use function goBack;

class AuthMiddleware extends Middleware{
    public function control($next , Authentication $auth ) {
        if($auth->alive()){
            return $next();
        }else{
            goBack();
        }
    }

}
