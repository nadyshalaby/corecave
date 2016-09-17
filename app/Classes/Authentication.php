<?php

/**
 * This file is part of kodekit framework
 * 
 * @copyright (c) 2015-2016, nady shalaby
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Classes;

use App\Core\Http\Bags\Cookies\Cookie;
use App\Core\Http\Bags\Sessions\Session;
use App\Core\Support\Config;
use App\Core\Support\Hash;
use App\Models\User;
;

class Authentication {

    private $_rememberCookie = '',
            $_userSession = '';

    public function __construct() {
        $this->_rememberCookie = Config::extra('cookie.remember_me');
        $this->_userSession = Config::extra('session.user_data');
    }

    public function login($email, $password, $remember = false) {
        // check if the user exists
        $user = User::where('email', $email)->first();

        if ($user && Hash::match($password, $user->password)) {
            Session::put($this->_userSession, $user);
            if ($remember) {
                Cookie::put($this->_rememberCookie, $user->hash, Config::extra('cookie.remember_me_expiry'));
            }
            return TRUE;
        }
        return FALSE;
    }

    public function valid($email, $password) {
        // check if the user exists
        $user = User::where('email', $email)->first();
        if ($user && Hash::match($password, $user->password)) {
            return TRUE;
        }
        return FALSE;
    }

    public function alive() {
        if (Session::has($this->_userSession)) {
            return true;
        } else if (Cookie::has($this->_rememberCookie)) {
            Session::put($this->_userSession, User::where('hash', Cookie::get($this->_rememberCookie))->first());
            Cookie::put($this->_rememberCookie, Cookie::get($this->_rememberCookie), Config::extra('cookie.remember_me_expiry'));
            return true;
        }
        return false;
    }

    public function logout() {
        Cookie::delete($this->_rememberCookie);
        Session::delete($this->_userSession);
    }

    public function getHash() {
        if ($this->alive()) {
            return $this->getUser()->hash;
        }
        return null;
    }

    public function getRole($numeric = false) {
        if ($this->alive()) {
            return $numeric ? $this->getUser()->role : $this->getUser()->_role->role;
        }
        return -1;
    }

    public function hasRole($role) {
        if ($this->alive()) {
            return $role === $this->getUser()->_role->role;
        }
        return false;
    }

    public function syncUser() {
        if ($this->alive()) {
            $user = Session::pull($this->_userSession);
            Session::put($this->_userSession, User::where('hash', $user->hash)->first());
            return true;
        }else{
            return false;
        }
    }

    public function createUser(array $data) {
        $user = new User;
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser(array $data) {
        if ($this->alive()) {
            $user = User::find($this->getUser()->id);
            foreach ($data as $key => $value) {
                $user->{"$key"} = $value;
            }
            if ($user->save()) {
                $this->syncUser();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUser() {
        if ($this->alive()) {
            return Session::get($this->_userSession);
        }
        return null;
    }

}
