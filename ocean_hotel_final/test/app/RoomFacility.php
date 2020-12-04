<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{

    public function Facility(){
        return $this->belongsTo('App\Facility');
    }
    public function Room(){
        return $this->belongsTo('App\Room');
    }
}
