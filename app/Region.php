<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    public function orders() {
        return $this->hasMany('App\Orders', 'cities_id');
    }


    public function user() {
        return $this->hasMany('App\User', 'region_id');
    }

    public function cities() {
        return $this->belongsTo('App\Cities','city_id');
    }

    public function country() {
        return $this->belongsTo('App\Countries');
    }

}
