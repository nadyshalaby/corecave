<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Libs\Concretes;

use App\Libs\Statics\Container;
use Exception;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;

/**
 * Description of Resolver
 *
 * @author Taekunger
 */
class Resolver {

    /**
     * Build an instance of the given class
     *
     * @param string $class
     * @return mixed
     *
     * @throws Exception
     */
    public function resolve($class) {
        if (Container::isBinded($class)) {
            return Container::fetch($class);
        }
        $reflector = new ReflectionClass($class);
        if (!$reflector->isInstantiable()) {
            throw new Exception("[$class] is not instantiable");
        }
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $class;
        }
        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * inject The methods dependancies 
     * 
     * @param string|callable|array $classOrCallable
     * @param string $method
     * @return array
     */
    public function injectMethod($classOrCallable, $method = '') {
        if (empty($method)) {
            $r = new ReflectionFunction($classOrCallable);
        } else if (is_array($classOrCallable)) {
            $r = new ReflectionMethod($classOrCallable[0], $classOrCallable[1]);
        } else {
            $r = new ReflectionMethod($classOrCallable, $method);
        }

        $matches = [];
        $args = $r->getParameters();

        foreach ($args as $arg) {
            $cls = $arg->getClass();
            if (!empty($cls)) {
                $cls = $cls->getName();
                if (class_exists($cls)) {
                    $matches[$arg->getName()] = $this->resolve($cls);
                }
            } else {
                $matches[$arg->getName()] = null;
            }
        }
        return $matches;
    }

    /**
     * Build up a list of dependencies for a given methods parameters
     *
     * @param array $parameters
     * @return array
     */
    private function getDependencies($parameters) {
        $dependencies = array();
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if (is_null($dependency)) {
                $dependencies[] = $this->resolveNonClass($parameter);
            } else {
                $dependencies[] = $this->resolve($dependency->name);
            }
        }
        return $dependencies;
    }

    /**
     * Determine what to do with a non-class value
     *
     * @param ReflectionParameter $parameter
     * @return mixed
     */
    private function resolveNonClass(ReflectionParameter $parameter) {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        return null;
    }

}
