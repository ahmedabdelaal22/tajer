<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model {

    public function item_bids() {
        return $this->belongsTo('App\Items');
    }

}
