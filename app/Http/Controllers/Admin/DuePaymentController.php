<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\DebitCreditController;
use App\Http\Controllers\Admin\EmployeeInfoController;
use App\Models\CustomerPayment;
use App\Models\CustomerInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DuePaymentController extends Controller{
    

    



      public function getAllPaymentCustomer(){
        return $all = CustomerPayment::orderBy('CustId','DESC')->get();
      }
    
      public function findPaymentCustomer($id){
        return $data = CustomerPayment::where('CustPaymId',$id)->first();
      }
      
      public function add(){
        $getAllPaymentCustomer = $this->getAllPaymentCustomer();
        // Call Employee Controller
        $employeeOBJ = new EmployeeInfoController();
        $employee = $employeeOBJ->getAllEmployees();
        return view('admin.payment.due',compact('employee','getAllPaymentCustomer'));
      }
    
      public function edit($id){
        $data = $this->findPaymentCustomer($id);
        $getAllPaymentCustomer = $this->getAllPaymentCustomer();
        // Call Employee Controller
        $employeeOBJ = new EmployeeInfoController();
        $employee = $employeeOBJ->getAllEmployees();
        return view('admin.payment.due',compact('employee','data', 'getAllPaymentCustomer'));
      }

      public function delete($id){
        CustomerPayment::where('CustPaymId',$id)->delete();
        $notification=array(
            'message'=>'Successfully Delete Employee Information',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
      }



      public function store(Request $request){
        // dd($request->all());
        $currentDue = ( $request->CurrentDue - ($request->PayAmount + $request->Discount) );
        $creator = Auth::user()->id;
        /* data insert */
    
    
     
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
    
}
