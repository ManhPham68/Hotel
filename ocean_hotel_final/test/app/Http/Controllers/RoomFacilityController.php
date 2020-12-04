<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('list_RoomFacility')){
            $room_name = $request->room_name;
            if (!$room_name) {
                $lsRoom_facility = RoomFacility::paginate(10);
            }else{
                $lsRoom = Room::where('name','like','%' .$room_name.'%')->get();
                $lsRoom_id = [];
                foreach ($lsRoom as $item) {
                    $lsRoom_id[] = $item->id;
                }
                $lsRoom_facility = RoomFacility::whereIn('room_id',$lsRoom_id)->paginate(10);
            }
            return view('RoomFacility.list')->with(['lsRoom_facility' => $lsRoom_facility,'room_name'=>$room_name]);
        }else{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
