<?php

namespace App\Core\Http\Routing;

use App\Core\Support\Resolver;

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
                $parts = _multiexplode(['@', '>', '.', '#', '-', '/'], $this->callable);
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

