<?php

namespace App\Http\Controllers\Admin;

use App\Libs\Concretes\Controller;
use App\Libs\Statics\Config;
use Response;

class HomeController extends Controller {

    public function index() {
        return _twig('admin/pages/dashboard.html');
    }
    
    public function download($file) {
        $path = Config::extra('uploads.compressed');
        if(!file_exists("$path/$file")){
            _goBack()->flash('error',' The file not found');
        }
        Response::download("$path/$file");
    }

}
