<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           ['name'=> 'user_role_create','permision_title'=>'User Role Create','guard_name'=>'web'],
           ['name'=> 'user_role_list','permision_title'=>'User Role List','guard_name'=>'web'],
           ['name'=> 'user_role_update','permision_title'=>'User Role Update','guard_name'=>'web'],

        ];

        foreach ($permissions as $permission) {
           // dd($permission['name']);
          Permission::create(['name' => $permission['name'], 'guard_name'=>'web']);
        }
    }
}
