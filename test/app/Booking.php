<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function Guest(){
        return $this->belongsTo('App\Guest');
    }
    public function Room(){
        return $this->belongsTo('App\Room');
    }
    public function RoomBooking(){
        return $this->hasOne('App\RoomBooking');
    }
}
