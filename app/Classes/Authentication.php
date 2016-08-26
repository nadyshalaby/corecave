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

use App\Libs\Statics\Config;
use App\Libs\Statics\Cookie;
use App\Libs\Statics\Hash;
use App\Libs\Statics\Session;
use App\Models\Role;
use App\Models\User;

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
            return Session::put($this->_userSession, User::where('hash', $this->getUser()->hash)->first());
        }
    }

    public function createUser(array $data) {
        $user = new User;

        $user->firstname = array_fetch($data, 'firstname');
        $user->lastname = array_fetch($data, 'lastname');
        $user->email = array_fetch($data, 'email');
        $user->active = array_fetch($data, 'active', 0);
        $user->hash = Hash::unique(30);
        $user->password = Hash::make(array_fetch($data, 'password'));
        $user->role = Role::where('role', array_fetch($data, 'role', 'viewer'))->first()->id;

        $user->saveOrFail();
    }

    public function getUser() {
        return Session::get($this->_userSession);
    }

}
