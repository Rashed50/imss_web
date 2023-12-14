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
           ['name'=> 'user_role_create','guard_name'=>'web'],
           ['name'=> 'user_role_list','guard_name'=>'web'],
           ['name'=> 'user_role_update','guard_name'=>'web'],

        ];

        foreach ($permissions as $permission) {
          Permission::create(['name' => $permission['name'], 'guard_name'=>'web']);
        }
    }
}
