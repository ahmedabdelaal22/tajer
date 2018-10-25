<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_images extends Model {

    public function item_images() {
        return $this->belongsTo('App\Items');
    }

}
