<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class UsersController extends Controller
{
    function __construct() {

        $this->middleware('permission:User List',   ['only' => ['index']]);
        $this->middleware('permission:User Create', ['only' => ['create','store']]);
        $this->middleware('permission:User Edit',   ['only' => ['edit','update']]);
        $this->middleware('permission:User Delete', ['only' => ['delete']]);   
    }

    
    public function index(){

        $data['users'] = User::get();

        return view('user.index',$data);
    }

    public function create(){

        $data['roles'] = Role::get();

        return view('user.create',$data);


    }

    public function store(Request $request){

        DB::beginTransaction();

        $request->validate([
            'name'          => 'required',
            'password'      => 'required',
            'role_id'       => 'required',
            'email'         => 'required|unique:users,email'

        ]);

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->name);
        $user->save();

        $role = Role::find($request->role_id);
        $role->syncPermissions($role->permissions);

        $assign_role = $user->assignRole($role);


        DB::commit();

        return redirect()->route('user.index')->with('success','User Created Successfully');

    }

    public function edit($id){

        $data['roles'] = Role::get();

        $data['user'] = User::find($id);


        return view('user.edit',$data);


    }

    public function update(Request $request,$id){

        DB::beginTransaction();

        $user = User::find($id);

        $request->validate([
            'name'          => 'required',
            'role_id'       => 'required',
            'email'         => 'required|unique:users,email,'.$user->id

        ]);

        $user->name     = $request->name;
        $user->email    = $request->email;

        if(!empty($user->password)){
            $user->password = bcrypt($request->password);
        }

        $user->update();

        $role = Role::find($request->role_id);
        $role->syncPermissions($role->permissions);

        $assign_role = $user->assignRole($role);

        DB::commit();

        return redirect()->route('user.index')->with('success','User Updated Successfully');
    }

    public function delete($id){

        DB::beginTransaction();

        $user = User::where('id',$id)->delete();

        DB::commit();

        return redirect()->route('user.index')->with('success','User Deleted Successfully');

    }

}
