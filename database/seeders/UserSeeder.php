<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;




class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_check =User::where('name','SAM')->first();

        if(empty($user_check)){
            $user           = new User();
        }else{
            $user = $user_check;
        }

        $user->name     = 'SAM';
        $user->email    = 'syedahmedmunir@gmail.com';
        $user->password = bcrypt('Admin123');
        $user->save();

        $permissions=[
            'User List',
            'User Create',
            'User Edit',
            'User Delete',
            'Role List',
            'Role Create',
            'Role Edit',
            'Role Delete',
        ];

        foreach($permissions as $permission){
            $perm_found = Permission::where('name',$permission)->first();
            if(empty($perm_found)){
                Permission::create(['name'=>$permission]);
            }
        }


        $role_check = Role::where('name','Admin')->first();
        if(empty($role_check)){
         $role = Role::create(['name'=>'Admin']);

        }else{
            $role = $role_check;
        }

        $all_permissions = Permission::get()->pluck('id');

        $role->givePermissionTo($all_permissions);
        $role->syncPermissions($role->permissions);

        $assign_role = $user->assignRole($role);
    }
}
