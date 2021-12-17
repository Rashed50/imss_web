<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;

class DivisionController extends Controller{
    
    public function getAll(){
      return $all = Division::orderBy('DiviId','DESC')->get();
    }

    public function add(){
        $allDiv = $this->getAll();
        return view('admin.address.division', compact('allDiv'));
    }

    public function edit($id){
        $allDiv = $this->getAll();
        $data = $allDiv->where('DiviId',$id)->firstOrFail();
        return view('admin.address.division', compact('data', 'allDiv'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'DiviName'=>'required|unique:divisions,DiviName|max:50'
        ],[
            'DiviName.required'=> 'please enter division name',
            'DiviName.max'=> 'max division name content is 50 character',
            'DiviName.unique' => 'this division already exists! please another name',
        ]);

        $Division= strtolower($request->DiviName);
        $insert = Division::insertGetId([
            'DiviName'=>$Division,
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new division name store Successfully.');
                return redirect()->route('division.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }


    public function update(Request $request){
        $id= $request->DiviId;
        $this->validate($request,[
            'DiviName'=>'required|max:50|unique:divisions,DiviName,'.$id.',DiviId'
        ],[
            'DiviName.required'=> 'please enter division name',
            'DiviName.max'=> 'max division name content is 50 character',
            'DiviName.unique' => 'this division already exists! please another name',
        ]);
        $Division= strtolower($request->DiviName);
        $update = Division::where('DiviId',$id)->update([
            'DiviName'=>$Division,
        ]);

        if($update){
            Session::flash('success','division name update Successfully.');
                return redirect()->route('division.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }

}
