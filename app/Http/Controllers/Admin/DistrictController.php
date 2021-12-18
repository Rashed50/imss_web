<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;
use App\Http\Controllers\Admin\DivisionController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;

class DistrictController extends Controller{
    public function getAll(){
      return $all = District::all();
    }

    public function getAllDistrictsByDivisionId($id){
        return $all = District::all()->where('DiviId',$id);
      }


    public function add(){
       $DivisionOBJ = new DivisionController();
       $Division = $DivisionOBJ->getAll();

        $allDist = $this->getAll();
        return view('admin.address.district', compact('Division', 'allDist'));
    }

    public function edit($id){
       $DivisionOBJ = new DivisionController();
       $Division = $DivisionOBJ->getAll();

        $allDist = $this->getAll();
        $data = $allDist->where('DistId',$id)->firstOrFail();
        return view('admin.address.district', compact('data', 'Division', 'allDist'));
    }



    public function store(Request $request){
      // dd($request->all());
        $this->validate($request,[
            'DistName'=>'required|unique:districts,DistName|max:50',
            'DiviId'=>'required'
        ],[
            'DiviId.required'=> 'please enter division name',
            'DistName.required'=> 'please enter district name',
            'DistName.max'=> 'max district name content is 50 character',
            'DistName.unique' => 'this district already exists! please another name',
        ]);
        
        $District= strtolower($request->DistName);

        $insert = District::insertGetId([
            'DistName'=>$District,
            'DiviId'=>$request['DiviId']
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new district name store Successfully.');
                return redirect()->route('district.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }


    public function update(Request $request){
        $id= $request->DistId;

        $this->validate($request,[
            'DiviId'=>'required',
            'DistName'=>'required|max:50|unique:districts,DistName,'.$id.',DistId',
        ],[
            'DiviId.required'=> 'please enter division name',
            'DistName.required'=> 'please enter district name',
            'DistName.max'=> 'max district name content is 50 character',
            'DistName.unique' => 'this district already exists! please another name',
        ]);


        $District= strtolower($request->DistName);
        
        $update = District::where('DistId',$id)->update([
            'DistName'=>$District,
            'DiviId'=>$request['DiviId']
        ]);

        if($update){
            // Session::flash('success','district name update Successfully.');
                return redirect()->route('district.add');
        }else{
            // Session::flash('error','please try again.');
                return redirect()->back();
        }

    }
}
