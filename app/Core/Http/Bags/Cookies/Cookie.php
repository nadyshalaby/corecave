<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Http\Bags\Cookies;

use App\Core\Support\Config;
use Hash;

class Cookie {

    protected $is_encrypted;

    public function __construct() {
        $this->is_encrypted = Config::extra('cookie.encrypted_data');
    }

    public function put($name, $value, $expiry, $path = '/', $domain = null, $http_only = true) {

        if ($this->is_encrypted) {
            $value = Hash::encrypt($value);
        }

        if (is_numeric($expiry)) {
            return (setcookie($name, $value, time() + $expiry, $path, $domain, isset($_SERVER['HTTPS']), $http_only)) ? true : false;
        } else {
            return (setcookie($name, $value, strtotime($expiry), $path, $domain, isset($_SERVER['HTTPS']), $http_only)) ? true : false;
        }
    }

    public function pull($name) {
        if ($this->has($name)) {
            $value = $_COOKIE[$name];
            $this->delete($name);
            return ($this->is_encrypted)? Hash::decrypt($value) : $value ;
        }
        return null;
    }

    public function delete($name) {
        return $this->put($name, null, -1);
    }

    public function has($name) {
        return isset($_COOKIE[$name]) && !empty($_COOKIE[$name]);
    }

    public function all($as_arr = false) {
        return $as_arr ? $_COOKIE : _arr2obg($_COOKIE);
    }

    public function get($name) {
        if ($this->has($name)) {
            if ($this->is_encrypted) {
                return Hash::decrypt($_COOKIE[$name]);
            }
            return $_COOKIE[$name];
        }
        
        return null;
    }
    
    public function flush() {
        foreach (array_keys($_COOKIE) as $name) {
            $this->delete($name);
        }
    }

}
