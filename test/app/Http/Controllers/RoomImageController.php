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
            $lsRoomImage = RoomImage::paginate(5);
        }else{
            $lsRoom = Room::where('name','like','%'. $name_search .'%')->get();
            foreach ($lsRoom as $item) {
                $lsRoomImage = RoomImage::where('room_id','=',$item->id)->paginate(5);
            }
        }
        return view('RoomImage.list')->with(['lsRoomImage' => $lsRoomImage,'name_search' => $name_search]);
    }
}
