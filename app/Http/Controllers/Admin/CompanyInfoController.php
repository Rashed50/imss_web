<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\CompanyInfo;
use Carbon\Carbon;
use Session;
use Image;

class CompanyInfoController extends Controller{
    public function add(){
        $allCom = CompanyInfo::orderBy('CompId','ASC')->get();
        return view('admin.company.add', compact('allCom'));
     }
 
     public function edit($id){
         $allCom = CompanyInfo::orderBy('CompId','ASC')->get();
         $data = CompanyInfo::where('CompId',$id)->firstOrFail();
         return view('admin.company.add', compact('data', 'allCom'));
     }
 
     public function store(Request $request){
        //  $this->validate($request,[
        //      'BranName'=>'required|unique:brands,BranName|max:150',
        //      'CateId'=>'required',
        //  ],[
        //      'BranName.required'=> 'please enter brand name',
        //      'CateId.required'=> 'please select category name',
        //      'BranName.max'=> 'max brand name content is 150 character',
        //      'BranName.unique' => 'this brand name already exists! please another name',
        //  ]);
 
         $insert = CompanyInfo::insertGetId([
             'CompTitle'=>$request['title'],
             'BengleTitle'=>$request['bengleTitle'],
             'CompName'=>$request['name'],
             'BengleName'=>$request['bengleName'],
             'CompAddress'=>$request['address'],
             'Mobile1'=>$request['Mobile1'],
             'Mobile2'=>$request['Mobile2'],
             'Mobile3'=>$request['Mobile3'],
             'Logo'=>$request['Logo'],
             'Website'=>$request['Website'],
             'Email'=>$request['Email'],
             //'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
         ]);
 
         if($insert){
             Session::flash('success','new company info store Successfully.');
                 return redirect()->route('company.add');
         }else{
             Session::flash('error','please try again.');
                 return redirect()->back();
         }
 
     }
 
 
     public function update(Request $request){
         $id= $request->BranId;
        //  $this->validate($request,[
        //      'BranName'=>'required|max:150|unique:brands,BranName,'.$id.',BranId',
        //      'CateId'=>'required',
        //  ],[
        //      'BranName.required'=> 'please enter brand name',
        //      'CateId.required'=> 'please select category name',
        //      'BranName.max'=> 'max brand name content is 150 character',
        //      'BranName.unique' => 'this brand name already exists! please another name',
        //  ]);
 
         $update = CompanyInfo::where('CompId',$id)->update([
            'CompTitle'=>$request['title'],
            'BengleTitle'=>$request['bengleTitle'],
            'CompName'=>$request['name'],
            'BengleName'=>$request['bengleName'],
            'CompAddress'=>$request['address'],
            'Mobile1'=>$request['Mobile1'],
            'Mobile2'=>$request['Mobile2'],
            'Mobile3'=>$request['Mobile3'],
            'Logo'=>$request['Logo'],
            'Website'=>$request['Website'],
            'Email'=>$request['Email'],
             //'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
         ]);
 
         if($update){
             Session::flash('success','brand updated Successfully.');
                 return redirect()->route('brand.add');
         }else{
             Session::flash('error','please try again.');
                 return redirect()->back();
         }
 
     }
 
}
