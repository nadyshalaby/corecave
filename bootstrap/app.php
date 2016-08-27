<?php

use App\Libs\Concretes\DB;
use App\Libs\Concretes\Router;
use App\Libs\Statics\Config;
use App\Libs\Statics\Container;
use Illuminate\Container\Container as DIContainer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class App {

    public function __construct() {

        //starting the sessions
        $this->session_setup();

        
        
        //autoloading classes
        require_once 'vendor/autoload.php';

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

    private function session_setup() {
        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set("session.cookie_secure", 1);
        ini_set('session.save_handler', 'files');
        session_set_cookie_params(0, ini_get('session.cookie_path'), ini_get('session.cookie_domain'), isset($_SERVER['HTTPS']), true);
        session_save_path(__DIR__ . '/../storage/sessions');
        session_name('corecave');
        session_start();

        if (!$this->isValid()) {
            session_destroy();
        }else{
            // Make sure we have a canary set
            if (!isset($_SESSION['canary'])) {
                session_regenerate_id(true);
                $_SESSION['canary'] = time();
            }
            // Regenerate session ID every five minutes:
            if ($_SESSION['canary'] < time() - 300) {
                session_regenerate_id(true);
                $_SESSION['canary'] = time();
            }
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

    public function isExpired($ttl = 30) {
        $last = isset($_SESSION['_last_activity']) ? $_SESSION['_last_activity'] : false;
        if ($last !== false && time() - $last > $ttl * 60) {
            return true;
        }
        $_SESSION['_last_activity'] = time();
        return false;
    }

    public function isFingerprint() {
        $hash = md5(
                $_SERVER['HTTP_USER_AGENT'] .
                (ip2long($_SERVER['REMOTE_ADDR']) & ip2long('255.255.0.0'))
        );
        if (isset($_SESSION['_fingerprint'])) {
            return $_SESSION['_fingerprint'] === $hash;
        }
        $_SESSION['_fingerprint'] = $hash;
        return true;
    }

    public function isValid() {
        return !$this->isExpired() && $this->isFingerprint();
    }
}
