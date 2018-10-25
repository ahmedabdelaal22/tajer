<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

   protected $table = 'addresses';


    public function user() {
        return $this->hasMany('App\User', 'user_id');
    }
    
    

     public function region() {
        return $this->belongsTo('App\Region');
    }

}
