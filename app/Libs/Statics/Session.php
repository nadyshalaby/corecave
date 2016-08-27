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

    public static function pull($key) {
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
        return isset($_SESSION[$name]);
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

    public static function isExpired($ttl = 30) {
        $last = isset($_SESSION['_last_activity']) ? $_SESSION['_last_activity'] : false;
        if ($last !== false && time() - $last > $ttl * 60) {
            return true;
        }
        $_SESSION['_last_activity'] = time();
        return false;
    }

    public static function isFingerprint() {
        $hash = md5(
                $_SERVER['HTTP_USER_AGENT'] .
                (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0'))
        );
        if (isset($_SESSION['_fingerprint'])) {
            return $_SESSION['_fingerprint'] === $hash;
        }
        $_SESSION['_fingerprint'] = $hash;
        return true;
    }

    public static function isValid() {
        return static::isExpired() && static::isFingerprint();
    }

}
