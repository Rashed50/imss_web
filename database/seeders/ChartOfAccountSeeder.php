<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChartOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('chart_of_accounts')->insert([ // step 02
           
            'ChartOfAcctName' => 'Petty Cash',
            'ChartOfAcctNumber' => 190,
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '33949734389',
            'BankId' => 2,
            'AcctTypeId' => 2,
            'BankAcctTypeId' => 2,
          ]);
       
        DB::table('chart_of_accounts')->insert([ // step 01
              
            'ChartOfAcctName' => 'Item Purchase',
            'ChartOfAcctNumber' => 210,
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '1954563852',
            'BankId' => 1,
            'AcctTypeId' => 1,
            'BankAcctTypeId' => 1,
          ]);

          DB::table('chart_of_accounts')->insert([ // step 01
              
            'ChartOfAcctName' => 'Item Sales',
            'ChartOfAcctNumber' => 220,
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '741963852',
            'BankId' => 1,
            'AcctTypeId' => 1,
            'BankAcctTypeId' => 1,
          ]);

          DB::table('chart_of_accounts')->insert([ // step 01
              
            'ChartOfAcctName' => 'Customer Due Collection',
            'ChartOfAcctNumber' => 230,
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '987654321',
            'BankId' => 1,
            'AcctTypeId' => 1,
            'BankAcctTypeId' => 1,
          ]);

          DB::table('chart_of_accounts')->insert([ // step 01
              
            'ChartOfAcctName' => 'Sonali Bank Meherpur',
            'ChartOfAcctNumber' => 240,
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '852741789',
            'BankId' => 1,
            'AcctTypeId' => 1,
            'BankAcctTypeId' => 1,
          ]);

          DB::table('chart_of_accounts')->insert([ // step 01
              
            'ChartOfAcctName' => 'Uttara Bank Meherpur',
            'ChartOfAcctNumber' => 250,
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '123465879',
            'BankId' => 1,
            'AcctTypeId' => 1,
            'BankAcctTypeId' => 1,
          ]);

          DB::table('chart_of_accounts')->insert([ // step 01
              
            'ChartOfAcctName' => 'IBBL Meherpur',
            'ChartOfAcctNumber' => 260,
            'OpeningDate' => '2022-02-25',
            'BankAcctNumber' => '789765546',
            'BankId' => 1,
            'AcctTypeId' => 1,
            'BankAcctTypeId' => 1,
          ]);


         
    }
}
