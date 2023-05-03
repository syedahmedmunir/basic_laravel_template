<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
{
    function __construct() {

        $this->middleware('permission:User List',   ['only' => ['index']]);
        $this->middleware('permission:User Create', ['only' => ['create','store']]);
        $this->middleware('permission:User Edit',   ['only' => ['edit','update']]);
        $this->middleware('permission:User Delete', ['only' => ['delete']]);   
    }


    public function index(){

        $data['roles'] = Role::get();

        return view('role.index',$data);
    }

    public function create(){

        $data['permissions'] = Permission::get();

        return view('role.create',$data);


    }

    public function store(Request $request){

        DB::beginTransaction();

        $request->validate([
            'name'                  => 'required|unique:roles,name',
            'permission_ids'        => 'required'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permission_ids);

        $role->syncPermissions($role->permissions);


        DB::commit();
        return redirect()->route('role.index')->with('success','Role Created Successfully');
    }

    public function edit($id){

        $data['role']           = Role::find($id);
        $data['permissions']    = Permission::get();
        

        return view('role.edit',$data);
    }

    public function update(Request $request,$id){

        DB::beginTransaction();

        $role = Role::find($id);

        $request->validate([
            'name'                  => 'required|unique:roles,name,'.$role->id,
            'permission_ids'        => 'required'
        ]);

        $role->name = $request->name;
        $role->update();

        $role->revokePermissionTo($role->permissions);

        
        $role->givePermissionTo($request->permission_ids);
        $role->syncPermissions($role->permissions);

        DB::commit();

        return redirect()->route('role.index')->with('success','Role Updated Successfully');
    }

    public function delete($id){

        DB::beginTransaction();

        $users = User::whereHas('roles', function ($query) use ($id) {
            $query->where('role_id', $id);
        })->get();

        if(count($users)>0){

            DB::rollback();
            return redirect()->back()->with('error','Current Role Is Assigned to A User');
        }

        $role = Role::where('id',$id)->delete();

        DB::commit();

        return redirect()->route('user.index')->with('success','Role Deleted Successfully');
    }
}
