<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DataLayers\ItemsDataService;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\CategoryController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;


class SizeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    // ajax Method
    public function brandWiseSize(Request $request)
    {
        $getSize = Size::where('BranId', $request->BranId)->get();
        return json_encode($getSize);
    }
    // ajax Method

    public function idWiseBransActiveList($id){
        Size::where('SizeStatus', true)->where('BranId', $id)->get();
    }

    public function updateSizeStatus($sizeId)
    {
        return $update = Size::where('SizeStatus', true)->where('SizeId', $sizeId)->update([
            'SizeStatus' => 0,
        ]);
    }

    // public function getAll()
    // {
    //     return $allSize = Size::with('cateInfo', 'brandInfo')->where('SizeStatus', true)->orderBy('SizeId', 'DESC')->get();
    // }
    /*
    |--------------------------------------------------------------------------
    | BLADE OPERATION
    |--------------------------------------------------------------------------
    */

    public function add()
    {
        $allSize = (new ItemsDataService())->getAllActiveSizeRecords();
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
        $allBrand = (new ItemsDataService())->getAllActiveBrandRecords();
        return view('admin.size.add', compact('allSize', 'allCate', 'allBrand'));
    }

    public function edit($id)
    {
        $allSize = (new ItemsDataService())->getAllActiveSizeRecords();
        $data = (new ItemsDataService())->getSizeDataEdit($id, $allSize);
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();

        return view('admin.size.add', compact('data', 'allSize', 'allCate'));
    }

    public function delete($id){

        $delete = (new ItemsDataService())->deleteSize($id);

        if($delete){
            Session::flash('delete', 'size delete');
        }else{
            Session::flash('error', 'please try again.');
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'SizeName' => 'required|max:150',
            'SizeBlName' => 'required|max:150',
            'BranID' => 'required',
            'CategoryID' => 'required',
        ], [
            'SizeName.required' => 'please enter size name',
            'SizeBlName.required' => 'please enter sizeBl name',
            'BranID.required' => 'please select brand name',
            'SizeName.max' => 'max size name content is 150 character',
            'SizeBlName.max' => 'max size name content is 150 character',
        ]);

        $SizeName = strtolower($request->SizeName);
        $sizes = (new ItemsDataService())->checkExistSize($request->CategoryID, $request->BranID, $SizeName);

        if ($sizes > 0) {

            Session::flash('error', 'this size allready exit, please another size.');
            return redirect()->back();
        } else {
            $data = [
                'CateId' => $request['CategoryID'],
                'BranId' => $request['BranID'],
                'SizeName' => $SizeName,
                'SizeBlName' => $request['SizeBlName'],
                'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            ];

            try {

                $insert = (new ItemsDataService())->storeSize($data);

                if ($insert) {
                    Session::flash('success', 'new size store Successfully.');
                    return redirect()->route('size.add');
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


    public function update(Request $request)
    {
        // dd($request->all());
        $id = $request->SizeId;

        $this->validate($request, [
            'SizeName' => 'required|max:150',
            'SizeBlName' => 'required|max:150',
            'BranID' => 'required',
            'CategoryID' => 'required',
        ], [
            'SizeName.required' => 'please enter size name',
            'SizeBlName.required' => 'please enter size name',
            'CategoryID.required' => 'please select category name',
            'BranID.required' => 'please select brand name',
            'SizeName.max' => 'max size name content is 150 character',
            'SizeName.max' => 'max size name content is 150 character',
        ]);

        $data = [
            'CateId' => $request['CategoryID'],
            'BranId' => $request['BranID'],
            'SizeName' => $request['SizeName'],
            'SizeBlName' => $request['SizeBlName'],
            'updated_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ];

        try {

            $insert = (new ItemsDataService())->updateSize($id, $data);

            if ($insert) {
                Session::flash('success', 'size update Successfully.');
                return redirect()->route('size.add');
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
