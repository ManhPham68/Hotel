<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('list_RoomType')){
            $name_search = $request->name_search;
            if (!$name_search){
                $lsRoomType = RoomType::paginate(10);
            }
            else{
                $lsRoomType = RoomType::where('name', 'like','%' . $name_search . '%')->orwhere('bedding','=',$name_search)->paginate(3);
            }
            return view('RoomType.list')->with(['lsRoomType' => $lsRoomType ,'name_search' => $name_search]);
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
        if (Gate::allows('add_RoomType')){
            return view('RoomType.add');
        }else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('add_RoomType')){
            $roomtype = new RoomType();
            $roomtype->name = $request->name;
            $roomtype->bedding = $request->bedding;
            $roomtype->save();
            $request->session()->flash('success','Create successfully');
            return redirect('/RoomType');
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('edit_RoomType')){
            $roomtype = RoomType::find($id);
            return view('RoomType.edit')->with(['roomtype' => $roomtype]);
        }else{
            abort(403);
        }
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
        if (Gate::allows('edit_RoomType')){
            $roomtype = RoomType::find($id);
            $roomtype->name = $request->name;
            $roomtype->bedding = $request->bedding;
            $roomtype->save();
            $request->session()->flash('success','Update successfully');
            return redirect('RoomType');
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $roomtype = RoomType::find($id);
        $roomtype->delete();
        $request->session()->flash('success','Delete successfully');
        return redirect('RoomType');
    }
    public function destroy_ajax($id,Request $request)
    {
        if (Gate::allows('delete_RoomType')){
            try {
                $roomtype = RoomType::find($id);
                $roomtype->delete();
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
        }else{
            abort(403);
        }
    }
}
