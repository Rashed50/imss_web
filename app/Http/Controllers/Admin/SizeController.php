<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class SizeController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    // ajax Method
    public function brandWiseSize(Request $request){
      $getSize = Size::where('BranId',$request->BranId)->get();
      return json_encode($getSize);
    }
    // ajax Method




    public function add(){
       $allSize = Size::with('cateInfo','brandInfo')->where('SizeStatus',true)->orderBy('SizeId','DESC')->get();
       $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
       return view('admin.size.add', compact('allSize', 'allCate'));
    }

    public function edit($id){
        $data = Size::with('cateInfo','brandInfo')->where('SizeStatus',true)->where('SizeId',$id)->firstOrFail();
        $allSize = Size::with('cateInfo','brandInfo')->where('SizeStatus',true)->orderBy('SizeId','DESC')->get();
        $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
        return view('admin.size.add', compact('data', 'allSize', 'allCate'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'SizeName'=>'required|unique:sizes,SizeName|max:150',
            'BranId'=>'required',
            'CateId'=>'required',
        ],[
            'SizeName.required'=> 'please enter size name',
            'BranId.required'=> 'please select brand name',
            'SizeName.max'=> 'max size name content is 150 character',
            'SizeName.unique' => 'this size name already exists! please another name',
        ]);

        $insert = Size::insertGetId([
            'CateId'=>$request['CateId'],
            'BranId'=>$request['BranId'],
            'SizeName'=>$request['SizeName'],
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new size store Successfully.');
                return redirect()->route('size.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }


    public function update(Request $request){
        $id= $request->SizeId;
        $this->validate($request,[
            'SizeName'=>'required|max:150|unique:sizes,SizeName,'.$id.',SizeId',
            'BranId'=>'required',
            'CateId'=>'required',
        ],[
            'SizeName.required'=> 'please enter size name',
            'CateId.required'=> 'please select category name',
            'BranId.required'=> 'please select brand name',
            'SizeName.max'=> 'max size name content is 150 character',
            'SizeName.unique' => 'this size name already exists! please another name',
        ]);

        $insert = Size::where('SizeStatus',true)->where('SizeId',$id)->update([
            'CateId'=>$request['CateId'],
            'BranId'=>$request['BranId'],
            'SizeName'=>$request['SizeName'],
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','size update Successfully.');
                return redirect()->route('size.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
