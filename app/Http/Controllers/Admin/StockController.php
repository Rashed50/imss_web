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
       $allStock = Stock::with('cateInfo', 'brandInfo', 'sizeInfo', 'thickInfo')->orderBy('StocId','DESC')->get();
       return view('admin.stock.add', compact('allStock', 'allCate'));
    }

    public function getBrand($id){
         $data = Brand::where('BranStatus',true)->where('CateId',$id)->orderBy('BranName','DESC')->get();
        return response()->json($data);
    }

    public function getSize($id){
         $data = Size::where('SizeStatus',true)->where('BranId',$id)->orderBy('SizeName','DESC')->get();
        return response()->json($data);
    }

    public function getThick($id){
         $data = Thickness::where('ThicStatus',true)->where('SizeId',$id)->orderBy('ThicName','DESC')->get();
        return response()->json($data);
    }

    public function edit($id){
        $allStock = Stock::with('cateInfo', 'brandInfo', 'sizeInfo', 'thickInfo')->orderBy('StocId','DESC')->get();
        $data = Stock::with('cateInfo', 'brandInfo', 'sizeInfo', 'thickInfo')->where('StocId',$id)->firstOrFail();
        $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
        return view('admin.stock.add', compact('data','allCate', 'allStock'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'StocValue'=>'required|max:30',
            'CateId'=>'required',
            'BranId'=>'required',
            'SizeId'=>'required',
            'ThicId'=>'required',
        ],[
            'StocValue.required'=> 'please enter stock amount',
            'CateId.required'=> 'please select category name',
            'BranId.required'=> 'please select brand name',
            'SizeId.required'=> 'please select size',
            'ThicId.required'=> 'please select thickness',
            'StocValue.max'=> 'max stock amount content is 30 number',
        ]);

        $insert = Stock::insertGetId([
            'CateId'=>$request['SizeId'],
            'BranId'=>$request['BranId'],
            'SizeId'=>$request['SizeId'],
            'ThicId'=>$request['ThicId'],
            'StocValue'=>$request['StocValue'],
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new stock amount store Successfully.');
                return redirect()->route('stock.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
