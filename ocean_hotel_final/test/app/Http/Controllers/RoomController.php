<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Facility;
use App\Guest;
use App\Room;
use App\RoomBooking;
use App\RoomFacility;
use App\RoomImage;
use App\RoomType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('list_room')) {
            $room_type_name = $request->room_type_name;
            if (!$room_type_name) {
                $lsRoom = Room::orderBy('new_price', 'desc')->paginate(5);
            } else {
                $RoomType = RoomType::where('name', 'like', '%' . $room_type_name . '%')->get();
                if (count($RoomType) == 0) {
                    return redirect()->back()->with(['message' => 'Can not find RoomType ' . $room_type_name]);
                } else {
                    $lsRoom = Room::where('room_type_id', '=', $RoomType[0]->id)->orderBy('new_price', 'desc')->paginate(5);
                }

            }
            return view('Rooms.list_room')->with(['lsRoom' => $lsRoom, 'room_type_name' => $room_type_name]);
        } else {
            abort(403);
        }
    }

    public function index1(Request $request)
    {
        if (Gate::allows('list_room')) {
            $room_type_name = $request->room_type_name;
            if (!$room_type_name) {
                $lsRoom = Room::orderBy('new_price', 'desc')->paginate(10);
            } else {
                $RoomType = RoomType::where('name', 'like', '%' . $room_type_name . '%')->get();
                if (count($RoomType) == 0) {
                    return redirect()->back()->with(['message' => 'Can not find RoomType ' . $room_type_name]);
                } else {
                    $lsRoom = Room::where('room_type_id', '=', $RoomType[0]->id)->paginate(3);
                }

            }
            return view('Rooms.list_room')->with(['lsRoom' => $lsRoom]);
        } else {
            abort(403);
        }

    }

    public function index2(Request $request)
    {
        if (Gate::allows('list_room')) {
            $name = $request->name;
            if (!$name) {
                $room_booking_status0 = RoomBooking::where('status', '=', 0)->get();
                $y = [];
                foreach ($room_booking_status0 as $item) {
                    $y[] = $item->booking_id;
                }
                $lsBooking_status0 = Booking::whereIn('id', $y)->orderBy('check_in', 'asc')->paginate(10);
            } else {
                $room_booking_status0 = RoomBooking::where('status', '=', 0)->get();
                $y = [];
                foreach ($room_booking_status0 as $item) {
                    $y[] = $item->booking_id;
                }

                $lsGuest = Guest::where('name', 'like', '%' . $name . '%')->get();
                $lsGuest_id = [];
                foreach ($lsGuest as $item) {
                    $lsGuest_id[] = $item->id;
                }
                $lsBooking_status0 = Booking::whereIn('id', $y)->whereIn('guest_id', $lsGuest_id)->orderBy('check_in', 'asc')->paginate(10);
            }

            return view('Rooms.list_room_booking')->with(['lsBooking_status0' => $lsBooking_status0, 'name' => $name]);
        } else {
            abort(403);
        }
    }

    public function index3(Request $request)
    {
        if (Gate::allows('list_room')) {
            $name = $request->name;
            if (!$name) {
                $room_booking_status1 = RoomBooking::where('status', '=', 1)->get();
                $y = [];
                foreach ($room_booking_status1 as $item) {
                    $y[] = $item->booking_id;
                }
                $lsBooking_status1 = Booking::whereIn('id', $y)->orderBy('check_out', 'asc')->paginate(12);
                // Auto finish status = 2
                foreach ($lsBooking_status1 as $item) {
                    $today = time();
                    $today = date('Y-m-d', $today);
                    $today = strtotime($today);
                    $check_out = strtotime($item->check_out);
                    $datediff = floor($today - $check_out) / (60 * 60 * 24);
                    if ($datediff > 0) {
                        $booking = Booking::find($item->id);
                        $room_isBooked = Room::find($booking->room_id);
                        $room_isBooked->number_room = $room_isBooked->number_room + $booking->quantity;
                        $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();
                        foreach ($room_booking as $item2) {
                            $item2->status = 2;
                            $item2->save();
                        }
                        $room_isBooked->save();
                    }
                }
                $room_booking_status1 = RoomBooking::where('status', '=', 1)->get();
                $y = [];
                foreach ($room_booking_status1 as $item) {
                    $y[] = $item->booking_id;
                }
                $lsBooking_status1 = Booking::whereIn('id', $y)->orderBy('check_out', 'asc')->paginate(12);
            } else {
                $room_booking_status1 = RoomBooking::where('status', '=', 1)->get();
                $y = [];
                foreach ($room_booking_status1 as $item) {
                    $y[] = $item->booking_id;
                }

                $lsGuest = Guest::where('name', 'like', '%' . $name . '%')->get();
                $lsGuest_id = [];
                foreach ($lsGuest as $item) {
                    $lsGuest_id[] = $item->id;
                }
                $lsBooking_status1 = Booking::whereIn('id', $y)->whereIn('guest_id', $lsGuest_id)->orderBy('check_out', 'asc')->paginate(12);
                // Auto finish status = 2
                foreach ($lsBooking_status1 as $item) {
                    $today = time();
                    $today = date('Y-m-d', $today);
                    $today = strtotime($today);
                    $check_out = strtotime($item->check_out);
                    $datediff = floor($today - $check_out) / (60 * 60 * 24);
                    if ($datediff > 0) {
                        $booking = Booking::find($item->id);
                        $room_isBooked = Room::find($booking->room_id);
                        $room_isBooked->number_room = $room_isBooked->number_room + $booking->quantity;
                        $room_booking = RoomBooking::where('booking_id', '=', $booking->id)->get();
                        foreach ($room_booking as $item2) {
                            $item2->status = 2;
                            $item2->save();
                        }
                        $room_isBooked->save();
                    }
                }
                $room_booking_status1 = RoomBooking::where('status', '=', 1)->get();
                $y = [];
                foreach ($room_booking_status1 as $item) {
                    $y[] = $item->booking_id;
                }

                $lsGuest = Guest::where('name', 'like', '%' . $name . '%')->get();
                $lsGuest_id = [];
                foreach ($lsGuest as $item) {
                    $lsGuest_id[] = $item->id;
                }
                $lsBooking_status1 = Booking::whereIn('id', $y)->whereIn('guest_id', $lsGuest_id)->orderBy('check_out', 'asc')->paginate(12);
            }

            return view('Rooms.list_room_booked')->with(['lsBooking_status1' => $lsBooking_status1, 'name' => $name]);
        } else {
            abort(403);
        }
    }

    public function index4(Request $request)
    {
        if (Gate::allows('list_room')) {
            $name = $request->name;
            if (!$name) {
                $room_booking_status2 = RoomBooking::where('status', '=', 2)->get();
                $y = [];
                foreach ($room_booking_status2 as $item) {
                    $y[] = $item->booking_id;
                }
                $lsBooking_status2 = Booking::whereIn('id', $y)->orderBy('check_out', 'asc')->paginate(12);
            } else {
                $room_booking_status2 = RoomBooking::where('status', '=', 2)->get();
                $y = [];
                foreach ($room_booking_status2 as $item) {
                    $y[] = $item->booking_id;
                }

                $lsGuest = Guest::where('name', 'like', '%' . $name . '%')->get();
                $lsGuest_id = [];
                foreach ($lsGuest as $item) {
                    $lsGuest_id[] = $item->id;
                }
                $lsBooking_status2 = Booking::whereIn('id', $y)->whereIn('guest_id', $lsGuest_id)->orderBy('check_out', 'asc')->paginate(12);
            }
            return view('Rooms.list_room_finished')->with(['lsBooking_status2' => $lsBooking_status2]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('add_room')) {
            $room_type = RoomType::all();
            $facility = Facility::all();
            return view('Rooms.add')->with(['room_type' => $room_type, 'facility' => $facility]);
        } else {
            abort(403);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('add_room')) {
            $room = new Room();
            $room->name = $request->name;

            $roomtype = RoomType::find($request->room_type);

            $room->room_type_id = $roomtype['id'];

            $room->new_price = $request->new_price;
            $room->old_price = $request->old_price;

            $room->rating = $request->rating;

            $path = '';
            if ($request->feature_image != null) {
                $name = $request->feature_image->getClientOriginalName();
                $name = time() . "." . $name;
                $request->feature_image->move(public_path('upload'), $name);
                $path = 'upload/' . $name;
                $room->feature_image = $path;
            }

            $room->description = $request->description;

            $room->number_room = $request->number_room;
            $room->comment_id = $request->comment_id;
            $room->save();
            if ($request->image != null) {
                foreach ($request->image as $item) {
                    $room_image = new RoomImage();
                    $path2 = '';
                    $name2 = $item->getClientOriginalName();
                    $name2 = time() . "." . $name2;
                    $item->move(public_path('upload'), $name2);
                    $path2 = 'upload/' . $name2;
                    $room_image->image = $path2;
                    $room_image->room_id = $room->id;
                    $room_image->save();
                }
            }
            if ($request->facilities) {
                foreach ($request->facilities as $item) {
                    $room_facility = new RoomFacility();
                    $room_facility->room_id = $room->id;
                    $room_facility->facility_id = $item;
                    $room_facility->save();
                }
            } else {

            }
            $request->session()->flash('success', 'Create successfully');
            return redirect('Rooms');
        } else {
            abort(403);
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('edit_room')) {
            $room = Room::find($id);
            $room_image = RoomImage::where('room_id', '=', $room->id)->get();

            $room_type_selected = RoomType::find($room->room_type_id);
            $room_type = RoomType::all();
            $facility = Facility::all();
            return view('Rooms.edit')->with(['room' => $room, 'room_type' => $room_type, 'room_type_selected' => $room_type_selected, 'facility' => $facility, 'room_image' => $room_image]);
        } else {
            abort(403);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('edit_room')) {
            $room = Room::find($id);
            $room->name = $request->name;

            $roomtype = RoomType::find($request->room_type);
            $room->room_type_id = $roomtype->id;

            $room->new_price = $request->new_price;
            $room->old_price = $request->old_price;

            $room->rating = $request->rating;

            $path = '';
            if ($request->feature_image != null) {
                $name = $request->feature_image->getClientOriginalExtension();
                $name = time() . "." . $name;
                $request->feature_image->move(public_path('upload'), $name);
                $path = 'upload/' . $name;
                $room->feature_image = $path;
            } else {
                $room->feature_image = $room->feature_image;
            }

            $room->description = $request->description;
            $room->number_room = $request->number_room;
            $room->comment_id = $request->comment_id;
            $room->save();

            if ($request->image != null) {
                $room_image_old = RoomImage::where('room_id', '=', $room->id)->get();
                foreach ($room_image_old as $item) {
                    $item->delete();
                }
                foreach ($request->file('image') as $item) {
                    $room_image = new RoomImage();
                    $path2 = '';
                    $name2 = $item->getClientOriginalName();
                    $name2 = time() . "." . $name2;
                    $item->move(public_path('upload'), $name2);
                    $path2 = 'upload/' . $name2;
                    $room_image->image = $path2;
                    $room_image->room_id = $room->id;
                    $room_image->save();
                }
            } else {
                $room_image_old = RoomImage::where('room_id', '=', $room->id)->get();
                foreach ($room_image_old as $item) {
                    $item->image = $item->image;
                }
            }

            $room_facility_selected = RoomFacility::where('room_id', '=', $room->id)->get();
            foreach ($room_facility_selected as $item) {
                $item->delete();
            }

            foreach ($request->facilities as $item) {
                $room_facility = new RoomFacility();
                $room_facility->room_id = $room->id;
                $room_facility->facility_id = $item;
                $room_facility->save();
            }

            $request->session()->flash('success', 'Update successfully');
            return redirect('Rooms');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $room = Room::find($id);
        $room_image = RoomImage::where('room_id', '=', $room->id)->get();
        foreach ($room_image as $item) {
            $item->delete();
        }
        $room->delete();
        $request->session()->flash('success', 'Delete successfully');
        return redirect('Rooms');
    }

    public function destroy_ajax($id, Request $request)
    {
        if (Gate::allows('delete_room')) {
            try {
                $room = Room::find($id);
                $room_image = RoomImage::where('room_id', '=', $room->id)->get();
                foreach ($room_image as $item) {
                    $item->delete();
                }
                $roomfaciliti = RoomFacility::where('room_id','=',$room->id)->get();
                foreach ($roomfaciliti as $item) {
                    $item->delete();
                }
                $room->delete();
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

}
