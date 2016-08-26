<?php

namespace App\Http\Controllers;

use App\Libs\Concretes\Controller;
use Response;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use function twig;

class CategoryController extends Controller {

    public function index($code) {
        $sub_cat = SubCategoryModel::first('code = ?', [$code]);
        if (!empty($sub_cat)) {
            return twig('category.html', [
                'sub_cat' => $sub_cat,
                'products' => ProductModel::where('sub_cat_id = ? AND stock >= 1', [$sub_cat->id]),
            ]);
        }
        Response::error(404);
    }

}
