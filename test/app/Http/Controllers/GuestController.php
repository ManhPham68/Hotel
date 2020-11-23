<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Guest;
use App\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $name = $request->name;
        if ($request->name == null) {
            $lsGuest = Guest::paginate(10);
        } else {
            $lsGuest = Guest::where('name', 'like', '%' . $name . '%')->paginate(10);
        }
        return view('Guest.index')->with(['lsGuest' => $lsGuest, 'name' => $name]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        try {
            $guest = Guest::find($id);
            $booking = Booking::where('guest_id', '=', $id)->get();
            foreach ($booking as $item) {
                $item->delete();
                $room_booking = RoomBooking::where('booking_id', '=', $item->id)->get();
                foreach ($room_booking as $item) {
                    $item->delete();
                }
            }
            $guest->delete();
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
    public function destroy_ajax($id, Request $request)
    {
        try {
            $guest = Guest::find($id);
            $booking = Booking::where('guest_id', '=', $id)->get();
            foreach ($booking as $item) {
                $item->delete();
                $room_booking = RoomBooking::where('booking_id', '=', $item->id)->get();
                foreach ($room_booking as $item) {
                    $item->delete();
                }
            }
            $guest->delete();
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
}
