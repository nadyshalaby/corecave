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

use App\Libs\Statics\Config;
use App\Libs\Statics\Container;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class View {

    private $_twig;

    public function __construct() {
        $this->_twig = Container::fetch('twig');
    }

    public function show($path, $params = []) {
        foreach ($params as $key => $value) {
            if (is_numeric($key)) {
                continue;
            }
            ${$key} = $value;
        }
        $pagename = multiexplode(['.', '/', '>', '|'], $path)[0];
        require_once path('resources.views.' . $path . 'php');
    }

    /**
     * Load the passed view with the optional args
     * @param string $path the path to the view to be rendered
     * @param array $args arguments to be passed with the view
     * @return type
     */
    public function twig($path, $args = []) {

        // load functions of defined classes into Twig Environment
        $this->twigStaticFunctions();
        // load functions of defined callables into Twig Environment
        $this->twigCallableFunctions();
        // load defined filters into Twig Environment
        $this->twigFilters();
        return $this->_twig->render($path, $args);
    }

    public function getTwig() {
        return $this->_twig;
    }

    /**
     * Loads the Functions of the defined classes into the Twig Environment
     */
    private function twigStaticFunctions() {
        $classes = Config::twig('static_functions');
        foreach ($classes as $key => $cls) {
            $methods = get_class_methods($cls);
            foreach ($methods as $name) {
                $newname = strtolower(getClassBaseName($cls)) . '_' . $name;
                $this->_twig->addFunction(new Twig_SimpleFunction($newname, [$cls, $name]));
            }
        }
    }

    /**
     * Loads the Functions of the defined callables into the Twig Environment
     */
    private function twigCallableFunctions() {
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
    private function twigFilters() {
        $filters = Config::twig('filters');
        foreach ($filters as $name => $callable) {
            $this->_twig->addFilter(new Twig_SimpleFilter($name, $callable));
        }
    }

}
