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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index($room_id)
    {
        $roombooking = Room::find($room_id);
        $facility = Facility::all();
        return view('Rooms.booking')->with(['roombooking' => $roombooking, 'facility' => $facility]);
    }

    public function index2(Request $request)
    {
        $room_id = $request->room_id;
        if (!$room_id) {
            $lsBooking = Booking::paginate(10);
        } else {
            $lsBooking = Booking::where('room_id', '=', $room_id)->paginate(10);
        }

        return view('Booking.list')->with(['lsBooking' => $lsBooking, 'room_id' => $room_id]);
    }

    public function save(Request $request, $room_id)
    {
        $room_isBooked = Room::find($room_id);
        $facility_isBooked = $request->facilities;
        $total_cost_facility = 0;
        foreach ($facility_isBooked as $item) {
            $facility_id = Facility::find($item);
            if ($facility_id->type != 0) {
                $total_cost_facility += $facility_id->price;
            }
        }

        $room_facility_old = RoomFacility::where('room_id', '=', $room_id)->get();
        foreach ($room_facility_old as $item) {
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
        if ($request->quantity <= $room_isBooked->number_room) {
            $booking->quantity = $request->quantity;
        } else {
            return redirect()->back()->with(['message' => 'The number roombooking passes the openning room which we have !']);
        }

        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->save();

        $room_booking = new RoomBooking();
        $room_booking->booking_id = $booking->id;

        $date1 = new DateTime($request->check_in);
        $date2 = new DateTime($request->check_out);
        $interval = $date1->diff($date2);

        $total_cost = $request->quantity * ($room_isBooked->new_price + $total_cost_facility) * $interval->d;
        $room_booking->total_cost = $total_cost;
        $room_booking->status = 0;
        $room_booking->save();
        $request->session()->flash('success', 'Booking successful');

        Mail::send('emails.announce_booking',
            [
                'title' => $request->title,
                'name' => $request->name,
                'booking' => $booking

            ],
            function ($message) use ($request) {
                $message->from('huyducle1109@gmail.com', 'Ocean Hotel');
                $message->to($request->email, $request->name);
                $message->subject('Booking Room is finished');
            });
        $request->session()->flash('success', 'Book Room successfully');
        return redirect('Rooms');
    }

    public function destroy($id, Request $request)
    {
        $booking = Booking::find($id);
        $guest_id = $booking->guest_id;
        $guest = Guest::find($guest_id);
        $room_booking = RoomBooking::where('booking_id', '=', $id)->get();
        foreach ($room_booking as $item) {
            $item->delete();
        }
        $booking->delete();
        $request->session()->flash('success', 'Delete successfully');
        return redirect('Rooms');
    }

    public function destroy_ajax($id, Request $request)
    {
        try {
            $booking = Booking::find($id);
            $guest_id = $booking->guest_id;
            $guest = Guest::find($guest_id);
            $room_booking = RoomBooking::where('booking_id', '=', $id)->get();
            foreach ($room_booking as $item) {
                $item->delete();
            }
            $booking->delete();
            return response()->json([
                'code'=> 200,
                'message'=> 'success'
            ],200);
        }catch (\Exception $exception){
            Log::error('Message ' .$exception->getMessage() . ' ----- Line: ' . $exception->getLine());
            return response()->json([
                'code'=> 500,
                'message'=>' fail'
            ],500);
        }
    }

    public function confirm($booking_id, Request $request)
    {
        $booking = Booking::find($booking_id);
        $room_isBooked = Room::find($booking->room_id);

        $room_isBooked->number_room = $room_isBooked->number_room - $booking->quantity;

        $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();

        foreach ($room_booking as $item) {
            $item->status = 1;
        }
        $room_booking[0]->save();
        $room_isBooked->save();
        $request->session()->flash('success', 'Confirm successfully');
        return redirect('Rooms');
    }

    public function finish($booking_id, Request $request)
    {
        $booking = Booking::find($booking_id);
        $room_isBooked = Room::find($booking->room_id);

        $room_isBooked->number_room = $room_isBooked->number_room + $booking->quantity;

        $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();
        foreach ($room_booking as $item) {
            $item->status = 0;
            $item->save();
        }
        $room_isBooked->save();

        $guest_id = $booking->guest_id;
        $guest = Guest::find($guest_id);
        $room_booking = RoomBooking::where('booking_id', '=', $booking_id)->get();
        foreach ($room_booking as $item) {
            $item->delete();
        }
        $booking->delete();

        $request->session()->flash('success', 'Finish successfully');
        return redirect('Rooms');
    }
    public function finish_ajax($booking_id, Request $request)
    {
        try {
            $booking = Booking::find($booking_id);
            $room_isBooked = Room::find($booking->room_id);

            $room_isBooked->number_room = $room_isBooked->number_room + $booking->quantity;

            $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();
            foreach ($room_booking as $item) {
                $item->status = 0;
                $item->save();
            }
            $room_isBooked->save();

            $guest_id = $booking->guest_id;
            $guest = Guest::find($guest_id);
            $room_booking = RoomBooking::where('booking_id', '=', $booking_id)->get();
            foreach ($room_booking as $item) {
                $item->delete();
            }
            $booking->delete();

            return response()->json([
                'code'=> 200,
                'message'=> 'success'
            ],200);
        }catch (\Exception $exception){
            Log::error('Message ' .$exception->getMessage() . ' ----- Line: ' . $exception->getLine());
            return response()->json([
                'code'=> 500,
                'message'=>' fail'
            ],500);
        }
    }

    public function printer($id, Request $request)
    {
        $booking = Booking::find($id);
        return view('Booking.printer')->with(['booking' => $booking]);
    }

}
