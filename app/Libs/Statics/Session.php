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

abstract class Session {

    public static function put($key, $value) {
        return $_SESSION[$key] = $value;
    }

    public static function pull($name) {
        if (self::has($name)) {
            $res = $_SESSION[$name];
            self::delete($name);
            return $res;
        }
        return null;
    }

    public static function get($name) {
        if (self::has($name)) {
            return $_SESSION[$name];
        }
        return null;
    }

    public static function has($name) {
        return isset($_SESSION[$name]) && !empty($_SESSION[$name]);
    }

    public static function delete($name) {
        if (self::has($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function all($as_arr = false) {
        return $as_arr ? $_SESSION : arr2obg($_SESSION);
    }

    public static function flash($name, $content = null) {
        if (self::has($name) && empty($content)) {
            $content = self::get($name);
            self::delete($name);
            return $content;
        }
        return self::put($name, $content);
    }

    public static function flush() {
        session_destroy();
    }
}
