<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DataLayers\ItemsDataService;
use Illuminate\Http\Request;
use App\Models\Thickness;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;


class ThicknessController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    // ajax Method
    public function sizeWiseThickness(Request $request)
    {
        $getThickness = Thickness::where('SizeId', $request->Size)->get();
        return json_encode($getThickness);
    }
    // ajax Method

    public function idWiseActiveThicknessList($SizeID){
        return Thickness::where('ThicStatus', true)->where('SizeId', $SizeID)->get();
    }

    public function countActiveThicknessList($SizeID){
        return Thickness::where('ThicStatus', true)->where('SizeId', $SizeID)->count();
    }
    public function updateThicknessStatus($thikId)
    {
        return $update = Thickness::where('ThicStatus', true)->where('ThicId', $thikId)->update([
            'ThicStatus' => 0
        ]);
    }
    public function getAll()
    {
        return  $allThickness = Thickness::with('cateInfo', 'brandInfo', 'sizeInfo')->where('ThicStatus', true)->orderBy('ThicId', 'DESC')->get();
    }

    public function add()
    {
        $allThickness = (new ItemsDataService())->getAllActiveThicknessRecords();
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
        return view('admin.thickness.add', compact('allThickness', 'allCate'));
    }

    public function edit($id)
    {
        $allThickness = (new ItemsDataService())->getAllActiveThicknessRecords();
        $data = (new ItemsDataService())->GetAllThiknessForDropdownlist($id, $allThickness);
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
        return view('admin.thickness.add', compact('data', 'allThickness', 'allCate'));
    }

    public function delete($id){

        $delete = (new ItemsDataService())->deleteThickness($id);

        if($delete){
            Session::flash('delete', 'thickness delete');
        }else{
            Session::flash('error', 'please try again.'); 
        }
        return redirect()->back();
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'ThicName' => 'required|max:150',
            'ThicBlName' => 'required|max:150',
            'CategoryID' => 'required',
            'BranID' => 'required',
            'SizeID' => 'required',
        ], [
            'CategoryID.required' => 'please enter category name',
            'BranID.required' => 'please enter thickness name',
            'SizeID.required' => 'please select size name',
            'ThicName.required' => 'please enter Thick name',
            'ThicBlName.required' => 'please enter ThickBl name',
            'ThicName.max' => 'max thickness name content is 150 character',
            'ThicBlName.max' => 'max thickness name content is 150 character',
        ]);

        $ThicName = strtolower($request->ThicName);
        $Thickness = (new ItemsDataService())->checkExistThickness($request->CategoryID, $request->BranID, $request->SizeID, $ThicName);

        if ($Thickness > 0) {

            Session::flash('error', 'this thicknrss allready exit, please another thicknrss.');
            return redirect()->back();
        }

        $data = [
            'CateId' => $request['CategoryID'],
            'BranId' => $request['BranID'],
            'SizeId' => $request['SizeID'],
            'ThicName' => $ThicName,
            'ThicBlName' => $request['ThicBlName'],
            'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ];

        try {

            $insert = (new ItemsDataService())->storeThickness($data);

            if ($insert) {
                Session::flash('success', 'new thickness store Successfully.');
                return redirect()->route('thickness.add');
            } else {
                Session::flash('error', 'please try again.');
                return redirect()->back();
            }
    
        } catch (\Exception $exception){
            
            Session::flash('error','Not addeed!!');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $id = $request->ThicId;
        $this->validate($request, [
            'ThicName' => 'required|max:150',
            'ThicBlName' => 'required|max:150',
            'CategoryID' => 'required',
            'BranID' => 'required',
            'SizeID' => 'required',
        ], [
            'ThicName.required' => 'please enter thickness name',
            'ThicBlName.required' => 'please enter thicknessBl name',
            'SizeId.required' => 'please select size name',
            'ThicName.max' => 'max thickness name content is 150 character',
            'ThicBlName.max' => 'max thicknessBl name content is 150 character',
        ]);


        $data = [
            'CateId' => $request['CategoryID'],
            'BranId' => $request['BranID'],
            'SizeId' => $request['SizeID'],
            'ThicName' => $request['ThicName'],
            'ThicBlName' => $request['ThicBlName'],
            'updated_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ];

        try {
    
            $update = (new ItemsDataService())->updateThickness($id, $data);

            if ($update) {
                Session::flash('success', 'thickness update Successfully.');
                return redirect()->route('thickness.add');
            } else {
                Session::flash('error', 'please try again.');
                return redirect()->back();
            }

        } catch (\Exception $exception){
            
            Session::flash('error','Not addeed!!');
            return redirect()->back();
        }
    }
}
