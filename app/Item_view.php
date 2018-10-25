<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_view extends Model {

    public function item_view() {
        return $this->belongsTo('App\Items');
    }

}
