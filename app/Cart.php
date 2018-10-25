<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

  

  
    public function items() {
        return $this->belongsTo('App\Items');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
