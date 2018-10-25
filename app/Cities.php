<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model {

    public function orders() {
        return $this->hasMany('App\Orders', 'cities_id');
    }

    public function items() {
        return $this->hasMany('App\Items', 'cities_id');
    }

    public function user() {
        return $this->hasMany('App\User', 'cities_id');
    }

    public function country() {
        return $this->belongsTo('App\Countries');
    }

}
