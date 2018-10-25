<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    public function items() {
        return $this->hasMany('App\Items', 'categories_id');
    }

    public function sub_categories() {
        return $this->hasMany('App\Sub_categories', 'categories_id');
    }

    public function orders_details() {
        return $this->hasMany('App\Orders_details', 'categories_id');
    }

}
