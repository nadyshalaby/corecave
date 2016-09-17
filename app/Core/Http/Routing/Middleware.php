<?php

namespace App\Core\Http\Routing;

use App\Core\Support\Resolver;

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

