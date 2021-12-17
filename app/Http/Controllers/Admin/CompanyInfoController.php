<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\CompanyInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
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

         $this->validate($request,[
             'CompTitle'=>'required|max:150',
             'CompName'=>'required|max:50',
             'ownerName'=>'required|max:150',
             'CompTitle'=>'required|max:150',
         ],[
             
         ]);
 
         $insert = CompanyInfo::insertGetId([
             'CompTitle'=>$request['CompTitle'],
             'BengleTitle'=>$request['BengleTitle'],
             'CompName'=>$request['CompName'],
             'BengleName'=>$request['BengleName'],
             'CompAddress'=>$request['CompAddress'],
             'Mobile1'=>$request['Mobile1'],
             'Mobile2'=>$request['Mobile2'],
             'Fax'=>$request['Fax'],
             'TelPhone'=>$request['TelPhone'],
             'ownerName'=>$request['ownerName'],
             'Logo'=>'',
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
         $id= $request->CompId;
        $this->validate($request,[
             'CompTitle'=>'required|max:150',
             'CompName'=>'required|max:50',
             'ownerName'=>'required|max:150',
             'CompTitle'=>'required|max:150',
         ],[
             
         ]);
 
         $update = CompanyInfo::where('CompId',$id)->update([
             'CompTitle'=>$request['CompTitle'],
             'BengleTitle'=>$request['BengleTitle'],
             'CompName'=>$request['CompName'],
             'BengleName'=>$request['BengleName'],
             'CompAddress'=>$request['CompAddress'],
             'Mobile1'=>$request['Mobile1'],
             'Mobile2'=>$request['Mobile2'],
             'Fax'=>$request['Fax'],
             'TelPhone'=>$request['TelPhone'],
             'ownerName'=>$request['ownerName'],
             'Logo'=>'',
             'Website'=>$request['Website'],
             'Email'=>$request['Email']
         ]);
 
         if($update){
             // Session::flash('success_up','brand updated Successfully.');
                 return redirect()->route('company.add');
         }else{
             Session::flash('error','please try again.');
                 return redirect()->back();
         }
 
     }
 
}
