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
           ['name'=> 'user_role_create'],
           ['name'=> 'user_role_list'],
           ['name'=> 'user_role_update'],

        ];

        foreach ($permissions as $permission) {
          Permission::create(['name' => $permission['name'], 'guard_name'=>'web']);
        }
    }
}
