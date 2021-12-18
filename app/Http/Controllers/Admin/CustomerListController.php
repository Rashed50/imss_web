<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DivisionController;
use App\Models\CustomerInfo;
use App\Models\CustomerPayment;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\DebitCreditController;
use App\Models\District;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerListController extends Controller{
    
    public function list(){
       // $DivisionOBJ = new DivisionController();
       // $Division = $DivisionOBJ->getAll();
        $districeOBJ= new DistrictController();
        $allDistrict= $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = CustomerInfo::where('status',true)->where('CustTypeId',1)->get();
        return view('admin.customer.list.index', compact('allDistrict', 'allCustomer'));
    }

    public function search(Request $request){
        // dd($request->all());

        // $DivisionOBJ = new DivisionController();
        // $Division = $DivisionOBJ->getAll();

        $districeOBJ= new DistrictController();
        $allDistrict= $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = CustomerInfo::where('status',true)->where('CustTypeId',$request->type)
        ->orWhere('DistId',$request->DistId)->get(); 
        //where('ThanId',$request->ThanId)->

        return view('admin.customer.list.index', compact('allDistrict', 'allCustomer'));
    }


    public function listForPay(){
        // $DivisionOBJ = new DivisionController();
        // $Division = $DivisionOBJ->getAll();
        $districeOBJ= new DistrictController();
        $allDistrict= $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = CustomerInfo::where('status',true)->where('CustTypeId',1)->get();
        return view('admin.customer.payment.search.index', compact('allDistrict', 'allCustomer'));
    }
    

    public function paymentInfo($id){
        return $allPayment= CustomerPayment::where('CustId',$id)->get();
        return view('admin.customer.payment.payment-info',compact('allPayment'));
    }


        public function paymentStore(Request $request){
            // dd($request->all());

            // $currentDue = ( $request->CurrentDue - ($request->PayAmount + $request->Discount) );
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




}
