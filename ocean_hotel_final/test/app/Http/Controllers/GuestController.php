<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Guest;
use App\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        if (Gate::allows('list_guest')) {
            $Guest_id_not_search = [];
            $name = $request->name;
            $lsGuest_all = Guest::all();
            for ($i = 0; $i < count($lsGuest_all); $i++) {
                for ($j = $i + 1; $j < count($lsGuest_all); $j++) {
                    if ((($lsGuest_all[$i]->name == $lsGuest_all[$j]->name)) && (($lsGuest_all[$i]->email == $lsGuest_all[$j]->email))) {
                        $Guest_id_not_search[] = $lsGuest_all[$j]->id;
                    }
                }
            }
            if ($request->name == null) {
                $lsGuest = Guest::whereNotIn('id', $Guest_id_not_search)->paginate(10);
            } else {
                $lsGuest = Guest::where('name', 'like', '%' . $name . '%')->whereNotIn('id', $Guest_id_not_search)->paginate(10);
            }
            return view('Guest.index')->with(['lsGuest' => $lsGuest, 'name' => $name]);
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
        if (Gate::allows('edit_guest')) {
            $guest = Guest::find($id);
            return view('Guest.edit', compact('guest'));
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
        if (Gate::allows('edit_guest')) {
            $guest = Guest::find($id);
            $guest->title = $request->title;
            $guest->name = $request->name;
            $guest->age = $request->age;
            $guest->address = $request->address;
            $guest->telephone = $request->telephone;
            $guest->email = $request->email;
            $guest->country = $request->country;
            if (!$request->comment){
                $guest->comments = null;
            }else{
                $guest->comments = $request->comment;
            }
            if (!$request->avatar){
                $guest->avatar = null;
            }else{
                $path = '';
                $name = $request->avatar->getClientOriginalName();
                $name = time() . "." . $name;
                $request->avatar->move(public_path('upload'), $name);
                $path = 'upload/' . $name;
                $guest->avatar = $path;
            }
            if (!$request->rating){
                $guest->rating = null;
            }else{
                $guest->rating = $request->rating;
            }
            $guest->save();
            return redirect('Guest');
        } else {
            abort(403);
        }
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
    }

    public function destroy_ajax($id, Request $request)
    {
        if (Gate::allows('delete_guest')) {
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
