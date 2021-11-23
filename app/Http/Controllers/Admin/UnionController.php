<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thana;
use App\Models\Union;
use App\Models\District;
use App\Http\Controllers\Admin\DivisionController;
use Session;

class UnionController extends Controller{
     public function getAll(){
      return $all = Union::orderBy('UnioId','DESC')->get();
    }


    public function add(){

         $allUnion = $this->getAll();
         $DivisionOBJ = new DivisionController();
         $Division = $DivisionOBJ->getAll();
        return view('admin.address.union', compact('Division', 'allUnion'));
    }

    public function edit($id){
       $DivisionOBJ = new DivisionController();
       $Division = $DivisionOBJ->getAll();

        $allUnion = $this->getAll();
        $data = $allUnion->where('UnioId',$id)->firstOrFail();
        return view('admin.address.union', compact('data', 'Division', 'allUnion'));
    }



    public function store(Request $request){
      // dd($request->all());
        $this->validate($request,[
            'UnioName'=>'required|unique:unions,UnioName|max:50',
            'DistId'=>'required',
            'DiviId'=>'required',
            'ThanId'=>'required'
        ],[
            'DiviId.required'=> 'please enter division name',
            // 'DistId.required'=> 'please enter district name',
            'ThanId.required'=> 'please enter thana name',
            'UnioName.required'=> 'please enter district name',
            'UnioName.max'=> 'max district name content is 50 character',
            'UnioName.unique' => 'this district already exists! please another name',
        ]);
        

        $insert = Union::insertGetId([
            'UnioName'=>$request['UnioName'],
            'DistId'=>$request['DistId'],
            'DiviId'=>$request['DiviId'],
            'ThanId'=>$request['ThanId']
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','new Thana name store Successfully.');
                return redirect()->route('union.add');
        }else{
            Session::flash('error','please try again.');
                return redirect()->back();
        }

    }


    public function update(Request $request){
       // dd($request->all());
        $id= $request->UnioId;

        $this->validate($request,[
            'UnioName'=>'required|max:50|unique:unions,UnioName,'.$id.',UnioId',
            'DistId'=>'required',
            'DiviId'=>'required',
            'ThanId'=>'required'
        ],[
            'DiviId.required'=> 'please enter division name',
            'DistId.required'=> 'please enter district name',
            'ThanId.required'=> 'please enter thana name',
            'UnioName.required'=> 'please enter Thana name',
            'UnioName.max'=> 'max Thana name content is 50 character',
            'UnioName.unique' => 'this Thana already exists! please another name',
        ]);



        $update = Union::where('UnioId',$id)->update([
            'UnioName'=>$request['UnioName'],
            'DistId'=>$request['DistId'],
            'DiviId'=>$request['DiviId'],
            'ThanId'=>$request['ThanId']
        ]);

        if($update){
            // Session::flash('success','district name update Successfully.');
                return redirect()->route('union.add');
        }else{
            // Session::flash('error','please try again.');
                return redirect()->back();
        }

    }
}
