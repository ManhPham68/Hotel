<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;
class RoomType extends Model
{
    public function Rooms(){
        return $this->hasMany('App\Room','room_id','id');
    }
}
