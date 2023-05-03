<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
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
    }
}
