<?php namespace App\Http\Controllers;

use App\Libs\Concretes\Controller;

class BlogController extends Controller {

    public function index() {
        return twig('blogs.html');
    }

}
