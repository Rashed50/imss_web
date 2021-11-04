<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class SizeController extends Controller{

    public function add(){
       $allSize = Size::with('brandInfo')->where('SizeStatus',true)->orderBy('SizeId','DESC')->get();
       $allBrand = Brand::where('BranStatus',true)->orderBy('BranName','ASC')->get();
       return view('admin.size.add', compact('allSize', 'allBrand'));
    }

    public function edit($id){
        $data = Size::with('brandInfo')->where('SizeStatus',true)->where('SizeId',$id)->firstOrFail();
        $allSize = Size::with('brandInfo')->where('SizeStatus',true)->orderBy('SizeId','DESC')->get();
        $allBrand = Brand::where('BranStatus',true)->orderBy('BranName','ASC')->get();
        return view('admin.size.add', compact('data', 'allSize', 'allBrand'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'SizeName'=>'required|unique:sizes,SizeName|max:150',
            'BranId'=>'required',
        ],[
            'SizeName.required'=> 'please enter size name',
            'BranId.required'=> 'please select brand name',
            'SizeName.max'=> 'max size name content is 150 character',
            'SizeName.unique' => 'this size name already exists! please another name',
        ]);

        $insert = Size::insertGetId([
            'BranId'=>$request['BranId'],
            'SizeName'=>$request['SizeName'],
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new size store Successfully.');
                return redirect()->route('size.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
