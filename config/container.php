<?php

use App\Libs\Statics\Config;

return [
    'twig' => function() {
        $loader = new Twig_Loader_Filesystem(path('resources.views'));
        return new Twig_Environment($loader, Config::twig('config'));
    }
];
