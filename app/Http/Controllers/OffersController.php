<?php namespace App\Http\Controllers;

use App\Libs\Concretes\Controller;

class OffersController extends Controller {

    public function index() {
        return twig('offers.html');
    }

}
