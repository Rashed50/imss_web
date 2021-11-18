<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerInfo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use Image;


class CustomerController extends Controller{

    public function add(){
       $allCustomer = CustomerInfo::where('status',true)->orderBy('CustId','DESC')->get();
        return view('admin.customer.add', compact('allCustomer'));
    }

    public function edit($id){
        $data = CustomerInfo::where('status',true)->where('CustId',$id)->firstOrFail();
        $allCustomer = CustomerInfo::where('status',true)->orderBy('CustId','DESC')->get();
        return view('admin.customer.add', compact('data', 'allCustomer'));
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
        $creator= Auth::user()->id;
        $insert = CustomerInfo::insertGetId([
            'CustName'=>$request['CustName'],
            'TradeName'=>$request['TradeName'],
            'ContactNumber'=>$request['ContactNumber'],
            'Address'=>$request['Address'],
            'DueAmount'=>$request['DueAmount'],
            'InitialDue'=>$request['InitialDue'],
            'FatherName'=>$request['FatherName'],
            'NID'=>$request['NID'],
            'Photo'=>'',
            'CreateById'=>$creator,
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
        if($request->hasFile('Photo')){
            $image = $request->file('Photo');
            $imageName = 'customer_'.$request->CustName.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,200)->save('uploads/customer/'.$imageName);

            CustomerInfo::where('CustId',$insert)->update([
                'Photo'=>$imageName,
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

}
