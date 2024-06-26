<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thana;
use App\Models\Union;
use App\Models\District;
use App\Http\Controllers\Admin\DivisionController;
use Session;

class ThanaController extends Controller{
    
  public function getAll(){
      return $all = Thana::orderBy('ThanId','DESC')->get();
    }


    public function add(){

         $allThana = $this->getAll();
         $DivisionOBJ = new DivisionController();
         $Division = $DivisionOBJ->getAll();
        return view('admin.address.thana', compact('Division', 'allThana'));
    }

    public function edit($id){
       $DivisionOBJ = new DivisionController();
       $Division = $DivisionOBJ->getAll();

        $allThana = $this->getAll();
        $data = $allThana->where('DistId',$id)->firstOrFail();
        return view('admin.address.thana', compact('data', 'Division', 'allThana'));
    }



    public function store(Request $request){
      // dd($request->all());
        $this->validate($request,[
            'ThanaName'=>'required|max:50',
            'DistId'=>'required',
            'DiviId'=>'required'
        ],[
            'DiviId.required'=> 'please enter division name',
            'DistId.required'=> 'please enter district name',
            'ThanaName.required'=> 'please enter thana name',
            'ThanaName.max'=> 'max thana name content is 50 character',
        ]);
        
        $Thana= strtolower($request->ThanaName);

        $availabl=Thana::where('DistId',$request['DistId'])
        ->where('DiviId',$request['DiviId'])->where('ThanaName',$Thana)
        ->count();
        
        if($availabl){
            Session::flash('error','this Thana already exists! please another name.');
                return redirect()->back();
        }else{
            $insert = Thana::insertGetId([
                'ThanaName'=>$Thana,
                'DistId'=>$request['DistId'],
                'DiviId'=>$request['DiviId']
                // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);

            if($insert){
                Session::flash('success','new Thana name store Successfully.');
                    return redirect()->route('thana.add');
            }else{
                Session::flash('error','please try again.');
                    return redirect()->back();
            }
        }

    }


    public function update(Request $request){
       // dd($request->all());
        $id= $request->ThanId;

        $this->validate($request,[
            'ThanaName'=>'required|max:50',
            'DistId'=>'required',
            'DiviId'=>'required'
        ],[
            'DiviId.required'=> 'please enter division name',
            'ThanaName.required'=> 'please enter Thana name',
            'ThanaName.max'=> 'max Thana name content is 50 character',
        ]);


        $Thana= strtolower($request->ThanaName);

        $update = Thana::where('ThanId',$id)->update([
            'ThanaName'=>$Thana,
            'DistId'=>$request['DistId'],
            'DiviId'=>$request['DiviId']
        ]);

        if($update){
            // Session::flash('success','district name update Successfully.');
                return redirect()->route('thana.add');
        }else{
            // Session::flash('error','please try again.');
                return redirect()->back();
        }

    }
}
