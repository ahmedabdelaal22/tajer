<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_categories extends Model {

    public function Categories() {
        return $this->belongsTo('App\Categories');
    }

     public function sub_cat_items() {
        return $this->hasMany('App\Items', 'sub_categories_id');
    }


}
