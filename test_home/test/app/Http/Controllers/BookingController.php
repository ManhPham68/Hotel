<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Facility;
use App\Guest;
use App\Room;
use App\RoomBooking;
use App\RoomFacility;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Date;

class BookingController extends Controller
{
    public function index($room_id)
    {
        $roombooking = Room::find($room_id);
        $facility = Facility::all();
        return view('Rooms.booking')->with(['roombooking' => $roombooking, 'facility' => $facility]);
    }

    public function save(Request $request, $room_id)
    {

        $room_isBooked = Room::find($room_id);
        $facility_isBooked = $request->facilities;
        $total_cost_facility = 0;
        foreach ($facility_isBooked as $item) {
            $facility_id = Facility::find($item);
            if ($facility_id->type != 0){
                $total_cost_facility += $facility_id->price;
            }
        }

        $room_facility_old = RoomFacility::where('room_id','=',$room_id)->get();
        foreach ($room_facility_old as $item){
            $item->delete();
        }
        foreach ($request->facilities as $item) {
            $room_facility = new RoomFacility();
            $room_facility->room_id = $room_id;
            $room_facility->facility_id = $item;
            $room_facility->save();
        }
        $guest = new Guest();
        $guest->title = $request->title;
        $guest->name = $request->name;
        $guest->age = $request->age;
        $guest->address = $request->address;
        $guest->telephone = $request->telephone;
        $guest->email = $request->email;
        $guest->country = $request->country;
        $guest->save();

        $booking = new Booking();
        $booking->room_id = $room_id;
        $booking->guest_id = $guest->id;
        $booking->quantity = $request->quantity;
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->save();

        $room_booking = new RoomBooking();
        $room_booking->booking_id = $booking->id;

        $date1 = new DateTime($request->check_in);
        $date2 = new DateTime($request->check_out);
        $interval = $date1->diff($date2);

        $total_cost = $request->quantity * ($room_isBooked->new_price+$total_cost_facility) * $interval->d;
        $room_booking->total_cost = $total_cost;
        $room_booking->status = 0;
        $room_booking->save();
        return redirect('Guests');
    }
}
