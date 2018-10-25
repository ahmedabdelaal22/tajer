<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
       public function User() {
        return $this->belongsTo('App\User','sender_id');
    }
          public function Items() {
        return $this->belongsTo('App\Items','items_id');
    }
              public function Bids() {
        return $this->belongsTo('App\Bids','items_id','items_id');
    }

}
