<?php namespace App\Http\Controllers;

use App\Libs\Concretes\Controller;

class RulesController extends Controller {

    public function index() {
        return twig('rules.html');
    }

}
