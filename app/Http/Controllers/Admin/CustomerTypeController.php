<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;


class CustomerTypeController extends Controller{

    public function getAll(){
       return $allType = CustomerType::orderBy('CusTypeId','DESC')->get();
    }

    public function add(){
        $allType = $this->getAll();
        return view('admin.customer.type', compact('allType'));
    }

    public function edit($id){
        $allType = $this->getAll();
        $data = $allType->where('CusTypeId',$id)->firstOrFail();
        return view('admin.customer.type', compact('data', 'allType'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'TypeName'=>'required|unique:customer_types,TypeName|max:50'
        ],[
            'TypeName.required'=> 'please enter customer type name',
            'TypeName.max'=> 'max customer type name content is 50 character',
            'TypeName.unique' => 'this customer type already exists! please another name',
        ]);

        $insert = CustomerType::insertGetId([
            'TypeName'=>$request['TypeName'],
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new customer type store Successfully.');
                return redirect()->route('customer.type.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

    public function update(Request $request){
        $id= $request->CusTypeId;

        $this->validate($request,[
            'TypeName'=>'required|max:50|unique:customer_types,TypeName,'.$id.',CusTypeId',
        ],[
            'TypeName.required'=> 'please enter customer type name',
            'TypeName.max'=> 'max customer type name content is 50 character',
            'TypeName.unique' => 'this customer type already exists! please another name',
        ]);

        $update = CustomerType::where('CusTypeId',$id)->update([

            'TypeName'=>$request['TypeName']
        ]);
        if($update){
            Session::flash('success','customer type updated Successfully.');
                return redirect()->route('customer.type.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
