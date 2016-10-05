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

use App\Core\Exceptions\MethodNotFoundExecption;
use App\Core\Http\Bags\DI\Container;
use Exception;

/**
 * Description of Forger
 *
 * @author Taekunger
 */
abstract class Forger {
    
    public static function __callStatic($name, $args) {
        $instance = static::getInstance();
        
        if(!method_exists($instance, $name)){
            throw new MethodNotFoundExecption('The method "' . $name .'" does not exist' );
        }
        
        return call_user_func_array([$instance,$name],$args);
    }
    
    public static function getForgedClass() {
            throw new Exception('You must override the static method "getForgedClass" .');
    }
    
    private static function getInstance() {
        $class = static::getForgedClass();
        
        if(Container::isBinded($class)){
            return Container::binding($class);
        }
        
        return Container::binding($class, (new Resolver)->resolve($class));
    }
}
