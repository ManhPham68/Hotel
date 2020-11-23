<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function getLogin()
    {
        return view('admin.getLogin');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password],$request->has('remember'))) {
            return redirect('/');
        } else {
            return redirect()->back()->with(['message'=>'Email or Password is not correct']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect(\URL::previous());
    }
    public function getSignup(){
        return view('admin.signup');
    }
    public function postSignup(Request $request){
        $request->validate([
           'name' => 'required',
           'email'=> 'required|email|unique:users',
           'password' => 'min:8'
        ]);
        $user = new User();
        $user->name = $request->name;
        if ($request->password == $request->confirm_password){
            $user->password = Hash::make($request->password);
        }else{
            return redirect('admin_getSignup')->with(['cf_pw' => 'Password is not confirm']);
        }
        $user->email = $request->email;
        $user->save();
        return redirect('admin_getLogin')->with(['create_success' => 'Create Successful !!']);
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect('User_index');
    }

}
