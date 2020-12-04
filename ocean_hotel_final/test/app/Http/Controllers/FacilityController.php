<?php

namespace App\Http\Controllers;

use App\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('list_facility')){
            $name = $request->name;

            if(!$name)
            {
                $lsFacility = Facility::paginate(15);
            }else{
                $lsFacility = Facility::where('name','like', '%' . $name . '%')->orwhere('type','like','%'.$name.'%')->orwhere('price','=',$name)->paginate(3);
            }
            return view('Facility.list')->with(['lsFacility' => $lsFacility,'name' => $name]);
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
        if (Gate::allows('add_facility')){
            return view('Facility.add');
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
        if (Gate::allows('add_facility')){
            $facility = new Facility($request->all());
            $facility->save();
            $request->session()->flash('success','Create successfully');
            return redirect('Facility');
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
       if (Gate::allows('edit_facility')){
           $facility = Facility::find($id);
           return view('Facility.edit')->with(['facility' =>$facility]);
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
        if (Gate::allows('edit_facility')){
            $facility = Facility::find($id);
            $facility->name = $request->name;
            $facility->type = $request->type;
            $facility->price = $request->price;
            $facility->description = $request->description;
            $facility->save();
            $request->session()->flash('success','Update successfully');
            return redirect('Facility');
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
        $facility = Facility::find($id);
        $facility->delete();
        $request->session()->flash('success','Delete successfully');
        return redirect('Facility');
    }

    public function destroy_ajax($id,Request $request)
    {
        if (Gate::allows('delete_facility')){
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
        }else{
            abort(403);
        }
    }
}
