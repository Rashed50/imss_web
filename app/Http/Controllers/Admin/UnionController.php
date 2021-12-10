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
            'UnioName'=>'required|max:50',
            'DistId'=>'required',
            'DiviId'=>'required',
            'ThanId'=>'required'
        ],[
            'DiviId.required'=> 'please enter division name',
            'DistId.required'=> 'please enter district name',
            'ThanId.required'=> 'please enter thana name',
            'UnioName.required'=> 'please enter union name',
            'UnioName.max'=> 'max union name content is 50 character',
        ]);
        
        $Union= strtolower($request->UnioName);

        $count=Union::where('DistId',$request['DistId'])->where('DiviId',$request['DiviId'])
        ->where('ThanId',$request['ThanId'])->where('UnioName',$Union)->count();

        if($count){
             Session::flash('error','this union already exists! please another name.');
                    return redirect()->back();
        }else{
            $insert = Union::insertGetId([
                'UnioName'=>$Union,
                'DistId'=>$request['DistId'],
                'DiviId'=>$request['DiviId'],
                'ThanId'=>$request['ThanId']
                // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);

            if($insert){
                Session::flash('success','new union name store Successfully.');
                    return redirect()->route('union.add');
            }else{
                Session::flash('error','please try again.');
                    return redirect()->back();
            }
        }
        
    }


    public function update(Request $request){
       // dd($request->all());
        $id= $request->UnioId;

        $this->validate($request,[
            'UnioName'=>'required|max:50',
            'DistId'=>'required',
            'DiviId'=>'required',
            'ThanId'=>'required'
        ],[
            'DiviId.required'=> 'please enter division name',
            'DistId.required'=> 'please enter district name',
            'ThanId.required'=> 'please enter thana name',
            'UnioName.required'=> 'please enter union name',
            'UnioName.max'=> 'max union name content is 50 character',
        ]);


        $Union= strtolower($request->UnioName);

        $update = Union::where('UnioId',$id)->update([
            'UnioName'=>$Union,
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
