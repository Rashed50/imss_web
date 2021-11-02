<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class BrandController extends Controller{

    public function add(){
       $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
       $allBrand = Brand::with('cateInfo')->where('BranStatus',true)->orderBy('BranId','DESC')->get();
       return view('admin.brand.add', compact('allCate', 'allBrand'));
    }

    public function edit($id){
        $allBrand = Brand::with('cateInfo')->where('BranStatus',true)->orderBy('BranId','DESC')->get();
        $data = Brand::with('cateInfo')->where('BranStatus',true)->where('BranId',$id)->firstOrFail();
        $allCate = Category::where('CateStatus',true)->orderBy('CateName','ASC')->get();
        return view('admin.brand.add', compact('data', 'allCate', 'allBrand'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'BranName'=>'required|unique:brands,BranName|max:150',
            'CateId'=>'required',
        ],[
            'BranName.required'=> 'please enter brand name',
            'CateId.required'=> 'please select category name',
            'BranName.max'=> 'max brand name content is 150 character',
            'BranName.unique' => 'this brand name already exists! please another name',
        ]);

        $insert = Brand::insertGetId([
            'CateId'=>$request['CateId'],
            'BranName'=>$request['BranName'],
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new brand store Successfully.');
                return redirect()->route('brand.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
