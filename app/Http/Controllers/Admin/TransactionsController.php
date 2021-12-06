<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use Carbon\Carbon;



class TransactionsController extends Controller
{
    //


    public function createNewTransaction(Request $request){



        // $table->id('TranId');
        // $table->date('TranDate');
        // $table->float('TranAmount');
        // $table->unsignedBigInteger('TranTypeId');

        $insert = Transactions::insertGetId([
            'TranAmount'=>$request['TranAmount'],
            'TranDate'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
            'TranTypeId'=>$request['TranTypeId'],
          //  'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        return $insert;
    }
    
}
