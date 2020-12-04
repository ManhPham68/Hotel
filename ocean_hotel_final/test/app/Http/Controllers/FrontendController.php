<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Facility;
use App\Guest;
use App\Room;
use App\RoomType;
use App\Slider;
use App\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $lsSlider = Slider::all();
        $special_slider = Slider::where('id', '=', 2)->get();
        $MASTERBEDROOMS = Facility::where('name', '=', 'MASTER BEDROOMS')->get();
        $SEAVIEWBALCONY = Facility::where('name', '=', 'SEA VIEW BALCONY')->get();
        $LARGECAFE = Facility::where('name', '=', 'LARGE CAFE')->get();
        $WIFICOVERAGE = Facility::where('name', '=', 'WIFI COVERAGE')->get();
        $lsRoom = Room::orderBy('new_price', 'desc')->paginate(4);
        $lsFacility = Facility::paginate(6);
        $lsUser = User::all();

        $Guest_id_not_search = [];
        $lsGuest_all = Guest::all();
        for ($i = 0; $i < count($lsGuest_all); $i++) {
            for ($j = $i + 1; $j < count($lsGuest_all); $j++) {
                if ((($lsGuest_all[$i]->name == $lsGuest_all[$j]->name)) && (($lsGuest_all[$i]->email == $lsGuest_all[$j]->email))) {
                    $Guest_id_not_search[] = $lsGuest_all[$j]->id;
                }
            }
        }
        $lsGuest = Guest::whereNotIn('id', $Guest_id_not_search)->paginate(4);

        return view('welcome', compact('lsSlider', 'special_slider', 'MASTERBEDROOMS', 'SEAVIEWBALCONY', 'LARGECAFE', 'WIFICOVERAGE', 'lsRoom', 'lsUser', 'lsFacility', 'lsGuest'));
    }

    public function room_detail($room_id)
    {
        $lsFacility = Facility::all();
        $room = Room::find($room_id);
        return view('Rooms.Room_detail', compact('room','lsFacility'));
    }

    public function lsRoom_index_frontend(Request $request)
    {
        $check_in = $request->check_in;
        $check_in__ = strtotime($request->check_in);
        $check_out = $request->check_out;
        $check_out__ = strtotime($request->check_out);

        $bedding = $request->bedding;

        if (!$check_in && !$check_out && !$bedding) {
            $lsRoom = Room::where('number_room', '!=', 0)->paginate(5);
        } else if ($check_in != null && $check_out != null && $bedding != null) {
            $allBooking = Booking::all();
            $room_id_not_search = [];
            foreach ($allBooking as $item) {
                $today = today();
                $today__ = strtotime($today);

                $check_in_of_booking__ = strtotime($item->check_in);
                $check_out_of_booking__ = strtotime($item->check_out);

                $datediff_today = floor($check_in_of_booking__ - $today__) / (60 * 60 * 24);

                $datediff_check_in = floor($check_in__ - $check_in_of_booking__) / (60 * 60 * 24);
                $datediff_check_out = floor($check_out__ - $check_out_of_booking__) / (60 * 60 * 24);

                $datediff_check_in_2 = floor($check_in__ - $check_out_of_booking__) / (60 * 60 * 24);
                $datediff_check_out_2 = floor($check_out__ - $check_out_of_booking__) / (60 * 60 * 24);

                $datediff_check_in_3 = floor($check_in__ - $check_in_of_booking__) / (60 * 60 * 24);
                $datediff_check_out_3 = floor($check_out__ - $check_in_of_booking__) / (60 * 60 * 24);


                if ((($datediff_check_in > 0 && $datediff_check_out < 0) || ($datediff_check_in == 0 && $datediff_check_out == 0) || ($datediff_check_in_2 < 0 && $datediff_check_out_2 > 0) || ($datediff_check_in_3 < 0 && $datediff_check_out_3 > 0)) && $datediff_today > 0) {
                    $room_id_not_search[] = $item->room_id;
                }
            }
            $room_type = RoomType::where('bedding', '=', $bedding)->get();
            $room_type_id = [];
            foreach ($room_type as $item) {
                $room_type_id[] = $item->id;
            }
            $lsRoom = Room::where('number_room', '!=', 0)->whereNotIn('id', $room_id_not_search)->whereIn('room_type_id', $room_type_id)->paginate(5);
        }
        return view('Room_index_frontend', compact('lsRoom', 'check_in', 'bedding', 'check_out'));

    }

    public function lsRoom_index_frontend2(Request $request)
    {
        $lsFacility = Facility::all();
        $check_in = $request->check_in;
        $check_in__ = strtotime($request->check_in);
        $check_out = $request->check_out;
        $check_out__ = strtotime($request->check_out);

        $bedding = $request->bedding;

        if (!$check_in && !$check_out && !$bedding) {
            $lsRoom = Room::paginate(9);
        } else if ($check_in != null && $check_out != null && $bedding != null) {
            $allBooking = Booking::all();
            $room_id_not_search = [];
            foreach ($allBooking as $item) {
                $today = today();
                $today__ = strtotime($today);

                $check_in_of_booking__ = strtotime($item->check_in);
                $check_out_of_booking__ = strtotime($item->check_out);

                $datediff_today = floor($check_in_of_booking__ - $today__) / (60 * 60 * 24);

                $datediff_check_in = floor($check_in__ - $check_in_of_booking__) / (60 * 60 * 24);
                $datediff_check_out = floor($check_out__ - $check_out_of_booking__) / (60 * 60 * 24);

                $datediff_check_in_2 = floor($check_in__ - $check_out_of_booking__) / (60 * 60 * 24);
                $datediff_check_out_2 = floor($check_out__ - $check_out_of_booking__) / (60 * 60 * 24);

                $datediff_check_in_3 = floor($check_in__ - $check_in_of_booking__) / (60 * 60 * 24);
                $datediff_check_out_3 = floor($check_out__ - $check_in_of_booking__) / (60 * 60 * 24);


                if ((($datediff_check_in > 0 && $datediff_check_out < 0) || ($datediff_check_in == 0 && $datediff_check_out == 0) || ($datediff_check_in_2 < 0 && $datediff_check_out_2 > 0) || ($datediff_check_in_3 < 0 && $datediff_check_out_3 > 0)) && $datediff_today > 0) {
                    $room_id_not_search[] = $item->room_id;
                }
            }
            $room_type = RoomType::where('bedding', '=', $bedding)->get();
            $room_type_id = [];
            foreach ($room_type as $item) {
                $room_type_id[] = $item->id;
            }
            $lsRoom = Room::whereNotIn('id', $room_id_not_search)->whereIn('room_type_id', $room_type_id)->paginate(9);
        }
        return view('Room_index_frontend2', compact('lsRoom', 'check_in', 'bedding', 'check_out', 'lsFacility'));

    }

}
