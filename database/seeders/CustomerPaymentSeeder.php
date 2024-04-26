<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Transactions;
use App\Models\DebitCredit;
use Carbon\Carbon;

class CustomerPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
      //  $trnId = rand(100,999);
         Transactions::insert([
            "TranDate" => Carbon::now(),
            "TranAmount" => 200,
            "TranTypeId" => 1,
        ]);

        $trnId = DB::getPdo()->lastInsertId();


        DebitCredit::insert([ 
            "Amount" => 200,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 1,
            "DrCrTypeId" => 2,  // credit
        ]);

        DebitCredit::insert([
           
            "Amount" => 200,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 2,
            "DrCrTypeId" => 1, // debit
        ]);
        
        DB::table("customer_payments")->insert([
            "PaymentDate" => Carbon::now(),
            "PaymentAmount" =>200 ,
            "AccountId" => 1 ,
            "MoneyReceiveBy" =>1 ,
            "VoucharNo" => "abc-1200" ,
            "Discount" =>0 ,
            "CreateById" => 1,
            "CustId" => 1 ,
            "TranId" => $trnId,
        ]);        
    }
}
