<?php

namespace Database\Seeders;

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
          'name' =>'admin',
          'email' => 'admin@gmail.com',
          'email_verified_at' => now(),
          'password' => bcrypt('123456'),
          
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


    }
}
