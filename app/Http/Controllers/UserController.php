<?php

namespace App\Http\Controllers;

use App\Classes\User;
use App\Libs\Concretes\Controller;
use App\Libs\Statics\Hash;
use Request;
use Response;
use App\Libs\Statics\Session;
use App\Models\FavoriteModel;
use App\Models\OrderModel;
use App\Models\ShippingModel;
use App\Models\SubClientModel;
use App\Models\UserModel;
use Carbon\Carbon;

class UserController extends Controller {

    public function profile() {
        $user = User::getData();
        if ($user) {
            return twig('profile.html', [
                'user' => $user,
                'shippings' => ShippingModel::with(['user_id' => $user->id]),
                'sub_clients' => SubClientModel::with(['user_id' => $user->id]),
                'orders' => OrderModel::with(['user_id' => $user->id]),
                'favorites' => FavoriteModel::with(['user_id' => $user->id]),
            ]);
        }
        Session::flash("msg", '<li><span class="msg-warning">Warning: </span> Humm!... you want to cheat, access denied</li>');
        goBack();
    }
    
    public function delete() {
        $user = User::getData();
        if (!empty($user->avatar) && is_file(path('resources/' . $user->avatar))) {
            @unlink(path('resources/' . $user->avatar));
        } 
        
        Response::json(UserModel::delete('id = ?' , [$user->id]));
    }

    public function update() {

        $user = User::getData();
        $f_name = Request::getParam('fname');
        $l_name = Request::getParam('lname');
        $email = Request::getParam('email');
        $newpass = Request::getParam('newpass');
        $national_id = Request::getParam('national_id');
        $role = Request::getParam('role');
        $avatar = '';
        if (Request::hasFile('avatar')) {
            $avatar = "images/avatars/" . Request::getFile('avatar')->name;
        }

        if (empty($newpass)) {
            if ($user->pass == 'freeziana') {
                $newpass = $user->pass;
            } else {
                $newpass = Hash::make(Request::getParam('pass'));
            }
        }else{
            $newpass = Hash::make($newpass);
        }
        if (empty($avatar)) {
            $avatar = $user->avatar;
        }
        if (empty($national_id)) {
            $national_id = $user->national_id;
        }

        $user_columns = [
            'f_name' => $f_name,
            'l_name' => $l_name,
            'email' => $email,
            'pass' => $newpass,
            'role' => $role,
            'national_id' => $national_id,
            'avatar' => $avatar,
            'updated_at' => Carbon::now(),
        ];
        if (UserModel::update($user_columns, "id = ?", [$user->id])) {
            User::syncData();
            Session::flash('msg', '<li><span class="msg-success" >Success: </span> The Profile updated Successfully</li>');
            goBack();
        } else {
            Response::error(401);
        }
    }

}
