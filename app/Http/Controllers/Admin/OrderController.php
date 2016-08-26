<?php

namespace App\Http\Controllers\Admin;

use App\Libs\Concretes\Controller;

class OrderController extends Controller {

    public function index() {
        return twig('admin/pages/orders.html');
    }

}
