<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeInformation;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\DebitCreditController;
use App\Models\CrType;
use App\Models\CrVoucher;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class CreditVoucherController extends Controller{

    public function getAll(){
        return $data= CrVoucher::orderBy('CrVoucId','DESC')->get();
      }

      
    public function index(){
        $allDrVouchar = $this->getAll();

        $TType=CrType::orderBy('CrTypeName','ASC')->get();
        $getAllEmployees= EmployeeInformation::orderBy('EmplInfoId','DESC')->get();
       return view('admin.voucher.credit.add', compact('getAllEmployees', 'TType', 'allDrVouchar'));
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

        $insert= CrVoucher::insertGetId([
            'TransactionId'=>$transId,
            'CrTypeId'=>$request['CrTypeId'],
            'ExpenseDate'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
            'Amount'=>$request['Amount'],
            'DebitedTold'=>1,
            'CreditedFromId'=>$request['Credited'],
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
}
