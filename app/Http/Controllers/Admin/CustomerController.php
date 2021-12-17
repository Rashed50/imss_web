<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\DistrictController;
use Illuminate\Http\Request;
use App\Models\CustomerInfo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Admin\DivisionController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Image;


class CustomerController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    public function getAllCustomer(){
      return $allCustomer = CustomerInfo::where('status',true)->orderBy('CustId','DESC')->get();
    }

    public function getAllWholeCustomer(){
      return $allCustomer = CustomerInfo::where('status',true)->where('CustTypeId',1)->get();
    }

    public function getRetailCustomer(){
      return $allCustomer = CustomerInfo::where('status',true)->where('CustTypeId',2)->get();
    }

    // Holeseller Customer
    public function holesellerCustomer(){
       $holeseller = CustomerInfo::where('CustTypeId',1)->get();
       return json_encode($holeseller);
    }
    // Retailer Customer
    public function retailerCustomer(){
       $retailer = CustomerInfo::where('CustTypeId',2)->get();
       return json_encode($retailer);
    }
    // Define Customer Due
    public function DefineCustomerDue(Request $request){
       $customerDue = CustomerInfo::where('CustId',$request->Customer)->pluck('DueAmount');
       return response()->json([ 'customerDue' => $customerDue  ]);
    }

    /* ++++++++++ Vouchar No ++++++++++ */
    public function vouchar(){
      $date = Carbon::now()->format('Ymd');
      $all = CustomerInfo::count();
      return $vouchar ="SEL-".$date.'00'.$all;
    }

    /* ++++++++++++ Ajax Route IN Customer Id Wise Customer information ++++++++++++ */
    public function CustIdWiseCustomerInformation(Request $request){
      $allCustomer = CustomerInfo::where('status',true)->where('CustId',$request->TradeName)->first();
      return json_encode($allCustomer);
    }
    /* ++++++++++++ Ajax Route IN Customer Id Wise Customer information ++++++++++++ */




    public function getAll(){

       return $Customer = CustomerInfo::where('status',true)->orderBy('CustId','DESC')->get();
    }

    public function add(){
        $typeObj= new CustomerTypeController;
        $allType= $typeObj->getAll();

        $DivisionOBJ = new DivisionController();
        $Division = $DivisionOBJ->getAll();

       $allCustomer = $this->getAll();
       return view('admin.customer.add', compact('allCustomer','Division', 'allType'));
    }

    public function edit($id){
        $typeObj= new CustomerTypeController;
        $allType= $typeObj->getAll();

        $DivisionOBJ = new DivisionController();
        $Division = $DivisionOBJ->getAll();

        $allCustomer = $this->getAll();
        $data = $allCustomer->where('status',true)->where('CustId',$id)->firstOrFail();
        return view('admin.customer.add', compact('data', 'allCustomer', 'Division', 'allType'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'CustName'=>'required|max:50',
            'TradeName'=>'required|max:50',
            'ContactNumber'=>'required|max:20',
            'Address'=>'required|max:200',
            'DueAmount'=>'required|max:20',
            'InitialDue'=>'required|max:20',
            'FatherName'=>'required|max:50',
            'NID'=>'required|max:30',
        ],[
            'CateName.required'=> 'please enter customer name',
            'CateName.max'=> 'max customer name content is 200 character',
        ]);

      //  dd($request);

        $creator= Auth::user()->id;
        $insert = CustomerInfo::insertGetId([
            'CustName'=>$request['CustName'],
            'TradeName'=>$request['TradeName'],
            'CustTypeId' => $request['CustTypeId'],
            'ContactNumber'=>$request['ContactNumber'],
            'Address'=>$request['Address'],
            'DueAmount'=>$request['DueAmount'],
            'InitialDue'=>$request['InitialDue'],
            'FatherName'=>$request['FatherName'],
            'NID'=>$request['NID'],
            'Photo'=>'',
            'CreateById'=>$creator,
            "DiviId" => $request['DiviId'],
            "DistId" => $request['DistId'],
            "ThanId" => $request['ThanId'],
            "UnioId" => $request['UnioId'],
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
 


        if($request->hasFile('Photo')){
            $image = $request->file('Photo');
            $imageName = 'customer_'.$request->CustName.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,200)->save('uploads/customer/'.$imageName);
            $saveurl = 'uploads/customer/'.$imageName;

            CustomerInfo::where('CustId',$insert)->update([
                'Photo'=>$saveurl,
            ]);
        }

        if($insert){
            Session::flash('success','new customer add Successfully.');
                return redirect()->route('customer.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

    public function update(Request $request){
        $id= $request->CustId;
        $this->validate($request,[
            'CustName'=>'required|max:50',
            'TradeName'=>'required|max:50',
            'ContactNumber'=>'required|max:20',
            'Address'=>'required|max:200',
            'DueAmount'=>'required|max:20',
            'InitialDue'=>'required|max:20',
            'FatherName'=>'required|max:50',
            'NID'=>'required|max:30',
        ],[
            'CateName.required'=> 'please enter customer name',
            'CateName.max'=> 'max customer name content is 200 character',
        ]);

        $insert = CustomerInfo::where('status',true)->where('CustId',$id)->update([
            'CustName'=>$request['CustName'],
            'TradeName'=>$request['TradeName'],
            'ContactNumber'=>$request['ContactNumber'],
            'Address'=>$request['Address'],
            'DueAmount'=>$request['DueAmount'],
            'InitialDue'=>$request['InitialDue'],
            'FatherName'=>$request['FatherName'],
            'NID'=>$request['NID'],
            // 'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($request->hasFile('Photo')){
            $image = $request->file('Photo');
            $imageName = 'customer_'.$request->CustName.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,200)->save('uploads/customer/'.$imageName);

            CustomerInfo::where('CustId',$id)->update([
                'Photo'=>$imageName,
            ]);
        }

        if($insert){
            Session::flash('success','customer information updated Successfully.');
                return redirect()->route('customer.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }


    // Wholeseller customer
    public function updateCustomerBalance($customerId,$amount)
    {
            $aCust = CustomerInfo::where('CustId',$customerId)->first();
            $aCust->DueAmount = $aCust->DueAmount + $amount;
           
            $aCust = CustomerInfo::where('CustId',$customerId)->update([
                'DueAmount'=>$aCust->DueAmount,
            ]);
    }

    // 
    public function updateRetailerCustomerBalance($customerId,$amount,$customerName,$cusTrade,$phone,$address)
    {

        if($customerId != null){ 
            $aCust = CustomerInfo::where('CustId',$customerId)->first();
            $aCust->DueAmount = $aCust->DueAmount + $amount;
           
              return  $aCust = CustomerInfo::where('CustId',$customerId)->update([
                'DueAmount'=>$aCust->DueAmount,
            ]);
        }else {
            $creator = Auth::user()->id;
          return  $insert = CustomerInfo::insertGetId([
                'CustName'=>$customerName,
                'TradeName'=>$cusTrade,
                'CustTypeId' => 2, 
                'ContactNumber'=>$phone,
                'Address'=>$address,
                'DueAmount'=>$amount,
                'InitialDue'=>$amount,
                'FatherName'=>'',
                'NID'=>'',
                'Photo'=>'',
                'CreateById'=>$creator,
                "DiviId" => 1,
                "DistId" => 1,
                "ThanId" => 1,
                "UnioId" => 1,
                'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);
        }
    }



}
