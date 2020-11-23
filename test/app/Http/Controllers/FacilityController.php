<?php

namespace App\Http\Controllers;

use App\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;

        if(!$name)
        {
            $lsFacility = Facility::paginate(15);
        }else{
            $lsFacility = Facility::where('name','like', '%' . $name . '%')->orwhere('type','like','%'.$name.'%')->orwhere('price','=',$name)->paginate(3);
        }
        return view('Facility.list')->with(['lsFacility' => $lsFacility,'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Facility.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facility = new Facility($request->all());
        $facility->save();
        $request->session()->flash('success','Create successfully');
        return redirect('Facility');
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
        $facility = Facility::find($id);
        return view('Facility.edit')->with(['facility' =>$facility]);
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
        $facility = Facility::find($id);
        $facility->name = $request->name;
        $facility->type = $request->type;
        $facility->price = $request->price;
        $facility->description = $request->description;
        $facility->save();
        $request->session()->flash('success','Update successfully');
        return redirect('Facility');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $facility = Facility::find($id);
        $facility->delete();
        $request->session()->flash('success','Delete successfully');
        return redirect('Facility');
    }

    public function destroy_ajax($id,Request $request)
    {
        try {
            $facility = Facility::find($id);
            $facility->delete();
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
