<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Libs\Statics;

abstract class Cookie {

    public static function put($name, $value, $expiry,$path = '/',$domain = null) {
        if (is_numeric($expiry)) {
            return (setcookie($name, $value, time() + $expiry, $path ,$domain)) ? true : false;
        } else {
            return (setcookie($name, $value, strtotime($expiry), $path,$domain)) ? true : false;
        }
    }

    public static function delete($name) {
        return self::put($name, null, -1);
    }

    public static function has($name) {
        return isset($_COOKIE[$name]);
    }

    public static function all($as_arr = false) {
        return $as_arr ? $_COOKIE : arr2obg($_COOKIE);
    }

    public static function get($name) {
        return (self::has($name)) ? $_COOKIE[$name] : null;
    }

}
