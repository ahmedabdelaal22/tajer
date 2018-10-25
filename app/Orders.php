<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {


    public function address() {
        return $this->belongsTo('App\Address', 'address_id');
    }
}
