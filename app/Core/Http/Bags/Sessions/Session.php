<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Http\Bags\Sessions;

use App\Core\Support\Config;
use Hash;

/**
 * Session class that encapsulate the $_SESSION Super global
 * this class provide easy functions to deal with the basic operations of 
 * using sessions.
 * 
 * it also deal with the sessions in encrypted form if and only if the <pre>encryped_data</pre>
 * flag setted to true in the configuration file.
 * 
 * @author nady shalaby <nady80878@gmail.com>
 */
class Session {

    protected $is_encrypted;

    public function __construct() {
        $this->is_encrypted = Config::extra('session.encrypted_data');
    }

    public function put($key, $value) {

        if ($this->is_encrypted) {
            $value = Hash::encrypt($value);
        }

        $_SESSION[$key] = $value;
        
        return ($this->is_encrypted)? Hash::decrypt($value) : $value ;
    }

    public function pull($name) {
        if ($this->has($name)) {
            $value = $_SESSION[$name];
            $this->delete($name);
            return ($this->is_encrypted)? Hash::decrypt($value) : $value ;
        }
        return null;
    }

    public function get($name) {
        if ($this->has($name)) {
            if ($this->is_encrypted) {
                return Hash::decrypt($_SESSION[$name]);
            }
            return $_SESSION[$name];
        }

        return null;
    }

    public function has($name) {
        return isset($_SESSION[$name]) && !empty($_SESSION[$name]);
    }

    public function delete($name) {
        if ($this->has($name)) {
            unset($_SESSION[$name]);
        }
    }

    public function all($as_arr = false) {
        return $as_arr ? $_SESSION : _arr2obg($_SESSION);
    }

    public function flash($name, $content = null) {
        if ($this->has($name) && empty($content)) {
            $content = $this->get($name);
            $this->delete($name);
            return $content;
        }
        return $this->put($name, $content);
    }

    public function flush() {
        session_destroy();
    }

}
