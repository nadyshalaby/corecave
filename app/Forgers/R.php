<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Forgers;

use App\Libs\Concretes\Forger;

class R extends Forger{
    
    public static function getForgedClass() {
        return 'App\Libs\Concretes\Router';
    }
}
