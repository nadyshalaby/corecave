<?php

namespace App\Http\Controllers\Site;

use App\Libs\Concretes\Controller;
use App\Libs\Statics\Session;

class SiteController extends Controller {

    public function arabic() {
        Session::put('site', 'site.arabic');
        return twig('site/index-ar.html');
    }

    public function english() {
        Session::put('site', 'site.english');
        return twig('site/index-en.html');
    }

}
