<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Facility;
use App\Room;
use App\RoomBooking;
use App\RoomFacility;
use App\RoomImage;
use App\RoomType;
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
        $room_type_name = $request->room_type_name;
        if (!$room_type_name){
            $lsRoom = Room::paginate(5);
        }else{
            $RoomType = RoomType::where('name','like', '%' . $room_type_name . '%')->get();
            if (count($RoomType) == 0){
                return redirect()->back()->with(['message' => 'Can not find RoomType '.$room_type_name]);
            }else{
                $lsRoom = Room::where('room_type_id','=',$RoomType[0]->id)->paginate(3);
            }

        }
        $room_booking_status1 = RoomBooking::where('status','=',1)->get();
        $room_booking_status0 = RoomBooking::where('status','=',0)->get();
        $lsBooking_status1 = array();
        $lsBooking_status0 = array();
        foreach ($room_booking_status1 as $item) {
            $lsBooking_status1[] = Booking::where('id','=',$item->booking_id)->get();
        }
        foreach ($room_booking_status0 as $item) {
            $lsBooking_status0[] = Booking::where('id','=',$item->booking_id)->get();
        }
        return view('Rooms.list')->with(['lsRoom' => $lsRoom,'room_type_name'=>$room_type_name,'lsBooking_status1'=>$lsBooking_status1,'lsBooking_status0'=>$lsBooking_status0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room_type = RoomType::all();
        $facility = Facility::all();
        return view('Rooms.add')->with(['room_type' => $room_type, 'facility' => $facility]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $room->address = $request->address;
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
        if ($request->facilities){
            foreach ($request->facilities as $item) {
                $room_facility = new RoomFacility();
                $room_facility->room_id = $room->id;
                $room_facility->facility_id = $item;
                $room_facility->save();
            }
        }else{

        }


        $request->session()->flash('success', 'Create successfully');
        return redirect('Rooms');
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
        $room = Room::find($id);
        $room_image = RoomImage::where('room_id','=',$room->id)->get();

        $room_type_selected = RoomType::find($room->room_type_id);
        $room_type = RoomType::all();
        $facility = Facility::all();
        return view('Rooms.edit')->with(['room' => $room, 'room_type' => $room_type, 'room_type_selected' => $room_type_selected,'facility'=>$facility,'room_image' => $room_image]);
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
        }else{
            $room->feature_image = $room->feature_image;
        }

        $room->description = $request->description;
        $room->address = $request->address;
        $room->number_room = $request->number_room;
        $room->comment_id = $request->comment_id;
        $room->save();

        if ($request->image != null) {
            $room_image_old = RoomImage::where('room_id','=',$room->id)->get();
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
        }else{
            $room_image_old = RoomImage::where('room_id','=',$room->id)->get();
            foreach ($room_image_old as $item) {
                $item->image = $item->image;
            }
        }

        $room_facility_selected = RoomFacility::where('room_id', '=',$room->id)->get();
        foreach ($room_facility_selected as $item){
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
        $room_image = RoomImage::where('room_id','=',$room->id)->get();
        foreach ($room_image as $item) {
            $item->delete();
        }
        $room->delete();
        $request->session()->flash('success', 'Delete successfully');
        return redirect('Rooms');
    }

    public function destroy_ajax($id, Request $request)
    {
        try {
            $room = Room::find($id);
            $room_image = RoomImage::where('room_id','=',$room->id)->get();
            foreach ($room_image as $item) {
                $item->delete();
            }
            $room->delete();
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
