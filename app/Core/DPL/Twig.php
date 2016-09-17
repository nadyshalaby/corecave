<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Core\DPL;

use App\Core\Http\Bags\DI\Container;
use App\Core\Support\Config;
use App\Core\Support\Resolver;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class Twig {

    protected $_twig;

    public function __construct() {
        $this->_twig = Container::fetch('twig');

        // load functions of defined classes into Twig Environment
        $this->loadStaticFunctions();
        // load functions of defined classes into Twig Environment
        $this->loadMemberFunctions();
        // load functions of defined callables into Twig Environment
        $this->loadCallableFunctions();
        // load defined filters into Twig Environment
        $this->loadFilters();
        // load defined globals into Twig Environment
        $this->loadGlobals();
        
    }

    /**
     * Load the passed view with the optional args
     * @param string $path the path to the view to be rendered
     * @param array $args arguments to be passed with the view
     * @return type
     */
    public function render($path, $args = []) {
        return $this->_twig->render($path, $args);
    }

    public function getInstance() {
        return $this->_twig;
    }

    /**
     * Loads the Functions of the defined classes into the Twig Environment
     */
    protected function loadStaticFunctions() {
        $classes = Config::twig('static_functions');
        foreach ($classes as $key => $cls) {
            if (!is_numeric($key)) {
                $as = $cls;
                $cls = $key;
            } else {
                $as = strtolower(_getClassBaseName($cls));
            }
            
            if(!class_exists($cls)){
                continue;
            }
            
            $methods = get_class_methods($cls);
            foreach ($methods as $name) {
                $newname = $as . '_' . $name;
                $this->_twig->addFunction(new Twig_SimpleFunction($newname, [$cls, $name]));
            }
        }
    }

    protected function loadMemberFunctions() {
        $classes = Config::twig('member_functions');
        foreach ($classes as $key => $cls) {
            if (!is_numeric($key)) {
                $as = $cls;
                $cls = $key;
            } else {
                $as = strtolower(_getClassBaseName($cls));
            }
            
            if(!class_exists($cls)){
                continue;
            }
            
            $methods = get_class_methods($cls);
            foreach ($methods as $name) {
                $newname = (empty($as) ? '' : $as . '_') . $name;
                $this->_twig->addFunction(new Twig_SimpleFunction($newname, [(new Resolver)->resolve($cls), $name]));
            }
        }
    }

    /**
     * Loads the Functions of the defined callables into the Twig Environment
     */
    protected function loadCallableFunctions() {
        $classes = Config::twig('callable_functions');
        foreach ($classes as $key => $cls) {
            if (is_string($key) && is_callable($cls)) {
                $this->_twig->addFunction(new Twig_SimpleFunction($key, $cls));
            }
        }
    }

    /**
     * Loads the defined Filters into the Twig Environment
     */
    protected function loadFilters() {
        $filters = Config::twig('filters');
        foreach ($filters as $name => $callable) {
            $this->_twig->addFilter(new Twig_SimpleFilter($name, $callable));
        }
    }

    /**
     * Loads the defined Globals into the Twig Environment
     */
    protected function loadGlobals() {
        $globals = Config::twig('globals');
        foreach ($globals as $name => $value) {
            if (!is_string($value) && is_callable($value)) {
                $args = (new Resolver)->injectMethod($value);
                $this->_twig->addGlobal($name, call_user_func_array($value, $args));
            } else {
                $this->_twig->addGlobal($name, $value);
            }
        }
    }

}
