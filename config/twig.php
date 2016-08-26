<?php

use App\Classes\Facebook;
use App\Classes\User;
use App\Libs\Statics\Session;
use App\Models\CategoryModel;
use App\Models\GoogleModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use Carbon\Carbon;

return [
    'config' => [
        'cache' => path('resources.cache'),
        'debug' => true, //used for development purposes 
    // 'auto_reload' => true, // if it didn't set it will be determined from the value of debug option
    ],
    'globals' => [
        'v' => function(){return (new App\Libs\Concretes\Validation)->getInstance();}, // or callable
    ],
    /**
     *  list the names of the classes that its functions will be statically called in Twig Environments 
     *  list the objects that its functions will be dynamically called in Twig Environments 
     *  the methods will be called its name pre-pended by the name of its class in lowercase
     *  (eg. Session::has($str) will be called session_has($str)) 
     */
    'static_functions' => [
        'Url',
        'Session',
        'Token',
    ],
    'member_functions' => [
        'App\Libs\Concretes\Validation' => ''
    ],
    'callable_functions' => [
        'social' => function ($c) {
            switch ($c) {
                case 'f':
                    $url = new Facebook;
                    return $url->getLoginUrl();
                case 'g':
                    $client = new Google_Client;
                    $auth = new GoogleModel($client);
                    return $auth->getAuthUrl();
            }
        },
        'is_loggedin' => function () {
            $u = new User;
            return $u->isLoggedIn();
        },
        'time' => function ($time) {
            $t = new Carbon($time);
            return $t->toRfc850String();
        },
        'readable_time' => function ($time) {
            return arabic_date_format(strtotime($time));
        },
        'cart_total' => function () {
            return (Session::has('cart')) ? (Session::get('cart')['total']) : '0.00';
        },
        'cart_items_count' => function ($code = '') {
            $count = 0;
            if (!empty($code)) {
                $count = Session::get('cart')['items'][$code];
            } else if (Session::has('cart')) {
                $items = Session::get('cart')['items'];
                foreach ($items as $k => $v) {
                    $count += $v;
                }
            }
            return $count;
        },
        'getCats' => function () {
            return CategoryModel::all();
        },
        'getSubCats' => function () {
            return SubCategoryModel::all();
        },
        'getProducts' => function () {
            return ProductModel::with(['user_id' => User::getData()->id]);
        },
                'getFavoriteProduct' => function ($f) {
            return ProductModel::id($f->product_id);
        },
                'getRelatedProducts' => function ($sub_cat) {
            return ProductModel::with(['sub_cat_id' => $sub_cat]);
        },
                'getRelatedProducts' => function ($sub_cat) {
            return ProductModel::with(['sub_cat_id' => $sub_cat]);
        },
                'strip' => function ($string) {
            // strip tags to avoid breaking any html
            $string = strip_tags($string);

            if (strlen($string) > 500) {

                // truncate string
                $stringCut = substr($string, 0, 500);

                // make sure it ends in a word so assassinate doesn't become ass...
                $string = substr($stringCut, 0, strrpos($stringCut, ' '));
            }
            return nl2br($string);
        },
                'has_role' => function ($target_role) {
            return (User::getData()->role == $target_role);
        },
                'has_avatar' => function ($avatar) {
            return file_exists(path('resources.' . $avatar));
        },
            ],
            'filters' => [
                'e' => function ($str) {
                    return escape($str);
                },
            ],
        ];

        