<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\User;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user=User::create([
            'user_name' =>'admin',
            'user_email' => 'superadmin@admin.com',
            'user_phone'=> '01731540704',
            'email_verified_at' => now(),
            'password' => Hash::make('Rashed@084050.'),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

    //     $role = Role::create(['name' => 'Admin']);
    //    // $role = Role::where('id',4)->first();
    //     $permissions = Permission::pluck('id', 'id')->all();
    //     $role->syncPermissions($permissions);
    //    // dd($role,$user);
    //     $user->assignRole([$role->id]);

    }
}
