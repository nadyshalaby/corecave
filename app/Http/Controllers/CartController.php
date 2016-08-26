<?php

namespace App\Http\Controllers;

use App\Classes\User;
use App\Libs\Concretes\Controller;
use Response;
use App\Libs\Statics\Session;
use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\ProductModel;
use function twig;

class CartController extends Controller {

    public function index() {
        $items = (Session::has('cart')) ? Session::get('cart')['items'] : null;
        $products = null;
        if ($items) {
            $places = array_fill(0, count($items), '?');
            $products = ProductModel::where('code IN (' . implode(', ', $places) . ')', array_keys($items));
        }
        return twig('cart.html', [
            'products' => $products
        ]);
    }

    public function add($code) {
        $cart = (empty(Session::get('cart'))) ? [] : Session::get('cart');
        $product = ProductModel::first('code = ?', [$code]);
        $status = false;
        if ($product) {
            $item_count = (isset($cart['items'][$code])) ? $cart['items'][$code] + 1 : 1;
            $status = ($product->stock >= $item_count);
            if ($status) {
                $cart['items'][$code] = $item_count;
                $cart['total'] += floatval($product->price - floatval(($product->price * $product->discount) / 100));
                $cart['count'] = $this->cart_count($cart['items']);
            }
        }
        $cart['status'] = $status;
        Session::put('cart', $cart);
        Response::json(Session::get('cart'));
    }

    public function delete($code) {
        $cart = Session::get('cart');
        $product = ProductModel::first('code = ?', [$code]);
        if ($product) {
            $cart['total'] -= floatval($cart['items'][$code]) * floatval($product->price - floatval(($product->price * $product->discount) / 100));
            unset($cart['items'][$code]);
            $cart['count'] = $this->cart_count($cart['items']);
            if (empty($cart['items'])) {
                $cart['items'] = null;
                $cart['total'] = 0;
                $cart['count'] = 0;
            }
            Session::put('cart', $cart);
        }
        Response::json(Session::get('cart'));
    }

    public function update($code, $num) {
        $cart = Session::get('cart');
        $product = ProductModel::first('code = ?', [$code]);
        if ($product) {
            $price = floatval($product->price - floatval(($product->price * $product->discount) / 100));
            $cart['item_total'] = floatval($num) * $price;
            $cart['total'] += ($num - $cart['items'][$code]) * $price;
            $cart['items'][$code] = $num;
            $cart['count'] = $this->cart_count($cart['items']);
            Session::put('cart', $cart);
        }
        Response::json(Session::get('cart'));
    }

    public function orderDelete($id) {
        $st = (OrderModel::delete('id = ?', [$id]) && OrderProductModel::delete('order_id = ? AND user_id = ?', [$id, User::getData()->id]));
        Response::json($st);
    }

    public function confirm() {
        $cart = Session::get('cart');

        if (isset($cart['items']) && !empty($cart['items'])) {

            // fetch the cart items
            $items = $cart['items'];

            // generate the next the order id
            $next_id = OrderModel::select(false, ['MAX(id) as id']);
            if (!empty($next_id)) {
                $next_id = ++$next_id[0]->id;
            } else {
                $next_id = 1;
            }

            // if the order created insert the product in order_product table
            if (OrderModel::insert([
                        'user_id' => User::getData()->id,
                        'code' => "ORD$next_id",
                        'total' => floatval($cart['total']),
                        'product_count' => $cart['count'],
                    ])) {

                // loop through each product in the cart to compute the 
                // available stock and the sold count
                foreach ($items as $code => $count) {
                    $product = ProductModel::first('code = ?', [$code]);
                    //check if the product exists and theres numirec quantity
                    if ($product && is_numeric($count)) {
                        // compute the sold count
                        $stock = ($product->stock >= $count) ? $product->stock - $count : $product->stock;
                        $sold = $product->sold + ($product->stock - $stock);
                        //update the product table after selling
                        ProductModel::update([
                            'stock' => $stock,
                            'sold' => $sold,
                                ], 'code = ? ', [$code]);
                        //fill in the order product table
                        OrderProductModel::insert([
                            'order_id' => OrderModel::lastId(),
                            'product_id' => $product->id,
                        ]);
                        Session::delete('cart');
                    }
                }
            }
            Session::flash('msg', '<li><span class="msg-success" >Success: </span> The Order created Successfully</li>');
            return redirect(route('user.profile'));
        } else {
            Session::flash('msg', '<li><span class="msg-warning" >Waring: </span> The Cart is empty, please fill in some products first</li>');
            goBack();
        }
    }

    private function cart_count($items) {
        $count = 0;
        foreach ($items as $k => $v) {
            $count += $v;
        }
        return $count;
    }

}
