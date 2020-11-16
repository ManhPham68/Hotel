<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomImage;
use Illuminate\Http\Request;

class RoomImageController extends Controller
{

    public function index(Request $request)
    {
        $name_search = $request->name_search;
        if (!$name_search){
            $lsRoomImage = RoomImage::paginate(3);
        }else{
            $lsRoomImage = RoomImage::where('room_id','=',$name_search)->paginate(3);
        }
        return view('RoomImage.list')->with(['lsRoomImage' => $lsRoomImage,'name_search' => $name_search]);
    }
}
