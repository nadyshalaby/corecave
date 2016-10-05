<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use App\Core\DAL\DB;
use App\Core\Http\Bags\DI\Container;
use App\Core\Http\Bags\Sessions\Sessioner;
use App\Core\Http\Routing\Router;
use App\Core\Support\Config;
use Illuminate\Container\Container as DIContainer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class App {

    public function __construct() {

        //autoloading classes
        require_once 'vendor/autoload.php';


        //loading the aliases for classes
        $this->loadAliases();

        // set debugging mode
        $this->setDebuggingMode(Config::app('debugging'));

        //setting up elquont
        $this->setup_elquont();

        //starting the sessions
        Sessioner::sessionStart();

        //building the database schema if the dbrestore = true
        if (!DB::getInstance()->buildDB()) {
            throw new Exception("Error Processing Database Restore", 1);
        }


        //loading the initial bindings
        $bindings = include Config::container();
        Container::bindAll($bindings);

        // setting up routes pages
        $route = Container::binding(Router::class, new Router);

        foreach (_deepDirScan(_path('routes')) as $r) {
            if (_fileHasExtension($r, 'php')) {
                require_once $r;
            }
        }
    }

    private function loadAliases() {
        $aliases = include_once 'config/alias.php';
        foreach ($aliases as $alias => $class) {
            if (class_exists($class)) {
                class_alias($class, $alias);
            }
        }
    }

    private function setDebuggingMode($status) {
        if (!$status) {
            error_reporting(0);
            ini_set('default_charset', 'UTF-8');
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
        }
    }

    private function setup_elquont() {
        $container = new DIContainer;
        $capsule = new Capsule;
        $capsule->addConnection(Config::app('db'));
        $capsule->getConnection()->setFetchMode(Config::app("db>fetch_mode"));
        Container::binding('db', $capsule->getConnection()->getPdo());
        $capsule->setEventDispatcher(new Dispatcher($container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}
