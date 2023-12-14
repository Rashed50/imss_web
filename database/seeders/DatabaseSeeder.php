<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
          'user_name' =>'admin',
          'user_email' => 'admin@admin.com',
          'user_phone'=> '01731540704',
          'email_verified_at' => now(),
          'password' => Hash::make('12345678'),
          'remember_token' => Str::random(10),

        ]);

        DB::table('users')->insert([
          'user_name' =>'admin',
          'user_email' => 'superadmin@admin.com',
          'user_phone'=> '01731540704',
          'email_verified_at' => now(),
          'password' => Hash::make('Rashed@084050.'),
          'remember_token' => Str::random(10),

        ]);


        DB::table('chart_of_accounts')->insert([ // step 01
           // 'ChartOfAcctId' => 1,
            'ChartOfAcctName' => 'Chart Of Account Name 01',
            'ChartOfAcctNumber' => 'Chart Of Account Number 01',
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '33949734389',
            'BankId' => 1,
            'AcctTypeId' => 1,
            'BankAcctTypeId' => 1,
          ]);


          DB::table('chart_of_accounts')->insert([ // step 02
           // 'ChartOfAcctId' => 2,
            'ChartOfAcctName' => 'Chart Of Account Name 02',
            'ChartOfAcctNumber' => 'Chart Of Account Number 02',
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '33949734389',
            'BankId' => 2,
            'AcctTypeId' => 2,
            'BankAcctTypeId' => 2,
          ]);


          DB::table('divisions')->insert([ // step 02
             'DiviId' => 1,
             'DiviName' => 'Khulna',
           ]);

           DB::table('districts')->insert([ // step 02
            'DistId' => 1,
            'DistName' => 'Meherpur',
            'DiviId' => 1,
          ]);

          DB::table('thanas')->insert([ // step 02
            'ThanId'=> 1,
            'ThanaName' => 'Meherpur Sadar',
            'DistId' => 1,
            'DiviId' => 1,
          ]);

          DB::table('unions')->insert([ // step 02
            'UnioId'=> 1,
            'UnioName' => 'ABC',
            'ThanId'=> 1,
            'DistId' => 1,
            'DiviId' => 1,
          ]);

    }
}
