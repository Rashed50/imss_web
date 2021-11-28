<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EmployeeInfoController;
use Illuminate\Http\Request;
use App\Models\CustomerPayment;
use App\Models\CustomerInfo;
use Carbon\Carbon;
use Auth;

class CustomerPaymentController extends Controller{
  /*
  |--------------------------------------------------------------------------
  |  DATABASE OPERATION
  |--------------------------------------------------------------------------
  */

  public function getAllPaymentCustomer(){
    return $all = CustomerPayment::orderBy('CustId','DESC')->get();
  }

  public function findPaymentCustomer($id){
    return $data = CustomerPayment::where('CustPaymId',$id)->first();
  }

  public function delete($id){
    CustomerPayment::where('CustPaymId',$id)->delete();
    $notification=array(
        'message'=>'Successfully Delete Employee Information',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
  }

  /* ============== insert Employee Information in DATABASE ============== */
  public function store(Request $request){
    // dd($request->all());
    $currentDue = ( $request->CurrentDue - ($request->PayAmount + $request->Discount) );
    $creator = Auth::user()->id;
    /* data insert */
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
      'created_at' => Carbon::now(),
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
    $currentDue = ( $request->CurrentDue - ($request->PayAmount + $request->Discount) );
    $creator = Auth::user()->id;
    /* data insert */
    $update = CustomerPayment::where('CustPaymId',$request->id)->update([
      'PaymentDate' => $request->PaymentDate,
      'PaymentAmount' => $request->PayAmount,
      'AccountId' => 1,
      'MoneyReciveBy' => $request->MoneyReciveBy,
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
        'DueAmount' => $currentDue,
        'updated_at' => Carbon::now(),
      ]);
      $notification=array(
          'message'=>'Successfully Update Employee Information',
          'alert-type'=>'success'
      );
      return Redirect()->route('customer.payment')->with($notification);
    }
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
    $data = $this->findPaymentCustomer($id);
    // Call Employee Controller
    $employeeOBJ = new EmployeeInfoController();
    $employee = $employeeOBJ->getAllEmployees();
    return view('admin.customer.payment.edit',compact('employee','data'));
  }






  /*
  |--------------------------------------------------------------------------
  |  API OPERATION
  |--------------------------------------------------------------------------
  */







  /* ======== end class bracket ======== */
}
