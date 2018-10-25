<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_orders() {
        return $this->hasMany('App\Orders', 'user_id');
    }

    public function user_items() {
        return $this->hasMany('App\Items', 'user_id');
    }

    
     public function address() {
        return $this->hasMany('App\Address', 'user_id');
    }

    public function user_reviews() {
        return $this->hasMany('App\Reviews', 'user_id');
    }

    public function cities() {
        return $this->belongsTo('App\Cities');
    }
       public function region() {
        return $this->belongsTo('App\Region','region_id');
    }

//    public function country() {
//        return $this->belongsTo('App\Countries');
//    }

    public function generateToken() {
        $sess_locale = session()->get('email');
        $this->remember_token = str_random(60);
        DB::table('users')->where('email', '=', $sess_locale)->update(['remember_token' => $this->remember_token]);

        return $this->remember_token;
    }

    public function scopeGetAdminTypes() {
        $types = [
            '1' => 'Admin',
            '2' => 'Trader',
            '3' => 'Client',
        ];
        return $types;
    }

    public function scopeGetPaymentMethods() {
        $payment_mthod = [
            '1' => 'Visa',
            '2' => 'Cash',
        ];
        return $payment_mthod;
    }

    public function scopeGetAutctionTypes() {
        $payment_mthod = [
            '2' => trans('cpanel.Fixex_price'),
            '1' => trans('cpanel.Autction'),
        ];
        return $payment_mthod;
    }

    /**
     * @return user role
     * */
    public function scopeGetRole() {
        return auth()->user()->permissions;
    }

    public function scopeGetid() {
        return auth()->user()->id;
    }

    /**
     * compare user role ans given role
     * @param userRole, role
     * @return user role
     * */
    static function hasRole($role) {

        if (auth()->user()->permissions == $role) {
            return true;
        } else {
            return false;
        }
    }

    static function hasRole1($role) {

        if (auth()->user()->type == $role) {
            return true;
        } else {
            return false;
        }
    }

}
