<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function create(){
        $lsPermission = Permission::paginate(10);
        return view('Permission.add',compact('lsPermission'));
    }
    public function store(Request $request){
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->parent_id = 0;
        $permission->key_code = '';
        $permission->save();
        foreach ($request->permissions as $item) {
            $permission_ = new Permission();
            $permission_->name = $item;
            $permission_->display_name = $item;
            $permission_->parent_id = $permission->id;
            $permission_->key_code = $permission->name .'_'.$item;
            $permission_->save();
        }
        $request->session()->flash('success', 'Create successfully');
        return redirect('Permission.add');
    }
}
