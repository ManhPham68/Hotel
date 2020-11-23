<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = [];

    public function Booking(){
        return $this->hasMany('App\Booking');
    }
}
