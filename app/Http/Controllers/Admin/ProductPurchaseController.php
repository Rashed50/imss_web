<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductPurchase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class ProductPurchaseController extends Controller{

    public function add(){
       $purchaseProduct = ProductPurchase::where('status',true)->orderBy('ProdPurcId','DESC')->get();
        return view('admin.purchase.add', compact('purchaseProduct'));
    }

    public function edit($id){
        $data = ProductPurchase::where('status',true)->where('ProdPurcId',$id)->firstOrFail();
        $purchaseProduct = ProductPurchase::where('status',true)->orderBy('ProdPurcId','DESC')->get();
        return view('admin.purchase.add', compact('data', 'purchaseProduct'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'CateName'=>'required|max:200'
        ],[
            'CateName.required'=> 'please enter product purchase name',
            'CateName.max'=> 'max product purchase name content is 200 character'
        ]);

        $insert = ProductPurchase::insertGetId([
            'TransactionId'=>$request['TransactionId'],
            'TotalPrice'=>$request['TotalPrice'],
            'PurchaseDate'=>$request['PurchaseDate'],
            'VendorId'=>$request['VendorId'],
            'StaffId'=>$request['StaffId'],
            'LabourCost'=>$request['LabourCost'],
            'PaymentType'=>$request['PaymentType'],
            'BankId'=>$request['BankId'],
            'Discount'=>$request['Discount'],
            'CarringCost'=>$request['CarringCost'],
            'ToSaleId'=>$request['ToSaleId'],
            'DoNo'=>$request['DoNo'],
            'TruckNo'=>$request['TruckNo'],
            'CreateById'=>$request['CreateById'],
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new product purchase store Successfully.');
                return redirect()->route('product.purchase.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

    public function update(Request $request){
        $id= $request->ProdPurcId;
        $this->validate($request,[
            'CateName'=>'required|max:200',
        ],[
            'CateName.required'=> 'please enter product purchase name',
            'CateName.max'=> 'max product purchase name content is 200 character'
        ]);

        $update = ProductPurchase::where('status',true)->where('ProdPurcId',$id)->update([
            'CateName'=>$request['CateName'],
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($update){
            Session::flash('success','product purchase updated Successfully.');
                return redirect()->route('product.purchase.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
