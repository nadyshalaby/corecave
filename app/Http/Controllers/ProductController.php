<?php

namespace App\Http\Controllers;

use App\Classes\User;
use App\Libs\Concretes\Controller;
use Request;
use Response;
use App\Libs\Statics\Session;
use App\Models\CategoryModel;
use App\Models\FavoriteModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;

class ProductController extends Controller {

    public function index($code) {
        $product = ProductModel::first('code = ?', [$code]);
        if (!empty($product)) {
            return twig('product.html', [
                'product' => $product,
            ]);
        }
        Response::error(404);
    
    }
        
    public function wishlistAdd($code) {
        $product = ProductModel::first('code = ?', [$code]);
        Response::json(FavoriteModel::insert([
            'user_id' => User::getData()->id,
            'product_id' =>$product->id,
        ]));     
    }
    
    public function wishlistDelete($code) {
        $product = ProductModel::first('code = ?', [$code]);
        Response::json(FavoriteModel::delete('user_id = ? AND product_id = ?',[
             User::getData()->id,
             $product->id,
        ]));     
    }

    public function insert() {
        $product = Request::getALlParams(true);
        $user = User::getData();
        $sub_cat = SubCategoryModel::first('code = ?', [$product->sub_category]);
        $next_id = ProductModel::select(false,['MAX(id) as id']);
        if (!empty($next_id)) {
            $next_id = ++$next_id[0]->id;
        } else {
            $next_id = 1;
        }
        $product_data = [
            'user_id' => $user->id,
            'name' => $product->name,
            'code' => "ITEM{$next_id}",
            'description' => $product->description,
            'price' => floatval($product->price),
            'discount' => floatval($product->discount),
            'length' => floatval($product->length),
            'width' => floatval($product->width),
            'size' => $product->size,
            'material' => $product->material,
            'color' => $product->color,
            'sex' => $product->sex,
            'slug' => ProductModel::getSlug($product->name),
            'stock' => $product->stock,
            'cat_id' => $sub_cat->cat_id,
            'sub_cat_id' => $sub_cat->id,
            'weight' => floatval($product->weight),
            'image' => $product->image,
        ];

        $cat_product_count = CategoryModel::id($sub_cat->cat_id)->product_count;

        if (ProductModel::insert($product_data) &&
                CategoryModel::update(['product_count' => ++$cat_product_count], 'id = ?', [$sub_cat->cat_id]) &&
                SubCategoryModel::update(['product_count' => ++$sub_cat->product_count], 'id = ?', [$sub_cat->id])) {
            Session::flash('msg', '<li><span class="msg-success" >Success: </span> The Product created Successfully</li>');
            goBack();
        } else {
            Response::error(401);
        }
    }
    
    public function delete($id) {
        $p = ProductModel::id($id);
        if (!empty($p->image) && is_file(path('resources/' . $p->image))) {
            @unlink(path('resources/' . $p->image));
        }     
        Response::json(ProductModel::delete('id = ?',[$id]));          
    }

}
