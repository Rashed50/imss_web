<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transactions;
use App\Models\DebitCredit;
use App\Models\VendorPayment;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class VendorPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Transactions::insert([
            "TranDate" => Carbon::now(),
            "TranAmount" => 5000,
            "TranTypeId" => 1,
        ]);
        $trnId = DB::getPdo()->lastInsertId();


        DebitCredit::insert([ 
            "Amount" => 5000,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 1,
            "DrCrTypeId" => 1,
        ]);

        DebitCredit::insert([
           
            "Amount" => 5000,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 2,
            "DrCrTypeId" => 2,
        ]);
        
        VendorPayment::insert([
            
            "TranId" => $trnId,
            "VendId" => 1 ,
            "Amount" => 5000 ,
            "Date" => Carbon::now(),
            "DebitToId" => "2" ,
            "CreditToId" =>"1" ,
            "CreateById" => 1, 
           
        ]); 
    }
}
