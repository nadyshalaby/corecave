<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    //put your code here

    public function _role() {
        return $this->hasMany('App\Models\User', 'role');
    }

}
