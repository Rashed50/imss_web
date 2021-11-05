<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class CategoryController extends Controller{

    public function add(){
       $allCate = Category::where('CateStatus',true)->orderBy('CateId','DESC')->get();
        return view('admin.category.add', compact('allCate'));
    }

    public function edit($id){
        $data = Category::where('CateStatus',true)->where('CateId',$id)->firstOrFail();
        $allCate = Category::where('CateStatus',true)->orderBy('CateId','DESC')->get();
        return view('admin.category.add', compact('data', 'allCate'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'CateName'=>'required|unique:categories,CateName|max:200'
        ],[
            'CateName.required'=> 'please enter category name',
            'CateName.max'=> 'max category name content is 200 character',
            'CateName.unique' => 'this category name already exists! please another name',
        ]);

        $insert = Category::insertGetId([
            'CateName'=>$request['CateName'],
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new category store Successfully.');
                return redirect()->route('category.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
