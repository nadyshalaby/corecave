<?php

namespace App\Http\Controllers\Admin;

use App\Libs\Concretes\Controller;

class HomeController extends Controller {

    public function index() {
        return twig('admin/pages/dashboard.html');
    }

}
