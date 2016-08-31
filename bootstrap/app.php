<?php

use App\Libs\Concretes\DB;
use App\Libs\Concretes\Router;
use App\Libs\Statics\Config;
use App\Libs\Statics\Container;
use App\Libs\Statics\Sessioner;
use Illuminate\Container\Container as DIContainer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class App {

    public function __construct() {

        //autoloading classes
        require_once 'vendor/autoload.php';

        //starting the sessions
        Sessioner::sessionStart(Config::extra('session.timeout'));

        //loading the aliases for classes
        $this->loadAliases();

        // set debugging mode
        $this->setDebuggingMode(Config::app('debugging'));

        //setting up elquont
        $this->setup_elquont();

        //building the database schema if the dbrestore = true
        if (!DB::getInstance()->buildDB()) {
            throw new Exception("Error Processing Database Restore", 1);
        }


        //loading the initial bindings
        $bindings = include Config::container();
        Container::bindAll($bindings);

        // setting up routes to pages
        $route = Container::bind(Router::class, new Router);
        require_once 'app/Http/routes.php';
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
        Container::bind('db', $capsule->getConnection()->getPdo());
        $capsule->setEventDispatcher(new Dispatcher($container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}

