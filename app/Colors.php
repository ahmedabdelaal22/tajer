<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model {

    public function items_colors() {
        return $this->hasMany('App\Items_colors', 'color_id');
    }

}
