<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeInfoController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\DebitCreditController;
use App\Models\CustomerPayment;
use App\Models\CustomerInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerPaymentController extends Controller{
  /*
  |--------------------------------------------------------------------------
  |  DATABASE OPERATION
  |--------------------------------------------------------------------------
  */

  public function getAllPaymentCustomer(){
    return $all = CustomerPayment::orderBy('CustPaymId','DESC')->get();
  }

  public function findPaymentCustomer($id){
    return $data = CustomerPayment::where('CustPaymId',$id)->first();
  }

  public function customerIdWiseFindPayment($id){
    return $data = CustomerPayment::where('CustId',$id)->get();
  }

  public function dateAndIdWisePayment($fromDate, $toDate, $id){
    return $data = CustomerPayment::where('CustId',$id)->whereDate('PaymentDate','>=',$fromDate)->whereDate('PaymentDate','<=',$toDate)->get();
  }

  public function delete($id){
    CustomerPayment::where('CustPaymId',$id)->delete();
    $notification=array(
        'message'=>'Successfully Delete Employee Information',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
  }


 /*
  |--------------------------------------------------------------------------
  |  BLADE OPERATION
  |--------------------------------------------------------------------------
  */
  public function add(){
    $getAllPaymentCustomer = $this->getAllPaymentCustomer();
    // Call Employee Controller
    $employeeOBJ = new EmployeeInfoController();
    $employee = $employeeOBJ->getAllEmployees();
    return view('admin.customer.payment.add',compact('employee','getAllPaymentCustomer'));
  }

  public function edit($id){
    $getAllPaymentCustomer = $this->getAllPaymentCustomer();
    $data = $this->findPaymentCustomer($id);
    // Call Employee Controller
    $employeeOBJ = new EmployeeInfoController();
    $employee = $employeeOBJ->getAllEmployees();
    return view('admin.customer.payment.edit',compact('employee','data', 'getAllPaymentCustomer'));
  }




 // ============== search customer in list for Payment=========================== 
  public function payIdWisePaymentInfo($id){
    $payInfo= $this->findPaymentCustomer($id);
    return view('admin.customer.payment.update-payment',compact('payInfo'));
  }



 // ============== search id and date wise customer Payment list =========================== 
  public function custIdWisePaymentInfo($id){
    
     $toDate = date('Y-m-d', strtotime(Carbon::now()));
     $fromDate = date('Y-m-d', strtotime(Carbon::now()->subMonth(2)));  

     $allPayment = $this->dateAndIdWisePayment($fromDate,$toDate,$id);

     return view('admin.customer.payment.payment-info',compact('allPayment', 'fromDate', 'toDate'));
}

//==============  id and date wise payment info ====================//

public function dateAndCustomerIdWiseFindPayment(Request $request){
 $toDate = $request->eDate;
 $fromDate = $request->fromDate;
 $id = $request->id;
  $allPayment = $this->dateAndIdWisePayment($fromDate,$toDate,$id);

  // dd($allPayment);
  return view('admin.customer.payment.payment-info',compact('allPayment', 'fromDate', 'toDate'));
}

// =============== delete customer id wise payment info =========================
public function payIdWisePaymentInfoDelete($id){
  $delete = CustomerPayment::where('CustPaymId',$id)->delete();

  if($delete){
    $notification=array(
        'message'=>'Successfully delete payment Information',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
  }
}

// ==============Payment insert by search customer list===========================

public function paymentStore(Request $request){
    // dd($request->all());

    // $currentDue = ( $request->CurrentDue - ($request->PayAmount + $request->Discount) );
    $creator = Auth::user()->id;

    $request['TranAmount'] = $request->Amount;
    $request['TranTypeId'] = 1;

    $transObj = new  TransactionsController();
    $transId = $transObj->createNewTransaction($request); 
    

    $request['Amount'] = $request->Amount;
    $request['TranId'] = $transId;
    $request['ChartOfAcctId'] = 1;
    $request['DrCrTypeId'] = 1;

    $decrObj = new  DebitCreditController();
    $drcrId = $decrObj->insertNewDebitCreditTransaction($request); 


    $insert = CustomerPayment::insert([
    'PaymentDate' => $request->Date,
    'PaymentAmount' => $request->Amount,
    'AccountId' => 1,
    'MoneyReciveBy' => $request->CreditedFromId,
    'VoucharNo' => $request->VoucharNo,
    'Discount' => $request->Discount,
    'CreateById' => $creator,
    'CustId' => $request->modal_id,
    'TranId' => 1,
    'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
    ]);
    // Redirect Back
    if($insert){
    CustomerInfo::where('CustId',$request->Customer)->update([
        'DueAmount' => 00,
        'updated_at' => Carbon::now(),
    ]);
    $notification=array(
        'message'=>'Successfully Store Customer Payment Information',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
    }
}


  /* ============== insert Employee Information in DATABASE ============== */
  public function store(Request $request){
    // dd($request->all());
    $currentDue = ( $request->CurrentDue - ($request->PayAmount + $request->Discount) );
    $creator = Auth::user()->id;
    /* data insert */



    $request['TranAmount'] = $request->PayAmount;
    $request['TranTypeId'] = 1;

    $transObj = new  TransactionsController();
    $transId = $transObj->createNewTransaction($request); 
    

    $request['Amount'] = $request->PayAmount;
    $request['TranId'] = $transId;
    $request['ChartOfAcctId'] = 1;
    $request['DrCrTypeId'] = 1;

    $decrObj = new  DebitCreditController();
    $drcrId = $decrObj->insertNewDebitCreditTransaction($request); 


    $insert = CustomerPayment::insert([
      'PaymentDate' => $request->PaymentDate,
      'PaymentAmount' => $request->PayAmount,
      'AccountId' => 1,
      'MoneyReciveBy' => $request->MoneyReciveBy,
      'VoucharNo' => $request->VoucharNo,
      'Discount' => $request->Discount,
      'CreateById' => $creator,
      'CustId' => $request->Customer,
      'TranId' => 1,
      'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
    ]);
    // Redirect Back
    if($insert){
      CustomerInfo::where('CustId',$request->Customer)->update([
        'DueAmount' => $currentDue,
        'updated_at' => Carbon::now(),
      ]);
      $notification=array(
          'message'=>'Successfully Store Employee Information',
          'alert-type'=>'success'
      );
      return Redirect()->back()->with($notification);
    }
  }

  
  /* ============== update Employee Information in DATABASE ============== */
  public function update(Request $request){

    
    // $currentDue = ( $request->CurrentDue - ($request->PayAmount + $request->Discount) );
    $creator = Auth::user()->id;

    $request['TranAmount'] = $request->PayAmount;
    $request['TranTypeId'] = 1;

    $transObj = new  TransactionsController();
    $transId = $transObj->createNewTransaction($request); 
    

    $request['Amount'] = $request->PayAmount;
    $request['TranId'] = $transId;
    $request['ChartOfAcctId'] = 1;
    $request['DrCrTypeId'] = 1;

    $decrObj = new  DebitCreditController();
    $drcrId = $decrObj->insertNewDebitCreditTransaction($request); 

    /* data insert */
    $update = CustomerPayment::where('CustPaymId',$request->Customer)->update([
      'PaymentDate' => date('Y-m-d',strtotime($request->PaymentDate)),
      'PaymentAmount' => $request->PayAmount,
      'AccountId' => 1,
      'MoneyReciveBy' => 1,
      'VoucharNo' => $request->VoucharNo,
      'Discount' => $request->Discount,
      'CreateById' => $creator,
      'CustId' => $request->Customer,
      'TranId' => 1,
      'updated_at' => Carbon::now(),
    ]);
    // Redirect Back
    if($update){
      CustomerInfo::where('CustId',$request->Customer)->update([
        'DueAmount' => $request->PayAmount,
        'updated_at' => Carbon::now(),
      ]);
      $notification=array(
          'message'=>'Successfully Update payment Information',
          'alert-type'=>'success'
      );
      return Redirect()->back()->with($notification);
    }
  }




  /*
  |--------------------------------------------------------------------------
  |  BLADE OPERATION
  |--------------------------------------------------------------------------
  */

 






  /*
  |--------------------------------------------------------------------------
  |  API OPERATION
  |--------------------------------------------------------------------------
  */







  /* ======== end class bracket ======== */
}
