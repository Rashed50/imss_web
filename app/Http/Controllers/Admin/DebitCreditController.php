<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DebitCredit;
use Carbon\Carbon;

class DebitCreditController extends Controller
{
    

    public function insertNewDebitCreditTransaction(Request $request){

 
        // $table->id('DebiCredId');
        // $table->float('Amount',10,2);
        // $table->unsignedBigInteger('TranId');
        // $table->unsignedBigInteger('ChartOfAcctId');
        // $table->unsignedBigInteger('DrCrTypeId');

        $insert = DebitCredit::insertGetId([
            'Amount'=>$request['Amount'],
            'TranId'=>$request['TranId'],
            'ChartOfAcctId'=>$request['ChartOfAcctId'],
            'DrCrTypeId'=>$request['DrCrTypeId'],
          // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        return $insert;
    }

}
