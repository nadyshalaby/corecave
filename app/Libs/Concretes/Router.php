<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Libs\Concretes;

use App\Libs\Exceptions\BadRequestException;
use App\Libs\Exceptions\TokenMissMatchException;
use App\Libs\Statics\Config;
use App\Libs\Statics\Token;
use Exception;
use Request;
use Response;

class Router {

    private $url = '';
    private $routes = [];
    private $namedRoutes = [];
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
        return $this->addRoute($path, $callableOrOptions, $name, 'AJAX', $with, $middleware, $token);
    }

    public function delete($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        return $this->addRoute($path, $callableOrOptions, $name, 'DELETE', $with, $middleware, $token);
    }

    public function map($prefix = '', $options = [], $routes = []) {
        $argCount = func_num_args();

        switch ($argCount) {
            case 1:
                $this->_map(null, null, $prefix);
                break;
            case 2:
                if (is_array($prefix)) {
                    $this->_map(null, $prefix, $options);
                } else {
                    if (class_exists($prefix)) {
                        $this->_map(null, $prefix, $options);
                    } else if (class_exists("App\\Http\\Controllers\\{$prefix}")) {
                        $this->_map(null, "App\\Http\\Controllers\\{$prefix}", $options);
                    } else if (class_exists("App\\Http\\Controllers\\{$prefix}Controller")) {
                        $this->_map(null, "App\\Http\\Controllers\\{$prefix}Controller", $options);
                    } else {
                        $this->_map($prefix, null, $options);
                    }
                }
                break;
            case 3:
                $this->_map($prefix, $options, $routes);
                break;
        }
    }

    private function _map($prefix, $options, $routes) {

        $map_controller = is_string($options) ? $options : '';
        $map_middlewares = [];
        $map_methods = [];
        $map_with = [];
        $map_token = true;
        $map_name = '';

        if (is_array($options)) {
            $map_controller = array_fetch($options, 'controller', $map_controller);
            $map_methods = array_fetch($options, 'method', $map_methods);
            $map_middlewares = array_fetch($options, 'middleware', $map_middlewares);
            $map_with = array_fetch($options, 'with', $map_with);
            $map_token = array_fetch($options, 'token', $map_token);
            $prefix = array_fetch($options, 'prefix', $prefix);
            $map_name = array_fetch($options, 'name', $map_name);
        }

        foreach ($routes as $func => $route) {
            $path = $prefix;
            $controller = $map_controller;
            $with = $map_with;
            $method = $map_methods;
            $middleware = $map_middlewares;
            $name = '';
            $token = $map_token;

            if (is_string($route)) {
                $path .= $route;
            } else if (is_array($route)) {
                $controller = array_fetch($route, 'controller');
                $path .= array_fetch($route, 'path');
                $with = array_merge_mixed($map_with, array_fetch($route, 'with'));
                $method = array_merge_mixed($map_methods, array_fetch($route, 'method', 'GET'));
                $middleware = array_merge_mixed($map_middlewares, array_fetch($route, 'middleware'));
                $name = array_fetch($route, 'name');
                $token = array_fetch($route, 'token', $map_token);

                if (is_string($controller) || is_null($controller)) {
                    $controller = implode('', [$map_controller, $controller]) . "@" . str_replace("$name.", '', $func);
                }

                if (!empty($name)) {
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
                case 'AJAX':
                    $this->ajax($path, $callableOrOptions);
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
            }
        }
    }

    public function any($path, $callableOrOptions, $name = null, $with = [], $middleware = null, $token = true) {
        $this->get($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->ajax($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->post($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->put($path, $callableOrOptions, $name, $with, $middleware, $token);
        $this->delete($path, $callableOrOptions, $name, $with, $middleware, $token);
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
            $path = string_replace_first('?', ':', $path);
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

    public function __destruct() {

        if (Config::app('maintenance') === true) {
            Response::error(503, "Be Right Back Soon!");
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
                $request_method = (Request::isAjax()) ? 'AJAX' : $request_method;
                $inputFlag = Request::hasParam('_token');

                // check the request method if PUT, DELETE or POST 
                if ($request_method == 'POST') {
                    if (isset($_POST['_method'])) {
                        $request_method = $_POST['_method'];
                    }
                }
                // check if the request method not supported
                if (!in_array($request_method, ['POST', 'GET', 'PUT', 'AJAX', 'DELETE'])) {
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
                                echo $res;
                            } else if (!is_null($res)) {
                                dd($res);
                            }
                            return;
                        }
                    }
                }
                Response::error(404);
            } else {
                throw new BadRequestException('Unauthorized: Access is denied, REQUEST_METHOD not found');
            }
        } catch (Exception $exc) {
            die($exc->getMessage() . ' please go <a href="' . Request::getPrevUrl() . '">back.</a>');
        }
    }

}

class Route {

    private $path;
    public $token;
    private $params;
    private $resolver;
    private $paramNames = [];
    private $matches = [];
    private $middleware;

    public function __construct($path, $callableOrOptions, $middleware = null, $token = false) {
        $this->path = $path;
        $this->callable = $callableOrOptions;
        $this->middleware = $middleware;
        $this->token = $token;
        $this->resolver = new Resolver;
    }

    public function equals($url) {
        $this->path = trim(preg_replace_callback('/:([\w]+)/', [$this, 'fetchParams'], $this->path), '/');
        if (empty($this->path)) {
            $this->path = '/';
        }
        if (preg_match("#^{$this->path}$#", $url, $this->matches)) {
            array_shift($this->matches);

            $tmp = [];
            for ($index = 0; $index < count($this->paramNames); $index++) {
                $tmp[$this->paramNames[$index]] = $this->matches[$index];
            }

            $this->matches = $tmp;
            return true;
        } else {
            return false;
        }
    }

    public function exec() {
        if (empty($this->middleware)) {
            return $this->call();
        }

        if (!is_array($this->middleware)) {
            $this->middleware = [$this->middleware];
        }

        return Middleware::chain($this->middleware, [$this, 'call']);
    }

    public function with($param, $pattern) {
        if (isset($this->params[$param])) {
            $this->params[$param] = $pattern;
        }
    }

    public function call() {
        if (!is_array($this->callable) && is_callable($this->callable)) {

            $matches = $this->resolver->injectMethod($this->callable);
            foreach ($matches as $index => $match) {
                if (key_exists($index, $this->matches)) {
                    $matches[$index] = $this->matches[$index];
                }
            }

            return call_user_func_array($this->callable, $matches);
        } else if (!empty($this->callable)) {

            if (is_string($this->callable)) {
                $parts = multiexplode(['@', '>', '.', '#', '-', '/'], $this->callable);
                $class = $parts[0];
                $method = $parts[1];
            } else if (is_array($this->callable)) {
                $class = $this->callable[0];
                $method = $this->callable[1];
            }

            $controller = $class;
            if (!class_exists($class)) {
                $controller = "App\\Http\\Controllers\\{$class}";
                if (!class_exists($controller)) {
                    $controller = "App\\Http\\Controllers\\{$class}Controller";
                }
            }
            $controller = $this->resolver->resolve($controller);

            $matches = $this->resolver->injectMethod($controller, $method);
            foreach ($matches as $index => $match) {
                if (key_exists($index, $this->matches)) {
                    $matches[$index] = $this->matches[$index];
                }
            }
            return call_user_func_array([$controller, $method], $matches);
        }
    }

    private function fetchParams($match) {
        if (isset($this->params[$match[1]])) {
            return $this->params[$match[1]];
        }
        $this->paramNames[] = $match[1];
        return "([^/]+)";
    }

}

class Middleware {

    public static function chain(array $middlewares, callable $core_layer) {
        $middles = static::resolveMiddleWares($middlewares);

        $middle = array_pop($middles);
        $middle['matches']['next'] = $core_layer;

        return static::queueMiddlewares($middles, $middle);
    }

    private static function queueMiddlewares(&$middles, &$middle) {
        if (empty($middles)) {
            if (is_callable($middle['middleware'])) {
                return call_user_func_array($middle['middleware'], $middle['matches']);
            }
            return call_user_func_array([$middle['middleware'], 'control'], $middle['matches']);
        }

        $m = array_pop($middles);
        $m['matches']['next'] = function () use ($middle) {
            if (is_callable($middle['middleware'])) {
                return call_user_func_array($middle['middleware'], $middle['matches']);
            }
            return call_user_func_array([$middle['middleware'], 'control'], $middle['matches']);
        };

        return self::queueMiddlewares($middles, $m);
    }

    private static function resolveMiddleWares($middlewares) {
        $queue = [];
        foreach ($middlewares as $middleware) {
            $queue [] = static::manageMiddleware($middleware);
        }
        return $queue;
    }

    private static function manageMiddleware($middleware) {
        $resolver = new Resolver;
        if (is_callable($middleware)) {
            $matches = $resolver->injectMethod($middleware);
            return ['middleware' => $middleware, 'matches' => $matches];
        } else if (!empty($middleware) && is_string($middleware)) {

            $temp_middleware = $middleware;
            if (!class_exists($middleware)) {
                $middleware = "App\\Http\\Middlewares\\{$temp_middleware}";
                if (!class_exists($middleware)) {
                    $middleware = "App\\Http\\Middlewares\\{$temp_middleware}Middleware";
                }
            }

            $middleware = $resolver->resolve($middleware);

            $matches = $resolver->injectMethod($middleware, 'control');

            return ['middleware' => $middleware, 'matches' => $matches];
        }
    }

}
