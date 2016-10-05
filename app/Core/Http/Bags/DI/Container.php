<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\Http\Bags\DI;

use App\Core\Support\Resolver;
use ArrayAccess;
use Closure;
use Exception;

class Container implements ArrayAccess {

    /**
     * Hold the bindings of the container.
     * 
     * @var array
     */
    protected static $bindings = [];

    /**
     * Holds the processes of the container.
     * 
     * @var array
     */
    protected static $processes = [];

    /**
     * Holds the attachments of the container.
     * 
     * @var array
     */
    protected static $attachments = [];

    /**
     * Magic Setter to bind something to the container.
     * 
     * @param mixed $name
     * @param mixed $binding
     */
    public function __set($name, $binding) {
        static::override($name, $binding);
    }

    /**
     * Magic Getter to fetch something from the container.
     * 
     * @param mixed $name
     */
    public function __get($name) {
        return static::binding($name);
    }

    /**
     * Bind something to the container.
     * if no binding given, the passed name will be fetched from the container.
     * 
     * <b>NOTE:-</b>
     * <p>
     * When binding something to the container it be processed only one time.
     * every time it will be fetched its processed value will be returned.
     * </p>
     * 
     * @param mixed $name
     * @param mixed|callable $binding
     * @return mixed
     * @throws Exception if the name is already binded
     */
    public static function binding($name, $binding = null) {

        if (empty($binding)) {
            if (static::isBinded($name)) {
                return static::$bindings[$name];
            }
            return null;
        }
        
        if (in_array($name, array_keys(static::$bindings))) {
            throw new Exception('"' . $name . '" is already binded.', 1);
        } else {
            if (!is_string($binding) && is_callable($binding)) {
                $args = (new Resolver)->injectMethod($binding);
                return (static::$bindings[$name] = call_user_func_array($binding, $args));
            } else {
                return (static::$bindings[$name] = $binding);
            }
        }
    }

    /**
     * process a callable to the container or fetch processed callable if only the name is passed.
     * 
     * <b>NOTE:-</b>
     * <p>
     * When processing a callable to the container it be called every time on fetching.
     * </p>
     * 
     * @param mixed $name
     * @param \Closure $process
     * @return mixed
     */
    public static function process($name, Closure $process = null) {

        if (empty($process)) {

            if (static::isProcessed($name)) {
                $process = static::$processes[$name];
                $args = (new Resolver)->injectMethod($process);

                return call_user_func_array($process, $args);
            }
            return null;
        }

        if (!is_string($process) && is_callable($process)) {
            return (static::$processes[$name] = $process);
        }
    }

    /**
     * attach a callable to the container or fetch attached callable if only the name is passed.
     * 
     * <b>NOTE:-</b>
     * <p>
     * When attaching a callable to the container it won't be processed.
     * so when it will be fetched as a callable.
     * </p>
     * 
     * @param mixed $name
     * @param \Closure $attach
     * @return mixed
     */
    public static function attachment($name, Closure $attach = null) {

        if (empty($attach)) {
            if (static::isAttached($name)) {
                return static::$attachments[$name];
            }
            return null;
        }

        if (!is_string($attach) && is_callable($attach)) {
            return (static::$attachments[$name] = $attach);
        }
    }

    /**
     * Bind an array of bindings to the container.
     * 
     * @param array $bindings
     * @return \static
     * @throws \Exception if any binding is already attached to the container.
     */
    public static function bindAll(array $bindings) {
        foreach ($bindings as $name => $binding) {
            static::binding($name, $binding);
        }
        return new static;
    }

    /**
     * Bind or override an array of bindings to the container.
     * 
     * @param array $bindings
     * @return \static
     */
    public static function bindOrOverrideAll(array $bindings) {
        foreach ($bindings as $name => $binding) {
            static::override($name, $binding);
        }

        return new static;
    }

    /**
     * unbind the passed name from the container if there's no passed arguments
     * the whole bindings will be removed.
     * 
     * @param mixed $name
     * @return \static
     */
    public static function unbind($name = null) {
        if ($name) {
            unset(static::$bindings[$name]);
        } else {
            static::$bindings = [];
        }
        return new static;
    }

    /**
     * unprocess the passed name from the container if there's no passed arguments
     * the whole processes will be removed.
     * 
     * @param mixed $name
     * @return \static
     */
    public static function unprocess($name = null) {
        if ($name) {
            unset(static::$processes[$name]);
        } else {
            static::$processes = [];
        }
        return new static;
    }

    /**
     * detach the passed name from the container if there's no passed arguments
     * the whole attachments will be removed.
     * 
     * @param mixed $name
     * @return \static
     */
    public static function detach($name = null) {
        if ($name) {
            unset(static::$attachments[$name]);
        } else {
            static::$attachments = [];
        }
        return new static;
    }

    /**
     * Checks if there any binding exists with that name.
     * 
     * @param mixed $name
     * @return bool
     */
    public static function isBinded($name) {
        return isset(static::$bindings[$name]);
    }

    /**
     * Checks if there any process exists with that name.
     * 
     * @param mixed $name
     * @return bool
     */
    public static function isProcessed($name) {
        return isset(static::$processes[$name]);
    }

    /**
     * Checks if there any attachment exists with that name.
     * 
     * @param mixed $name
     * @return bool
     */
    public static function isAttached($name) {
        return isset(static::$attachments[$name]);
    }

    /**
     * grap all processes attached to the container .
     * 
     * @return mixed
     */
    public static function allProcesses() {
        return (empty(static::$processes)) ? null : static::$processes;
    }

    /**
     * grap all bindings attached to the container .
     * 
     * @return mixed
     */
    public static function allBindings() {
        return (empty(static::$bindings)) ? null : static::$bindings;
    }

    /**
     * grap all attachments attached to the container .
     * 
     * @return mixed
     */
    public static function allAttachments() {
        return (empty(static::$attachments)) ? null : static::$attachments;
    }

    /**
     * bind or Override an existing bindings to the container.
     *  
     * @param mixed $name
     * @param mixed $binding
     * @return \static
     */
    public static function override($name, $binding) {
        if ($name) {
            static::unbind($name);
            return static::binding($name, $binding);
        }
        return new static;
    }

    /**
     * bind or Override an array of bindings to the container.
     * if the append flag setted to false the pervious bindings will be removed.
     * 
     * @param array $bindings
     * @param bool $append
     * @return \Container
     */
    public function withBindings(array $bindings, $append = true) {
        if (!$append) {
            static::unbind();
        }
        static::bindOrOverrideAll($bindings);
        return $this;
    }

    /**
     * process an array of processes to the container.
     * if the append flag setted to false the pervious processes will be removed.
     * 
     * @param array $processes
     * @param bool $append
     * @return \Container
     */
    public function withProcesses(array $processes, $append = true) {
        if (!$append) {
            static::unprocess();
        }
        foreach ($processes as $name => $process) {
            static::process($name, $process);
        }
        return $this;
    }

    /**
     * attach an array of attachments to the container.
     * if the append flag setted to false the pervious attachments will be removed.
     * 
     * @param array $attachments
     * @param bool $append
     * @return \Container
     */
    public function withAttachments(array $attachments, $append = true) {
        if (!$append) {
            static::detach();
        }
        foreach ($attachments as $name => $attachment) {
            static::attachment($name, $attachment);
        }
        return $this;
    }

    public function offsetSet($offset, $value) {
        $parts = explode('|', $offset);
        
        if(is_array($parts) && count($parts) > 1){
            $key = $parts[0];
            $filter = end($parts);
            
            switch (strtolower($filter)){
                case 'p':
                case 'process':
                    return static::process($key, $value);
                case 'a':
                case 'attachment':
                    return static::attachment($key, $value);
                case 'b':
                case 'binding':
                    return static::binding($key, $value);
                case 'o':
                case 'override':
                    return static::override($key, $value);
            }
            return;
        }
        static::binding($offset, $value);
    }

    public function offsetExists($offset) {
        $parts = explode('|', $offset);
        
        if(is_array($parts) && count($parts) > 1){
            $key = $parts[0];
            $filter = end($parts);
            
            switch (strtolower($filter)){
                case 'p':
                case 'process':
                    return static::isProcessed($key);
                case 'a':
                case 'attachment':
                    return static::isAttached($key);
                case 'b':
                case 'binding':
                    return static::isBinded($key);
            }
            return false;
        }
        return static::isBinded($offset);
    }

    public function offsetUnset($offset) {
        $parts = explode('|', $offset);
        
        if(is_array($parts) && count($parts) > 1){
            $key = $parts[0];
            $filter = end($parts);
            
            switch (strtolower($filter)){
                case 'p':
                case 'process':
                    return static::unprocess($key);
                case 'a':
                case 'attachment':
                    return static::detach($key);
                case 'b':
                case 'binding':
                    return static::unbind($key);
            }
            return;
        }
        static::unbind($offset);
    }

    public function offsetGet($offset) {
        $parts = explode('|', $offset);
        
        if(is_array($parts) && count($parts) > 1){
            $key = $parts[0];
            $filter = end($parts);
            
            switch (strtolower($filter)){
                case 'p':
                case 'process':
                    return static::process($key);
                case 'a':
                case 'attachment':
                    return static::attachment($key);
                case 'b':
                case 'binding':
                    return static::binding($key);
            }
            return null;
        }
        static::binding($offset);
    }

}
