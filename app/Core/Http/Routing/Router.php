<?php



/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Http\Routing;

use App\Core\Exceptions\BadRequestException;
use App\Core\Exceptions\TokenMissMatchException;
use App\Core\Http\Routing\Middleware;
use App\Core\Http\Routing\Route;
use App\Core\Support\Config;
use App\Core\Support\Resolver;
use Token;
use Request;
use Response;

class Router {

    private $url = '';
    private $routes = [];
    private $namedRoutes = [];
    private $actionRoutes = [];
    private $resolver;
    private static $route;

    public function __construct() {
        $this->resolver = new Resolver;
        $this->url = trim(Request::getParam('url'), '/');
        if (empty($this->url)) {
            $this->url = '/';
        }
        self::$route = $this;
    }

    public function get($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = false) {
        return $this->addRoute($path, $callableOrOptions, $name, 'GET', $with, $middleware, $token);
    }

    public function post($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, 'POST', $with, $middleware, $token);
    }

    public function put($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, 'PUT', $with, $middleware, $token);
    }

    public function ajax($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, "AJAX|POST", $with, $middleware, $token);
    }

    public function ajaxPOST($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, "AJAX|POST", $with, $middleware, $token);
    }

    public function ajaxGET($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, "AJAX|GET", $with, $middleware, $token);
    }

    public function ajaxPUT($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, "AJAX|PUT", $with, $middleware, $token);
    }

    public function ajaxHEAD($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, "AJAX|HEAD", $with, $middleware, $token);
    }

    public function ajaxDELETE($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, "AJAX|DELETE", $with, $middleware, $token);
    }

    public function ajaxOPTIONS($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, "AJAX|OPTIONS", $with, $middleware, $token);
    }

    public function delete($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, 'DELETE', $with, $middleware, $token);
    }

    public function head($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, 'HEAD', $with, $middleware, $token);
    }

    public function options($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, 'OPTIONS', $with, $middleware, $token);
    }

    public function map($map_path = '', $options = [], $routes = []) {
        $argCount = func_num_args();

        switch ($argCount) {
            case 1:
                $this->_map(null, null, $map_path);
                break;
            case 2:
                if (is_array($map_path)) {
                    $this->_map(null, $map_path, $options);
                } else {
                    if (class_exists($map_path)) {
                        $this->_map(null, $map_path, $options);
                    } else if (class_exists("App\\Http\\Controllers\\{$map_path}")) {
                        $this->_map(null, "App\\Http\\Controllers\\{$map_path}", $options);
                    } else if (class_exists("App\\Http\\Controllers\\{$map_path}Controller")) {
                        $this->_map(null, "App\\Http\\Controllers\\{$map_path}Controller", $options);
                    } else {
                        $this->_map($map_path, null, $options);
                    }
                }
                break;
            case 3:
                $this->_map($map_path, $options, $routes);
                break;
        }
    }

    private function _map($map_path, $options, $routes) {

        $map_controller = is_string($options) ? $options : '';
        $map_middlewares = [];
        $map_methods = [];
        $map_with = [];
        $map_token = true;
        $map_name = '';

        if (is_array($options)) {
            $map_controller = _arrayFetch($options, 'controller', $map_controller);
            $map_methods = _arrayFetch($options, 'method', $map_methods);
            $map_middlewares = _arrayFetch($options, 'middleware', $map_middlewares);
            $map_with = _arrayFetch($options, 'with', $map_with);
            $map_token = _arrayFetch($options, 'token', $map_token);
            $map_path = _arrayFetch($options, 'path', $map_path);
            $map_name = _arrayFetch($options, 'name', $map_name);
        }

        foreach ($routes as $func => $route) {
            $path = $map_path;
            $controller = $map_controller;
            $with = $map_with;
            $method = $map_methods;
            $middleware = $map_middlewares;
            $name = '';
            $token = $map_token;

            if (is_string($route)) {
                $path .= $route;
            } else if (is_array($route)) {
                $controller = _arrayFetch($route, 'controller');
                $path .= _arrayFetch($route, 'path');
                $with = _arrayMergeMixed($map_with, _arrayFetch($route, 'with'));
                $method = _arrayMergeMixed($map_methods, _arrayFetch($route, 'method', 'GET'));
                $middleware = _arrayMergeMixed($map_middlewares, _arrayFetch($route, 'middleware'));
                $name = _arrayFetch($route, 'name');
                $token = _arrayFetch($route, 'token', $map_token);

                if (is_string($controller) || is_null($controller)) {
                    $controller = implode('', [$map_controller, $controller]) . "@" . str_replace("$name.", '', $func);
                }

                if (!empty($name) && !empty($map_name)) {
                    $name = implode('.', [$map_name, $name]);
                }
            }

            $info = [
                'controller' => $controller,
                'with' => $with,
                'name' => $name,
                'middleware' => $middleware,
            ];

            if (isset($route['token'])) {
                $info['token'] = $token;
            }

            $this->match($method, $path, $info);
        }
    }

    public function match(array $methods, $path, $callableOrOptions) {
        foreach ($methods as $value) {
            switch (strtoupper($value)) {
                case 'GET':
                    $this->get($path, $callableOrOptions);
                    break;
                case 'POST':
                    $this->post($path, $callableOrOptions);
                    break;
                case 'PUT':
                    $this->put($path, $callableOrOptions);
                    break;
                case 'DELETE':
                    $this->delete($path, $callableOrOptions);
                    break;
                case 'HEAD':
                    $this->head($path, $callableOrOptions);
                    break;
                case 'OPTIONS':
                    $this->options($path, $callableOrOptions);
                    break;
                case 'AJAX|POST':
                    $this->ajax($path, $callableOrOptions);
                    break;
                case 'AJAX|GET':
                    $this->ajaxGET($path, $callableOrOptions);
                    break;
                case 'AJAX|HEAD':
                    $this->ajaxHEAD($path, $callableOrOptions);
                    break;
                case 'AJAX|DELETE':
                    $this->ajaxDELETE($path, $callableOrOptions);
                    break;
                case 'AJAX|OPTIONS':
                    $this->ajaxOPTIONS($path, $callableOrOptions);
                    break;
                case 'AJAX|PUT':
                    $this->ajaxPUT($path, $callableOrOptions);
                    break;
            }
        }
    }

    public function any($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        $this->get($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->ajax($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->ajaxPUT($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->ajaxDELETE($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->ajaxGET($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->ajaxHEAD($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->ajaxOPTIONS($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->post($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->put($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->delete($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->head($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->options($path, $callableOrOptions, $name, $with, $middleware, $token);
    }

    private function addRoute($path, $callableOrOptions, $name, $method, $with, $middleware, $token) {

        if (is_array($callableOrOptions)) {
            foreach ($callableOrOptions as $key => $value) {
                switch (strtolower($key)) {
                    case 'with':
                        $with = $value;
                        break;
                    case 'name':
                        $name = $value;
                        break;
                    case 'controller':
                        $callableOrOptions = $value;
                        break;
                    case 'middleware':
                        $middleware = $value;
                        break;
                    case 'token':
                        $token = $value;
                        break;
                }
            }
        }

        $this->basic($path, $callableOrOptions, $name, $method, $middleware, $token, $with);
        $this->optional($path, $callableOrOptions, $name, $method, $middleware, $token, $with);
    }

    private function optional($path, $callableOrOptions, $name, $method, $middleware, $token, $with) {
        $count = 1;
        while (strstr($path, '?')) {
            $path = _strReplaceFirst('?', ':', $path);
            $newPath = preg_replace('#\?([\w]+[/]?)#', '', $path);
            $route = new Route($newPath, $callableOrOptions, $middleware, $token);
            $this->routes[$method][] = $route;
            if ($name) {
                $this->namedRoutes[$name . '-' . ($count++)] = $newPath;
            }
            if (is_array($with)) {
                foreach ($with as $param => $pattern) {
                    $route->with($param, $pattern);
                }
            }
        }
    }

    private function basic($path, $callableOrOptions, $name, $method, $middleware, $token, $with) {
        $path = preg_replace('#\?([\w]+[/]?)#', '', $path);
        $route = new Route($path, $callableOrOptions, $middleware, $token);
        $this->routes[$method][] = $route;
        if ($name) {
            $this->namedRoutes[$name] = $path;
        }
        
        if(is_string($callableOrOptions)){
             $this->actionRoutes[$callableOrOptions] = $path;
        }
        
        if (is_array($with)) {
            foreach ($with as $param => $pattern) {
                $route->with($param, $pattern);
            }
        }
    }

    public static function getUrl($name, $params = []) {
        if (isset(self::$route->namedRoutes[$name])) {
            $path = self::$route->namedRoutes[$name];
            foreach ($params as $k => $v) {
                $path = str_replace(":$k", $v, $path);
            }
            return $path;
        }
        return '';
    }
    
    public static function getAction($controller, $params = []) {
        //dd(self::$route->actionRoutes);
        if (isset(self::$route->actionRoutes[$controller])) {
            $path = self::$route->actionRoutes[$controller];
            foreach ($params as $k => $v) {
                $path = str_replace(":$k", $v, $path);
            }
            return $path;
        }
        return '';
    }

    public function __destruct() {

        if (Config::app('maintenance') === true) {
            Response::withError(503, "Be Right Back Soon!");
        }

        $app_middleware = Config::app('app_middleware');

        if (empty($app_middleware)) {
            return $this->run();
        }

        if (!is_array($app_middleware)) {
            $app_middleware = [$app_middleware];
        }

        return Middleware::chain($app_middleware, [$this, 'run']);
    }

    public function run() {
        try {
            if (isset($_SERVER['REQUEST_METHOD'])) {

                $request_method = $_SERVER['REQUEST_METHOD'];
                $inputFlag = Request::hasParam('_token');

                // check the request method if PUT, DELETE or POST 
                if ($request_method == 'POST') {
                    if (isset($_POST['_method'])) {
                        $request_method = $_POST['_method'];
                    }
                }

                $request_method = (Request::isAjax()) ? "AJAX|$request_method" : $request_method;

                // check if the request method not supported
                if (!in_array($request_method, ['POST', 'GET', 'PUT', 'DELETE', 'HEAD', 'OPTIONS', 'AJAX|POST', 'AJAX|GET', 'AJAX|HEAD', 'AJAX|PUT', 'AJAX|DELETE', 'AJAX|OPTIONS',])) {
                    throw new BadRequestException('Unauthorized: Access is denied, REQUEST_METHOD not found');
                }

                $res = null;
                // if any routes are set with the request method
                if (isset($this->routes[$request_method])) {
                    $tokenFlag = Token::match(Request::getParam('_token'));
                    foreach ($this->routes[$request_method] as $route) {
                        // find the route that matches the requested url
                        if ($route->equals($this->url)) {
                            // if the token field is set check the token
                            if ($route->token) {
                                if (!$inputFlag || ($inputFlag && !$tokenFlag)) {
                                    throw new TokenMissMatchException('Unauthorized: Access is denied, Token Miss Match!');
                                    die('Token missmatch!');
                                }
                            }

                            // executes the requested route 
                            $res = $route->exec();
                            if (is_string($res)) {
                                // execute terminate script
                                require _path('bootstrap.terminate.php');
                                // print results
                                print $res;
                            } else if (!is_null($res)) {
                                print Response::withJson($res);
                            }
                                
                            exit;
                        }
                    }
                }
                Response::withError(404, 'Page Not Found.');
            } else {
                throw new BadRequestException('Unauthorized: Access is denied, REQUEST_METHOD not found');
            }
        } catch (Exception $exc) {
            die(">>> Message: \"".$exc->getMessage()."\"<br /><br />>>> Line: {$exc->getLine()}" . "<br /><br />>>> File: \"{$exc->getFile()}\"" . " <br /><br />>>> Trace: <pre>{$exc->getTraceAsString()}</pre>");
        }
    }

}


