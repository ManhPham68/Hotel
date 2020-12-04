<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('list_slider')){
            $name = $request->name;
            if (!$name) {
                $lsSlider = Slider::paginate(5);
            } else {
                $lsSlider = Slider::where('name', 'like', '%' . $name . '%')->paginate(5);
            }

            return view('Slider.list')->with(['lsSlider' => $lsSlider, 'name' => $name]);
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
        if (Gate::allows('add_slider')){
            return view('Slider.add');
        }else{
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
        if (Gate::allows('add_slider')){
            $slider = new Slider();
            $slider->name = $request->name;
            $slider->description = $request->description;
            $path = '';
            $file_name = $request->image->getClientOriginalName();
            $file_name = time() . '.' . $file_name;
            $request->image->move(public_path('upload'), $file_name);
            $path = 'upload/' . $file_name;
            $slider->image = $path;
            $slider->save();
            $request->session()->flash('success', 'Create successfully');
            return redirect('Slider');
        }else{
            abort(403);
        }
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
       if (Gate::allows('edit_slider')){
           $slider = Slider::find($id);
           return view('Slider.edit')->with(['slider' => $slider]);
       }else{
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
        if (Gate::allows('edit_slider')){
            $slider = Slider::find($id);
            if ($request->image == null) {
                $slider->image = $slider->image;
            } else {
                $path = '';
                $file_name = $request->image->getClientOriginalName();
                $file_name = time() . '.' . $file_name;
                $request->image->move(public_path('upload'), $file_name);
                $path = 'upload/' . $file_name;
                $slider->image = $path;
            }
            $slider->name = $request->name;
            $slider->description = $request->description;
            $slider->save();
            $request->session()->flash('success', 'Update successfully');
            return redirect('Slider');
        }else{
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
        $slider = Slider::find($id);
        $slider->delete();
        $request->session()->flash('success', 'Update successfully');
        return redirect('Slider');
    }

    public function destroy_ajax($id, Request $request)
    {
        if (Gate::allows('delete_slider')){
            try {
                $slider = Slider::find($id);
                $slider->delete();
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
        }else{
            abort(403);
        }
    }
}
