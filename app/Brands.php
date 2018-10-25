<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
        public function sub_brand_items() {
        return $this->hasMany('App\Items', 'brands_id');
    }
}
