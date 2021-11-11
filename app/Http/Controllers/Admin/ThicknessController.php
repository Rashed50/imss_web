<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thickness;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class ThicknessController extends Controller{

    public function add(){
       $allThickness = Thickness::with('cateInfo','brandInfo','sizeInfo')->where('ThicStatus',true)->orderBy('ThicId','DESC')->get();
       $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
       return view('admin.thickness.add', compact('allThickness', 'allCate'));
    }

    public function edit($id){
        $data = Thickness::with('cateInfo','brandInfo','sizeInfo')->where('ThicStatus',true)->where('ThicId',$id)->firstOrFail();
        $allThickness = Thickness::with('cateInfo','brandInfo','sizeInfo')->where('ThicStatus',true)->orderBy('ThicId','DESC')->get();
        $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
        return view('admin.thickness.add', compact('data', 'allThickness', 'allCate'));
    }


    public function store(Request $request){
        $this->validate($request,[
            'ThicName'=>'required|max:150|unique:thicknesses,ThicName',
            'CateId'=>'required',
            'BranId'=>'required',
            'SizeId'=>'required',
        ],[
            'ThicName.required'=> 'please enter thickness name',
            'SizeId.required'=> 'please select size name',
            'ThicName.max'=> 'max thickness name content is 150 character',
            'ThicName.unique' => 'this thickness name already exists! please another name',
        ]);


        $insert = Thickness::insertGetId([
            'CateId'=>$request['CateId'],
            'BranId'=>$request['BranId'],
            'SizeId'=>$request['SizeId'],
            'ThicName'=>$request['ThicName'],
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new thickness store Successfully.');
                return redirect()->route('thickness.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

    public function update(Request $request){
        $id= $request->ThicId;
        $this->validate($request,[
            'ThicName'=>'required|max:150|unique:thicknesses,ThicName,'.$id.',ThicId',
            'CateId'=>'required',
            'BranId'=>'required',
            'SizeId'=>'required',
        ],[
            'ThicName.required'=> 'please enter thickness name',
            'SizeId.required'=> 'please select size name',
            'ThicName.max'=> 'max thickness name content is 150 character',
            'ThicName.unique' => 'this thickness name already exists! please another name',
        ]);


        $update = Thickness::where('ThicStatus',true)->where('ThicId',$id)->update([
            'CateId'=>$request['CateId'],
            'BranId'=>$request['BranId'],
            'SizeId'=>$request['SizeId'],
            'ThicName'=>$request['ThicName'],
            'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($update){
            Session::flash('success','thickness update Successfully.');
                return redirect()->route('thickness.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
