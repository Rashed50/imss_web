<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\DebitCreditController;
use App\Models\DrType;
use App\Models\DrVoucher;
use App\Models\EmployeeInformation;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DebitVoucherController extends Controller{
  /*
  |--------------------------------------------------------------------------
  | DATABASE OPERATION
  |--------------------------------------------------------------------------
  */


public function getAll(){
  return $data= DrVoucher::orderBy('DrVoucId','DESC')->get();
}




  /*
  |--------------------------------------------------------------------------
  | BLADE OPERATION
  |--------------------------------------------------------------------------
  */
  public function index(){
   $allDrVouchar = $this->getAll();

    $TType=DrType::orderBy('DrTypeName','ASC')->get();
    $getAllEmployees= EmployeeInformation::orderBy('EmplInfoId','DESC')->get();
    return view('admin.voucher.debit.index', compact('getAllEmployees', 'TType', 'allDrVouchar'));
  }


  public function edit(Request $request){
     $allDrVouchar = $this->getAll();
     $data=  DrVoucher::where('DrVoucId',$request->id)->first();
     $TType=DrType::orderBy('DrTypeName','ASC')->get();
     $getAllEmployees= EmployeeInformation::orderBy('EmplInfoId','DESC')->get();

     return response()->json(array(
       'data'=>$data,
       'getAllEmployees'=>$getAllEmployees,
       'TType'=>$TType,
       'allDrVouchar'=>$allDrVouchar,
     ));
    
   }

  public function store(Request $request){

    $request['TranAmount'] = 900;
    $request['TranTypeId'] = 1;

    $transObj = new  TransactionsController();
    $transId = $transObj->createNewTransaction($request); 
    

    $request['Amount'] = 600;
    $request['TranId'] = $transId;
    $request['ChartOfAcctId'] = 1;
    $request['DrCrTypeId'] = 1;

    $decrObj = new  DebitCreditController();
    $drcrId = $decrObj->insertNewDebitCreditTransaction($request); 

    $insert= DrVoucher::insertGetId([
        'TransactionId'=>$transId,
        'DrTypeId'=>$request['Purpose'],
        'ExpenseDate'=>$request['Date'],
        'Amount'=>$request['Amount'],
        'DebitedTold'=>1,
        'CreditedFromId'=>$request['CreditedFromId'],
        'VoucherId'=>$request['VoucharNo'],
        'CreateById'=>1,
    ]);


    if ($insert) {
        Session::flash('success', 'successfully store data information');
        return redirect()->back();
    }else{
        Session::flash('error', 'Please try again');
        return redirect()->back();
    }

}



public function update(Request $request){

  $request['TranAmount'] = 900;
  $request['TranTypeId'] = 1;

  $transObj = new  TransactionsController();
  $transId = $transObj->createNewTransaction($request); 
  

  $request['Amount'] = 600;
  $request['TranId'] = $transId;
  $request['ChartOfAcctId'] = 1;
  $request['DrCrTypeId'] = 1;

  $decrObj = new  DebitCreditController();
  $drcrId = $decrObj->insertNewDebitCreditTransaction($request); 

  $update= DrVoucher::where('DrVoucId',$request->id)->update([
      'TransactionId'=>$transId,
      'DrTypeId'=>$request['Purpose'],
      'ExpenseDate'=>$request['Date'],
      'Amount'=>$request['Amount'],
      'DebitedTold'=>1,
      'CreditedFromId'=>$request['CreditedFromId'],
      'VoucherId'=>$request['VoucharNo'],
      'CreateById'=>1,
  ]);


  if ($update) {
      Session::flash('success', 'successfully update data information');
      return redirect()->back();
  }else{
      Session::flash('error', 'Please try again');
      return redirect()->back();
  }

}




  /*
  |--------------------------------------------------------------------------
  | API OPERATION
  |--------------------------------------------------------------------------
  */



  /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
}
