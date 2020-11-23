<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        if (!$name) {
            $lsUsers = User::paginate(5);
        } else {
            $lsUsers = User::where('name', 'like', '%' . $name . '%')->paginate(5);
        }

        return view('User.list')->with(['lsUsers' => $lsUsers, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lsRole = Role::all();
        return view('User.add')->with(['lsRole' => $lsRole]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;

        $path = '';
        $file_name = $request->avatar->getClientOriginalName();
        $file_name = time() . '.' . $file_name;
        $request->avatar->move(public_path('upload'), $file_name);
        $path = 'upload/' . $file_name;
        $user->avatar = $path;

        $user->password = Hash::make($request->password);
        $user->save();
        $roleId = $request->role;
        $user->roles()->attach($roleId);

        $request->session()->flash('success', 'Create successfully');
        return redirect('User');
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
        $user = User::find($id);
        $lsRole = Role::all();
        $lsRole_selected = UserRole::where('user_id','=',$user->id)->get();
        return view('User.edit')->with(['user' => $user, 'lsRole' => $lsRole,'lsRole_selected'=>$lsRole_selected]);
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
        $user = User::find($id);
        if (!$request->avatar) {
            $user->avatar = $user->avatar;
        } else {
            $path = '';
            $file_name = $request->avatar->getClientOriginalName();
            $file_name = time() . '.' . $file_name;
            $request->avatar->move(public_path('upload'), $file_name);
            $path = 'upload/' . $file_name;
            $user->avatar = $path;

        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        } else {
            $user->password = $user->password;
        }

        $user->save();
        $roleId = $request->role;
        $user->roles()->sync($roleId);
        $request->session()->flash('success', 'Update successfully');
        return redirect('User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();
        $request->session()->flash('success', 'Delete successfully');
        return redirect('User');
    }
    public function destroy_ajax($id, Request $request)
    {
        try {
            $user = User::find($id);
            $user->roles()->detach();
            $user->delete();
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
