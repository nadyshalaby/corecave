<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Support;

use Hash;
use Session;

class Token {

    public function csrf() {
        return Session::get('_token');
    }

    public function input() {
        return '<input type="hidden" name="_token" value="' . $this->csrf() . '"/>';
    }

    public function put() {
        return '<input type="hidden" name="_token" value="' . $this->csrf() . '"/>'
                . '<input type="hidden" name="_method" value="PUT"/>';
    }
    public function head() {
        return '<input type="hidden" name="_token" value="' . $this->csrf() . '"/>'
                . '<input type="hidden" name="_method" value="HEAD"/>';
    }
    public function options() {
        return '<input type="hidden" name="_token" value="' . $this->csrf() . '"/>'
                . '<input type="hidden" name="_method" value="OPTIONS"/>';
    }

    public function delete() {
        return '<input type="hidden" name="_token" value="' . $this->csrf() . '"/>'
                . '<input type="hidden" name="_method" value="DELETE"/>';
    }

    public function match($token) {
        $csrf_token = '_token';

        if (!Session::has($csrf_token)) {
            Session::put('_token',Hash::random(128));
        }

        return (strcmp($token, Session::get($csrf_token)) == 0);
    }

}
