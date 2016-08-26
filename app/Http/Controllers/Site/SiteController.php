<?php

namespace App\Http\Controllers\Site;

use App\Libs\Concretes\Controller;

class SiteController extends Controller {

    public function arabic() {
        return twig('site/index-ar.html');
    }
    
    public function english() {
        return twig('site/index-en.html');
    }

}
