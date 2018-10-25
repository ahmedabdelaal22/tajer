<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items_sizes extends Model {

    public function item_sizes() {
        return $this->belongsTo('App\Items');
    }

}
