<?php

namespace App\Http\Controllers;

use App\Classes\User;
use App\Libs\Concretes\Controller;
use Request;
use Response;
use App\Libs\Statics\Session;
use App\Models\ShippingModel;
use function goBack;

class ShippingController extends Controller {

    public function insert() {
        $user = User::getData();
        $shipping = Request::getALlParams(true);

        $shipping_data = [
            'user_id' => $user->id,
            'address_1' => $shipping->address_1,
            'address_2' => $shipping->address_2,
            'city' => $shipping->city,
            'state' => $shipping->state,
            'country' => $shipping->country,
            'tel' => $shipping->tel,
            'zip' => $shipping->zip,
            'active' => 1,
        ];

        // if not the first address ,de-activate it
        if (ShippingModel::findBy(['user_id' => $user->id])) {
            $shipping_data['active'] = 0;
        }

        if (ShippingModel::insert($shipping_data)) {
            Session::flash('msg', '<li><span class="msg-success" >Success: </span> The shipping address inserted Successfully</li>');
            goBack();
        } else {
            Response::error(401);
        }
    }

    public function delete() {
        $marks = Request::getParam('shipping-marks');

        $status = [];
        $status['status'] = false;
        // if the shippings selected
        if (count($marks)) {
            // loop through each shipping and to delete
            foreach ($marks as $mark) {
                //confirm that the shipping id is deleted
                if (ShippingModel::delete('id = ? AND user_id = ?', [$mark, User::getData()->id])) {
                    $status['msg'] .= 'Success: Deleting Shipping #' . $mark . ' Successfully, ';
                    $status['status'] = true;
                } else {
                    $status['msg'] .= 'Error: Deleting Shipping #' . $mark . ' Failed';
                }
            }
            //if no Shipping selected
        } else {
            $status['msg'] .= 'Error: Mark at least one Shipping to be delete';
        }
        Response::json($status);
    }

    public function asDefault() {
        $marks = Request::getParam('shipping-marks');

        $status = [];
        $status['status'] = false;
        // if the shippings selected
        if (count($marks) == 1) {
            // loop through each shipping and to delete
            $active = Request::getParam('_active');
            foreach ($marks as $mark) {
                //confirm that the shipping id is deleted
                if (ShippingModel::update(['active' => 0], 'id = ? AND user_id = ?', [$active, User::getData()->id]) &&
                        ShippingModel::update(['active' => 1], 'id = ? AND user_id = ?', [$mark, User::getData()->id])) {
                    $status['msg'] .= 'Success: Setting Shipping address #' . $mark . ' as the default one Successfully, ';
                    $status['status'] = true;
                } else {
                    $status['msg'] .= 'Error: Setting Shipping address #' . $mark . ' as the default one Failed';
                }
            }
            //if no Shipping selected
        } else {
            $status['msg'] .= 'Error: Mark only one shipping address to be as a default address ';
        }
        Response::json($status);
    }

}
