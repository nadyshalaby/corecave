<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middlewares;

use App\Classes\User;
use Request;
use App\Libs\Statics\Session;
use Validation;

class ProductMiddleware extends \App\Libs\Concretes\Middleware {
    
    function control($next) { echo 'product'; return $next(); }

//    function control($next) {
//        $client_data = Request::getALlParams();
//        Validation::check($client_data, [
//            'name' => [
//                'required' => true,
//                'unicode_space' => true,
//                'min' => 2,
//                'title' => 'Product Name'
//            ],
//            'price' => [
//                'required' => true,
//                'num' => true,
//                'range' => ['low' => 0],
//                'title' => 'Price'
//            ],
//            'discount' => [
//                'num' => true,
//                'range' => ['low' => 0, 'high' => 100],
//                'title' => 'Dis-count'
//            ],
//            'stock' => [
//                'required' => true,
//                'num' => true,
//                'range' => ['low' => 0],
//                'title' => 'The Number of available pieces'
//            ],
//            'sex' => [
//                'required' => true,
//                'equals' => ['male', 'female'],
//                'title' => 'Sex'
//            ],
//            'material' => [
//                'num' => false,
//                'title' => 'E-mail'
//            ],
//            'width' => [
//                'num' => true,
//                'range' => ['low' => 0],
//                'title' => 'Width'
//            ],
//            'length' => [
//                'num' => true,
//                'range' => ['low' => 0],
//                'title' => 'Length'
//            ],
//            'size' => [
//                'required' => true,
//                'equals' => ['SM', 'MD', 'LG', 'X-LG', 'XX-LG', 'XXX-LG', 'ALL'],
//                'title' => 'Size'
//            ],
//            'description' => [
//                'required' => true,
//                'title' => 'Description'
//            ],
//            'weight' => [
//                'num' => true,
//                'range' => ['low' => 0],
//                'title' => 'Weight'
//            ],
//        ]);
//
//        $image = Request::getFile('image');
//        $str = '';
//
//        if (Validation::passed()) {
//            // grapping the current user data
//            $user = User::getData();
//
//            // if the image is set it will be tested
//            $imageFlag = false;
//            if (!empty($image)) {
//                $imagename = uniqueFile('resources/images/products', $image->name);
//                Request::appendParam('image', "images/products/{$imagename}");
//                $imageFlag = ($image->size <= 100000 && scanImageToPng($image->tmp_name, path("resources/images/products/{$imagename}")));
//                if (!$imageFlag) {
//                    $str .= '<li><span class="msg-error" >Error: </span> The Product Image must be an image and less that 10 MB</li>';
//                }
//            } else {
//                $str .= '<li><span class="msg-error" >Error: </span> The Product image is required</li>';
//            }
//            if ($imageFlag) {
//                return $next();
//            }
//        }
//
//        $msgs = Validation::getAllErrorMsgs();
//        if (count($msgs)) {
//            foreach ($msgs as $msg) {
//                $str .= '<li><span class="msg-error" >Error: </span> ' . $msg . '</li>';
//            }
//        }
//        Session::flash('msg', $str);
//        Session::flash('data', $client_data);
//        goBack();
//    }

}
