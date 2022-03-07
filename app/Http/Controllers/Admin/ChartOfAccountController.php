<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChartOfAccount;
use Carbon\Carbon;


class ChartOfAccountController extends Controller
{
    public function getAllChartOfAccount(){
      return ChartOfAccount::get();
    }

    public function addNewChartOfAccount(Request $request){

        $insert = ChartOfAccount::insertGetId([
            'ChartOfAcctName'=>$request['ChartOfAcctName'],
            'ChartOfAcctNumber'=>$request['ChartOfAcctNumber'],
            'OpeningDate'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
            'BankAcctNumber'=>$request['BankAcctNumber'],
            'BankId'=>$request['BankId'],
            'AcctTypeId'=>$request['AcctTypeId'],
            'BankAcctTypeId'=>$request['BankAcctTypeId'],
             'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
 

          //  $table->string('ChartOfAcctName');
        //    $table->string('ChartOfAcctNumber')->nullable();

          //  $table->integer('AccountId')->default(0);
          //  $table->unsignedBigInteger('AcctBalance')->default(0);
           // $table->date('OpeningDate');
           // $table->boolean('ActiveStatus')->default(true);
          //  $table->boolean('IsTransaction')->default(false);
          //  $table->boolean('IsPredefined')->default(false);
          //  $table->string('BankAcctNumber')->nullable();
          //  $table->timestamps();

           // $table->unsignedBigInteger('BankId');
          //  $table->foreign('BankId')->references('BankId')->on('banks');

          //  $table->unsignedBigInteger('AcctTypeId');
           // $table->foreign('AcctTypeId')->references('AcctTypeId')->on('account_types');

           // $table->unsignedBigInteger('BankAcctTypeId');
           // $table->foreign('BankAcctTypeId')->references('BankAcctTypeId')->on('bank_account_types');

        ]);
        return $insert;

        // if($insert){
        //         Session::flash('success','New Vendor Added Successfully.');
        //        // return redirect()->route('company.add');
        // }else{
        //     Session::flash('error','please try again.');
        //       //  return redirect()->back();
        // }
    }
}
