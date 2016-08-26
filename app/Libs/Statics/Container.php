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

use App\Libs\Concretes\Resolver;
use Exception;

class Container {

    public static $bindings = [];

    public function __construct(array $bindings = [], $append = false) {
        if (!empty($bindings)) {
            if (!$append) {
                self::unbind();
            }
            self::bindOrOverrideAll($bindings);
        }
    }

    public function __set($name, $binding) {
        self::override($name, $binding);
    }

    public function __get($name) {
        return self::fetch($name);
    }

    public static function bind($name, $binding) {

        if (in_array($name, array_keys(self::$bindings))) {
            throw new Exception("No registered method or object found", 1);
        } else {
            if (!is_string($binding) && is_callable($binding)) {
                $args = (new Resolver)->injectMethod($binding);
                return (self::$bindings[$name] = call_user_func_array($binding, $args));
            } else {
                return (self::$bindings[$name] = $binding);
            }
        }
    }

    public static function bindAll(array $bindings) {
        foreach ($bindings as $name => $binding) {
            self::bind($name, $binding);
        }
    }

    public static function bindOrOverrideAll(array $bindings) {
        foreach ($bindings as $name => $binding) {
            self::override($name, $binding);
        }
    }

    public static function unbind($name = null) {
        if ($name) {
            unset(self::$bindings[$name]);
        } else {
            self::$bindings = [];
        }
    }

    public static function isBinded($name) {
        return isset(self::$bindings[$name]);
    }

    public static function fetch($name) {
        if (self::isBinded($name)) {
            return self::$bindings[$name];
        }
        return null;
    }

    public static function override($name, $binding) {
        if ($name) {
            self::unbind($name);
            return self::bind($name, $binding);
        }
    }

}
