<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RoomType;
class Room extends Model
{
    public function RoomType(){
        return $this->belongsTo('App\RoomType','room_type_id','id');
    }
    public function RoomImage(){
        return $this->hasMany('App\RoomImage','room_id','id');
    }
}
