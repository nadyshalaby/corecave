<?php

namespace App\Http\Controllers;

use App\Classes\User;
use App\Libs\Concretes\Controller;
use Request;
use Response;
use App\Libs\Statics\Session;
use App\Models\SubClientModel;


class SubClientController extends Controller {

    public function insert() {

        $user = User::getData();
        $client = Request::getALlParams(true);
        $avatar = '';
        if (Request::hasFile('avatar')) {
            $avatar = "images/avatars/" . Request::getFile('avatar')->name;
        }

        $client_columns = [
            'user_id' => $user->id,
            'name' => $client->name,
            'tel' => $client->tel,
            'craft' => $client->craft,
            'address' => $client->address,
            'email' => $client->email,
            'avatar' => $avatar,
        ];

        if (SubClientModel::insert($client_columns)) {
            Session::flash('msg', '<li><span class="msg-success" >Success: </span> The Agent created Successfully</li>');
            goBack();
        } else {
            Response::error(401);
        }
    }

    public function delete($id) {
        $client = SubClientModel::id($id);
        if (!empty($client->avatar) && is_file(path('resources/' . $client->avatar))) {
            @unlink(path('resources/' . $client->avatar));
        }     
        Response::json(SubClientModel::delete('id = ?',[$id]));          
    }

}
