<?php

namespace App\Http\Controllers\Admin;

use App\Libs\Concretes\Controller;
use App\Libs\Concretes\Request;
use App\Libs\Statics\Hash;
use Auth;

class ProfileController extends Controller {

    public function index() {
        $user = Auth::getUser();
        return _twig('admin/pages/profile.html', compact('user'));
    }

    public function logout() {
        Auth::logout();
        _redirect(_route('site.english'));
    }

    public function update(Request $r) {

        if (Auth::valid($r->getParam('email'), $r->getParam('pass'))) {

            $pass = $r->hasParam('newpass') ? Hash::make($r->getParam('newpass')) : Auth::getUser()->password;
            $user = [
                "fullname" => $r->getParam('fullname'),
                "tel" => $r->getParam('tel'),
                "mobile" => $r->getParam('mobile'),
                "address" => $r->getParam('address'),
                "email" => $r->getParam('email'),
                "gender" => $r->getParam('gender'),
                "password" => $pass,
            ];

            if (Auth::updateUser($user)) {
                __flash('success', 'Your profile successfully updated');
            } else {
                __flash('warning', 'Your profile not updated');
            }
        } else {
            __flash("error", 'Password is incorrect');
        }
        _goBack();
    }

}
