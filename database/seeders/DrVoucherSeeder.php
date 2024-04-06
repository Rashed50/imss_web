<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DrVoucher;
use App\Models\Transactions;
use App\Models\DebitCredit;
use Carbon\Carbon;

class DrVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
         
        $trnId = Transactions::insertGetId([
            "TranDate" => Carbon::now(),
            "TranAmount" => 500,
            "TranTypeId" => 1,
        ]);

        DebitCredit::insertGetId([ 
            "Amount" => 500,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 1,
            "DrCrTypeId" => 2,  // credit
        ]);

        DebitCredit::insertGetId([
           
            "Amount" => 500,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 2,
            "DrCrTypeId" => 1, // debit
        ]);

        DrVoucher::insertGetId([
           
            "DrTypeId" => 1,
            "TransactionId" =>  $trnId,
            "DrDate" => Carbon::now(),
            "DrAmount" => 500, // debit
            "DrVoucherNo" => "afajdskflsda",
            "CreateById"=> 1
        ]);
 
    }
}
