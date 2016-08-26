<?php namespace App\Http\Controllers;

use App\Libs\Concretes\Controller;
use function twig;

class SearchController extends Controller {

    public function index() {
        return twig('search.html');
    }

}
