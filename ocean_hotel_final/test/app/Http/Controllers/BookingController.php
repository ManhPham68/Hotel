<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Facility;
use App\Guest;
use App\Room;
use App\RoomBooking;
use App\RoomFacility;
use App\RoomType;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request,$room_id)
    {
        $roombooking = Room::find($room_id);
        $facility = Facility::all();

        $check_in = $request->check_in;
        $check_in__ = strtotime($request->check_in);
        $check_out = $request->check_out;
        $check_out__ = strtotime($request->check_out);

        $bedding = $request->bedding;

        if (!$check_in && !$check_out && !$bedding) {
            $lsRoom = Room::where('number_room', '!=', 0)->paginate(2);
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
            $lsRoom = Room::where('number_room', '!=', 0)->whereNotIn('id', $room_id_not_search)->whereIn('room_type_id', $room_type_id)->paginate(2);
        }
        return view('Rooms.booking', compact('lsRoom', 'check_in', 'bedding', 'check_out', 'roombooking', 'facility'));

    }

    public function index_next(Request $request,$room_id, $old_booking)
    {
        $booking = Booking::find($old_booking);
        $facility = Facility::all();
        $roombooking = Room::find($room_id);

        $check_in = $request->check_in;
        $check_in__ = strtotime($request->check_in);
        $check_out = $request->check_out;
        $check_out__ = strtotime($request->check_out);

        $bedding = $request->bedding;

        if (!$check_in && !$check_out && !$bedding) {
            $lsRoom = Room::where('number_room', '!=', 0)->paginate(2);
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


                if ( (($datediff_check_in > 0 && $datediff_check_out < 0) || ($datediff_check_in == 0 && $datediff_check_out == 0) || ($datediff_check_in_2 < 0 && $datediff_check_out_2 > 0) || ($datediff_check_in_3 < 0 && $datediff_check_out_3 > 0)) && $datediff_today > 0) {
                    $room_id_not_search[] = $item->room_id;
                }
            }
            $room_type = RoomType::where('bedding', '=', $bedding)->get();
            $room_type_id = [];
            foreach ($room_type as $item) {
                $room_type_id[] = $item->id;
            }
            $lsRoom = Room::where('number_room', '!=', 0)->whereNotIn('id', $room_id_not_search)->whereIn('room_type_id', $room_type_id)->paginate(2);
        }
        return view('Rooms.booking_next', compact('lsRoom', 'check_in', 'bedding', 'check_out','booking','facility','roombooking'));
    }

    public function index2(Request $request)
    {
        if (Gate::allows('list_booking')) {
            $room_name = $request->room_name;
            if (!$room_name) {
                $lsBooking = Booking::paginate(10);
            } else {
                $lsRoomName = Room::where('name','like','%' .$room_name.'%')->get();
                $lsRoomName_id = [];
                foreach ($lsRoomName as $item) {
                    $lsRoomName_id[] = $item->id;
                }

                $lsBooking = Booking::whereIn('room_id', $lsRoomName_id)->paginate(10);
            }

            return view('Booking.list')->with(['lsBooking' => $lsBooking, 'room_name' => $room_name]);
        } else {
            abort(403);
        }
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
        $booking->status_guest = 0;
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

        return view('Booking.printer2')->with(['booking' => $booking]);
    }

    public function save2($booking_id, Request $request)
    {
        $booking = Booking::find($booking_id);
        $booking->status_guest = 1;
        $booking->save();
        $facility = Facility::all();

        $check_in = $request->check_in;
        $check_in__ = strtotime($request->check_in);
        $check_out = $request->check_out;
        $check_out__ = strtotime($request->check_out);

        $bedding = $request->bedding;

        if (!$check_in && !$check_out && !$bedding) {
            $lsRoom = Room::where('number_room', '!=', 0)->paginate(2);
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


                if ( (($datediff_check_in > 0 && $datediff_check_out < 0) || ($datediff_check_in == 0 && $datediff_check_out == 0) || ($datediff_check_in_2 < 0 && $datediff_check_out_2 > 0) || ($datediff_check_in_3 < 0 && $datediff_check_out_3 > 0)) && $datediff_today > 0) {
                    $room_id_not_search[] = $item->room_id;
                }
            }
            $room_type = RoomType::where('bedding', '=', $bedding)->get();
            $room_type_id = [];
            foreach ($room_type as $item) {
                $room_type_id[] = $item->id;
            }
            $lsRoom = Room::where('number_room', '!=', 0)->whereNotIn('id', $room_id_not_search)->whereIn('room_type_id', $room_type_id)->paginate(2);
        }
        $request->session()->flash('status', 'Task was successful!');
        return view('Rooms.booking_all', compact('lsRoom', 'check_in', 'bedding', 'check_out','booking','facility'));
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
        if (Gate::allows('delete_booking')) {
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
                    'code' => 200,
                    'message' => 'success'
                ], 200);
            } catch (\Exception $exception) {
                Log::error('Message ' . $exception->getMessage() . ' ----- Line: ' . $exception->getLine());
                return response()->json([
                    'code' => 500,
                    'message' => ' fail'
                ], 500);
            }
        } else {
            abort(403);
        }
    }

    public function confirm($booking_id, Request $request)
    {
        if (Gate::allows('delete_booking')) {
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
        } else {
            abort(403);
        }
    }

    public function confirm_ajax($booking_id, Request $request)
    {
        if (Gate::allows('delete_booking')) {
            try {
                $booking = Booking::find($booking_id);
                $room_isBooked = Room::find($booking->room_id);

                $room_isBooked->number_room = $room_isBooked->number_room - $booking->quantity;

                $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();

                foreach ($room_booking as $item) {
                    $item->status = 1;
                    $item->save();
                }
                $room_isBooked->save();
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], 200);
            } catch (\Exception $exception) {
                Log::error('Message ' . $exception->getMessage() . ' ----- Line: ' . $exception->getLine());
                return response()->json([
                    'code' => 500,
                    'message' => ' fail'
                ], 500);
            }
        } else {
            abort(403);
        }
    }

    public function finish($booking_id, Request $request)
    {
        if (Gate::allows('delete_booking')) {
            $booking = Booking::find($booking_id);
            $room_isBooked = Room::find($booking->room_id);

            $room_isBooked->number_room = $room_isBooked->number_room + $booking->quantity;

            $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();
            foreach ($room_booking as $item) {
                $item->status = 2;
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
        } else {
            abort(403);
        }
    }

    public function finish_ajax($booking_id, Request $request)
    {
        if (Gate::allows('delete_booking')) {
            try {
                $booking = Booking::find($booking_id);
                $room_isBooked = Room::find($booking->room_id);

                $room_isBooked->number_room = $room_isBooked->number_room + $booking->quantity;

                $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();
                foreach ($room_booking as $item) {
                    $item->status = 2;
                    $item->save();
                }
                $room_isBooked->save();

                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], 200);
            } catch (\Exception $exception) {
                Log::error('Message ' . $exception->getMessage() . ' ----- Line: ' . $exception->getLine());
                return response()->json([
                    'code' => 500,
                    'message' => ' fail'
                ], 500);
            }
        } else {
            abort(403);
        }
    }

    public function printer($id, Request $request)
    {
        if (Gate::allows('list_booking')) {
            $booking = Booking::find($id);
            return view('Booking.printer')->with(['booking' => $booking]);
        } else {
            abort(403);
        }
    }

}
