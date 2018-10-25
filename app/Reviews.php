<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model {

    public function item_reviews() {
        return $this->belongsTo('App\Items');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
