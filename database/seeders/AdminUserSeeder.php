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
use Faker\Factory as Faker;
use Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::create([
        //     'user_name' => 'Rashedul Hoque',
        //     'user_email' => 'admin10@gmail.com',
        //     'user_phone' => '01731540704',
        //     'password' => bcrypt('135790')
        // ]);



        $user=User::create([
            // 'user_name'=> 'Rashedul Hoque',
            // 'user_email'=> 'admin11@gmail.com',
            // 'user_phone'=> '017315000',
            // 'password'=>Hash::make('12345678'),
            //'created_at'=>Carbon::now()->toDateTimeString()
            'user_name' =>'admin',
            'user_email' => 'superadmin@admin.com',
            'user_phone'=> '01731540704',
            'email_verified_at' => now(),
            'password' => Hash::make('Rashed@084050.'),
            'remember_token' => Str::random(10),
        ]);

       // $user = User::where('id',5)->first();
        $role = Role::create(['name' => 'Admin']);
       // $role = Role::where('id',4)->first();
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
       // dd($role,$user);
        $user->assignRole([$role->id]);

    }
}
