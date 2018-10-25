<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model {

    public function country_Cities() {
        return $this->hasMany('App\Cities', 'country_id');
    }

}
