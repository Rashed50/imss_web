<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CrVoucher;
use App\Models\Transactions;
use App\Models\DebitCredit;
use Carbon\Carbon;

class CrVoucherSeeder extends Seeder
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
            "TranAmount" => 300,
            "TranTypeId" => 1,
        ]);

        DebitCredit::insertGetId([ 
            "Amount" =>300,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 1,
            "DrCrTypeId" => 2,  // credit
        ]);

        DebitCredit::insertGetId([
           
            "Amount" => 300,
            "TranId" =>  $trnId,
            "ChartOfAcctId" => 2,
            "DrCrTypeId" => 1, // debit
        ]);

        CrVoucher::insertGetId([
           
            "CrTypeId" => 1,
            "TransactionId" =>  $trnId,
            "CrDate" => Carbon::now(),
            "CrAmount" => 300, // debit
            "CrVoucherNo" => "abcnksss",
            "CreateById"=> 1
        ]);
    }
}
