<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Libs\Concretes\Middleware;
use App\Libs\Concretes\Request;

class LocaleMiddleware extends Middleware {

    function control(Request $r, $next) {
        if ($r->getPrevUrl() && $r->isForeign() && $r->hasSession('site')) {
            $prev = route($r->getSession('site'));
            $current = $r->getFullUrl();
            if ($prev === $current) {
                return $next();
            }

            redirect($prev);
        } else {
            return $next();
        }
    }

}
