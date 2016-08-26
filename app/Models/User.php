<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    //put your code here

    public function _role() {
        return $this->belongsTo('App\Models\Role', 'role');
    }

}
