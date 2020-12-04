<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Post;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;

class PaginationController extends Controller
{
    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $lsRoom = Room::paginate(2);
            return view('Rooms.booking_listroom', compact('lsRoom'))->render();
        }
    }

    function fetch_data_2(Request $request, $booking_id)
    {
        if ($request->ajax()) {
            $booking = Booking::find($booking_id);
            $lsRoom = Room::paginate(2);
            return view('Rooms.booking_listroom_next', compact('lsRoom', 'booking'))->render();
        }
    }

    function fetch_data_list_room_table(Request $request, $room_type_name)
    {
        if ($request->ajax()) {
            if (!$room_type_name) {
                $lsRoom = Room::orderBy('new_price', 'desc')->paginate(1);
            } else {
                $RoomType = RoomType::where('name', 'like', '%' . $room_type_name . '%')->get();
                if (count($RoomType) == 0) {
                    return redirect()->back()->with(['message' => 'Can not find RoomType ' . $room_type_name]);
                } else {
                    $lsRoom = Room::where('room_type_id', '=', $RoomType[0]->id)->orderBy('new_price', 'desc')->paginate(1);
                }

            }
            return view('Rooms.list_room_table', compact('lsRoom', 'room_type_name'))->render();
        }
    }

}
