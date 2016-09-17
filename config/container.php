<?php

use App\Core\Support\Config;

return [
    'twig' => function() {
        $loader = new Twig_Loader_Filesystem(_path('resources.views'));
        $twig = new Twig_Environment($loader, Config::twig('config'));

        return $twig;
    }
];
