<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thickness;
use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class ThicknessController extends Controller{

    public function add(){
       $allThickness = Thickness::with('sizeInfo')->where('ThicStatus',true)->orderBy('ThicId','DESC')->get();
       $allSize = Size::where('SizeStatus',true)->orderBy('SizeName','ASC')->get();
       return view('admin.thickness.add', compact('allThickness', 'allSize'));
    }

    public function edit($id){
        $data = Thickness::with('sizeInfo')->where('ThicStatus',true)->where('ThicId',$id)->firstOrFail();
        $allThickness = Thickness::with('sizeInfo')->where('ThicStatus',true)->orderBy('ThicId','DESC')->get();
        $allSize = Size::where('SizeStatus',true)->orderBy('SizeName','ASC')->get();
        return view('admin.thickness.add', compact('data', 'allThickness', 'allSize'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'ThicName'=>'required|unique:thicknesses,ThicName|max:150',
            'SizeId'=>'required',
        ],[
            'ThicName.required'=> 'please enter thickness name',
            'SizeId.required'=> 'please select size name',
            'ThicName.max'=> 'max thickness name content is 150 character',
            'ThicName.unique' => 'this thickness name already exists! please another name',
        ]);

        $insert = Thickness::insertGetId([
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

}
