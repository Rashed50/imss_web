<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DataLayers\ItemsDataService;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;


class CategoryController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    public function getAll(){
      return $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
    }


    public function add(){
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
        return view('admin.category.add', compact('allCate'));
    }

    public function edit($id){
        $data = Category::where('CateStatus',true)->where('CateId',$id)->firstOrFail();
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
        return view('admin.category.add', compact('data', 'allCate'));
    }

    public function delete($id){
        $delete = Category::where('CateStatus',true)->where('CateId',$id)->delete();
        if($delete){
            Session::flash('delete', 'Category delete');
        }else{
            Session::flash('error', 'please try again.'); 
        }
        return redirect()->back();
    }

    public function store(Request $request){
        $this->validate($request,[
            'CateName'=>'required|unique:categories,CateName|max:200',
            'CateBlName'=>'required|unique:categories,CateBlName|max:200'
        ],[
            'CateName.required'=> 'please enter category name',
            'CateName.max'=> 'max category name content is 200 character',
            'CateName.unique' => 'this category name already exists! please another name',
            'CateBlName.required'=>'please enter categoryBL name',
            'CateBlName.max'=> 'max categoryBL name content is 200 character',
        ]);
        $catName=strtolower($request->CateName);
        
        $insert = Category::insertGetId([
            'CateName'=>$catName,
            'CateBlName'=>$request['CateBlName'],
            
        ]);

        if($insert){
            Session::flash('success','new category store Successfully.');
                return redirect()->route('category.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

    public function update(Request $request){
        $id= $request->CateId;
        $this->validate($request,[
            'CateName'=>'required|max:200|unique:categories,CateName,'.$id.',CateId',
            'CateBlName'=>'required|unique:categories,CateBlName|max:200',
        ],[
            'CateName.required'=> 'please enter category name',
            'CateName.max'=> 'max category name content is 200 character',
            'CateName.unique' => 'this category name already exists! please another name',
            'CateBlName.required'=>'please enter categoryBL name',
            'CateBlName.max'=> 'max categoryBL name content is 200 character',
        ]);

        $insert = Category::where('CateStatus',true)->where('CateId',$id)->update([
            'CateName'=>$request['CateName'],
            'CateBlName'=>$request['CateBlName'],
        ]);

        if($insert){
            Session::flash('success','category updated Successfully.');
                return redirect()->route('category.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }


}
