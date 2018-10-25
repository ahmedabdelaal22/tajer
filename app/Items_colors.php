<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items_colors extends Model {

    public function items() {
        return $this->belongsTo('App\Items');
    }

    public function colors() {
     
    return $this->belongsTo('App\Colors', 'color_id');

    }

}
