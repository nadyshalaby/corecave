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

use Request;
use App\Core\Http\Routing\Router;

abstract class Url {

    public static function app() {
        return Request::getBaseUrl() . Config::app('url.prefix');
    }

    public static function css($file) {
        return self::app() . "public/css/$file.css";
    }

    public static function translate($url) {
        $chunks = _multiexplode(['.', '/', '>', '|'], $url);
        $url = implode('/', $chunks);
        return self::app() . "$url";
    }

    public static function img($file) {
        return self::app() . "public/images/$file";
    }

    public static function js($file) {
        return self::app() . "public/js/$file.js";
    }

    public static function pub($file) {
        return self::app() . "public/$file";
    }

    public static function res($file) {
        return self::app() . "resources/$file";
    }

    public static function route($name, $params = []) {
        return self::app() . trim(Router::getUrl($name, $params), '/');
    }

    public static function action($controller, $params = []) {
        return self::app() . trim(Router::getAction($controller, $params), '/');
    }

}
