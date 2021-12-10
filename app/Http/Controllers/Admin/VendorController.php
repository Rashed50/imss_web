<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\AccountTypeController;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class VendorController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    public function getAll(){
      return $allVendor = Vendor::where('ActiveStatus',true)->orderBy('VendId','DESC')->get();
    }
 

    public function add(){
       $allVendor= $this->getAll();

       $AcTypeOBJ= new AccountTypeController;
       $allType=$AcTypeOBJ->getAll();

       $bankOBJ= new BankController;
       $allBank= $bankOBJ->getAll();
        return view('admin.vendor.add', compact('allVendor', 'allBank', 'allType'));
    }

    public function edit($id){
        $allVendor= $this->getAll();

        $AcTypeOBJ= new AccountTypeController;
        $allType=$AcTypeOBJ->getAll();

        $bankOBJ= new BankController;
        $allBank= $bankOBJ->getAll();
        $data = Vendor::where('ActiveStatus',true)->where('VendId',$id)->firstOrFail();
        return view('admin.vendor.add', compact('data', 'allVendor', 'allBank', 'allType'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'VendName'=>'required|max:100',
            'ContactName'=>'required|max:70',
            'Mobile1'=>'required|max:20',
            'OpeningDate'=>'required|max:20',
            'Balance'=>'required|max:15',
            'InitialBalance'=>'required|max:15',
            'ChartOfAcctId'=>'required|max:20',
            'VendAddress'=>'required|max:200',
        ],[
            'VendName.required'=> 'please enter vendor name',
            'VendName.max'=> 'max vendor name content is 100 character',

            'ContactName.required'=> 'please enter contact name',
            'ContactName.max'=> 'max contact name content is 70 character',

            'Mobile1.required'=> 'please enter vendor mobile',
            'Mobile1.max'=> 'max vendor mobile content is 20 character',

            'OpeningDate.required'=> 'please enter opening date',
            'OpeningDate.max'=> 'max opening date content is 20 character',

            'Balance.required'=> 'please enter Balance',
            'Balance.max'=> 'max Balance content is 15 character',

            'InitialBalance.required'=> 'please enter Initial Balance',
            'InitialBalance.max'=> 'max Initial Balance content is 15 character',

            'ChartOfAcctId.required'=> 'please enter Accountant name',
            'ChartOfAcctId.max'=> 'max Accountant name content is 20 character',

            'VendAddress.required'=> 'please enter vendor address',
            'VendAddress.max'=> 'max vendor address content is 200 character',
            'VendName.unique' => 'this vendor name already exists! please another name',
        ]);


        $request['ChartOfAcctName'] = $request['VendName'];
        $request['ChartOfAcctNumber'] = '38439842';
        $request['BankAcctNumber'] = $request['AccountNo'];
        $request['BankId'] = $request['BankId'];
        $request['AcctTypeId'] = $request['AcctTypeId'];
        $request['BankAcctTypeId'] =1 ;

       $chartOfAcc = new  ChartOfAccountController();
       $vendorAccId = $chartOfAcc->addNewChartOfAccount($request);

       

        $date = date('Y-m-d', strtotime($request->OpeningDate));
        $insert = Vendor::insertGetId([
            'VendName'=>$request['VendName'],
            'ContactName'=>$request['ContactName'],
            'Mobile1'=>$request['Mobile1'],
            'OpeningDate'=>$date,
            'Balance'=>$request['Balance'],
            'InitialBalance'=>$request['InitialBalance'],
            'ChartOfAcctId'=> $vendorAccId ,//request['ChartOfAcctId'],
            'VendAddress'=>$request['VendAddress'],
            'CreateById' => 1,
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new vendor store Successfully.');
                return redirect()->route('vendor.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

    public function update(Request $request){
        $this->validate($request,[
            'VendName'=>'required|max:100',
            'ContactName'=>'required|max:70',
            'Mobile1'=>'required|max:20',
            'OpeningDate'=>'required|max:20',
            'Balance'=>'required|max:15',
            'InitialBalance'=>'required|max:15',
            'ChartOfAcctId'=>'required|max:20',
            'VendAddress'=>'required|max:200',
        ],[
            'VendName.required'=> 'please enter vendor name',
            'VendName.max'=> 'max vendor name content is 100 character',

            'ContactName.required'=> 'please enter contact name',
            'ContactName.max'=> 'max contact name content is 70 character',

            'Mobile1.required'=> 'please enter vendor mobile',
            'Mobile1.max'=> 'max vendor mobile content is 20 character',

            'OpeningDate.required'=> 'please enter opening date',
            'OpeningDate.max'=> 'max opening date content is 20 character',

            'Balance.required'=> 'please enter Balance',
            'Balance.max'=> 'max Balance content is 15 character',

            'InitialBalance.required'=> 'please enter Initial Balance',
            'InitialBalance.max'=> 'max Initial Balance content is 15 character',

            'ChartOfAcctId.required'=> 'please enter Accountant name',
            'ChartOfAcctId.max'=> 'max Accountant name content is 20 character',

            'VendAddress.required'=> 'please enter vendor address',
            'VendAddress.max'=> 'max vendor address content is 200 character',
            'VendName.unique' => 'this vendor name already exists! please another name',
        ]);

        $date = date('Y-m-d', strtotime($request->OpeningDate));
        $id= $request->VendId;
        $update = Vendor::where('ActiveStatus',true)->where('VendId',$id)->update([
            'VendName'=>$request['VendName'],
            'ContactName'=>$request['ContactName'],
            'Mobile1'=>$request['Mobile1'],
            'OpeningDate'=>$date,
            'Balance'=>$request['Balance'],
            'InitialBalance'=>$request['InitialBalance'],
            'ChartOfAcctId'=>$request['ChartOfAcctId'],
            'VendAddress'=>$request['VendAddress'],
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($update){
            Session::flash('success','vendor update Successfully.');
                return redirect()->route('vendor.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }





    public function updateVendorBalance($vendorId,$amount)
    {
            $aVendor = Vendor::where('VendId',$vendorId)->first();
            $aVendor->Balance = $aVendor->Balance + $amount;
            $aVendor = Vendor::where('VendId',$vendorId)->update([
                'Balance'=>$aVendor->Balance,
            ]);
    }

    public function updateProductStockByCategoryBrandSizeThicknessId($categoryId,$branId,$sizeId,$thicId,$quantity){

        $Stock = Stock::where('CateId',$categoryId)->where('BranId',$branId)->where('SizeId',$sizeId)->where('ThicId',$thicId)->first();

            if($Stock != null){  
                    $id= $Stock->StocId;
                    $totalStock= $Stock->StocValue + $quantity;
                    $sameUpdate = Stock::where('StocId',$id)->update([
                        'StocValue'=>$totalStock,
                    ]);
            }else {

                $insert = Stock::insertGetId([
                    'CateId'=>$categoryId,
                    'BranId'=>$branId,
                    'SizeId'=>$sizeId,
                    'ThicId'=>$thicId,
                    'StocValue'=>$quantity
                ]);
            }
    }


}
