<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model {

    public function sub_categories() {
        return $this->belongsTo('App\Sub_categories');
    }

    public function items_images() {
        return $this->hasMany('App\Item_images', 'items_id');
    }

    public function items_views() {
        return $this->hasMany('App\Item_view', 'items_id');
    }

    public function items_wishlist() {
        return $this->hasMany('App\Wishlist', 'items_id');
    }

    public function items_reviews() {
        return $this->hasMany('App\Reviews', 'items_id');
    }

    public function brands() {
        return $this->belongsTo('App\Brands');
    }

    public function cities() {
        return $this->belongsTo('App\Cities');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function items_sizes() {
        return $this->hasMany('App\Items_sizes', 'item_id');
    }

    public function Item_specifications() {
        return $this->hasMany('App\Item_specifications', 'item_id');
    }
        public function items_colors() {
        return $this->hasMany('App\Items_colors', 'item_id');
    }
   public function Accessories() {
        return $this->hasMany('App\Accessories', 'parent_id');
    }
}
