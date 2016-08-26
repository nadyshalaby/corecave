<?php namespace App\Http\Controllers;

use App\Libs\Concretes\Controller;
use function twig;

class AboutController extends Controller {

    public function index() {
        return twig('about.html');
    }

}
