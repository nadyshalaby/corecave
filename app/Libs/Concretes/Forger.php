<?php
namespace App\Libs\Concretes;

use App\Libs\Concretes\Resolver;
use App\Libs\Exceptions\MethodNotFoundExecption;
use App\Libs\Statics\Container;
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
            return Container::fetch($class);
        }
        
        return Container::bind($class, (new Resolver)->resolve($class));
    }
}
