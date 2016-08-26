<?php

namespace App\Http\Controllers\Admin;

use App\Libs\Concretes\Controller;

class MessageController extends Controller {

    public function index() {
        return twig('admin/pages/messages.html');
    }

}
