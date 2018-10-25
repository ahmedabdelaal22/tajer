<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model {

    public function items() {
        return $this->belongsTo('App\Items', 'item_id');

    }

   

}
