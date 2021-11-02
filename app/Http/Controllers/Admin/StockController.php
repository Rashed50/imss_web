<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thickness;
use App\Models\Size;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Stock;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class StockController extends Controller{

    public function add(){
       $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
       $allStock = Stock::orderBy('StocId','DESC')->get();
       return view('admin.stock.add', compact('allStock', 'allCate'));
    }

    public function edit($id){
        $data = Thickness::with('sizeInfo')->where('ThicStatus',true)->where('ThicId',$id)->firstOrFail();
        $allThickness = Thickness::with('sizeInfo')->where('ThicStatus',true)->orderBy('ThicId','DESC')->get();
        $allSize = Size::where('SizeStatus',true)->orderBy('SizeName','ASC')->get();
        return view('admin.stock.add', compact('data', 'allThickness', 'allSize'));
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
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
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
