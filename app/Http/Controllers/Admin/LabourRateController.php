<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LabourRate;
use App\Models\Category;
use App\Models\Size;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;

class LabourRateController extends Controller{
    
 public function getAll(){
      return $all = LabourRate::with('cateInfo','sizeInfo')->orderBy('LaboId','DESC')->get();
    }


     public function getSize(Request $request){
        $data = Size::where('SizeStatus',true)->where('CateId',$request->CateId)->orderBy('SizeName','DESC')->get();
        // return response()->json([ 'data' => $data ]);
        return json_encode($data);
    }



    public function add(){
        $categoryOBJ = new CategoryController();
        $allCate = $categoryOBJ->getAll();
        $allLabour = $this->getAll();
        return view('admin.labour-rate.add', compact('allLabour', 'allCate'));
    }

   
    public function edit($id){
        $categoryOBJ = new CategoryController();
        $allCate = $categoryOBJ->getAll();
        $allLabour = $this->getAll();
        $data = $allLabour->where('LaboId',$id)->firstOrFail();
        return view('admin.labour-rate.add', compact('data', 'allLabour', 'allCate'));
    }


    public function store(Request $request){

         $sizes = LabourRate::where('CateId',$request->idOfcategory)->where('sizeId',$request->sizeID)->where('LaboType',$request->LaboType)->count();

        if($sizes>0){
            Session::flash('error','this labour cost already exit.');
                return redirect()->back();
        }else{
            $insert = LabourRate::insertGetId([
            'CateId'=>$request['idOfcategory'],
            'SizeId'=>$request['sizeID'],
            'LaboType'=>$request['LaboType'],
            'Amount'=>$request['Amount'],
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if($insert){
                Session::flash('success','new labour cost store Successfully.');
                    return redirect()->route('labour.add');
            }else{
                Session::flash('error','please try again.');
                    return redirect()->back();
            }
        }
    

    }




    // public function update(Request $request){

    //      $sizes = LabourRate::where('CateId',$request->idOfcategory)->where('sizeId',$request->sizeID)->where('LaboType',$request->LaboType)->count();

    //     if($sizes>0){
    //         Session::flash('error','this labour cost already exit.');
    //             return redirect()->back();
    //     }else{
    //         $insert = LabourRate::insertGetId([
    //         'CateId'=>$request['idOfcategory'],
    //         'SizeId'=>$request['sizeID'],
    //         'LaboType'=>$request['LaboType'],
    //         'Amount'=>$request['Amount'],
    //         // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
    //     ]);

    //     if($insert){
    //             Session::flash('success','new labour cost store Successfully.');
    //                 return redirect()->route('labour.add');
    //         }else{
    //             Session::flash('error','please try again.');
    //                 return redirect()->back();
    //         }
    //     } 

    // }


}
