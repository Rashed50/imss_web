<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DataLayers\ItemsDataService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\CategoryController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;


class BrandController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    // ajax Method
    public function categoryWiseBrand(Request $request)
    {
        $getBrand = Brand::where('CateId', $request->CategoryID)->get();
        return json_encode($getBrand);
    }
    // ajax Method

    public function updateBrandNameStatus($brandId)
    {
        //  return $brandId;
        $update = Brand::where('BranStatus', true)->where('BranId', $brandId)->update([
            'BranStatus' => 0
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | BLADE OPERATION
    |--------------------------------------------------------------------------
    */

    public function add()
    {
        $allBrand = (new ItemsDataService())->getAllActiveBrandRecords();
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
        return view('admin.brand.add', compact('allCate', 'allBrand'));
    }

    public function edit($id)
    {
        $allBrand = (new ItemsDataService())->getAllActiveBrandRecords();
        $data = (new ItemsDataService())->GetAllBrandForDropdownlist($id, $allBrand);
        $allCate = (new ItemsDataService())->GetAllActiveCategoryRecords();
        return view('admin.brand.add', compact('data', 'allCate', 'allBrand'));
    }


    public function delete($id)
    {
        $delete = (new ItemsDataService())->deleteBrand($id);

        if($delete){
            Session::flash('delete', 'Brand delete');
        }else{
            Session::flash('error', 'please try again.'); 
        }
        return redirect()->back();
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'BranName' => 'required|max:150',
            'BranBlName'=>'required|max:150',
            'CategoryID' => 'required',
        ], [
            'BranName.required' => 'please enter brand name',
            'BranBLName.required' => 'Please enter brandBl name',
            'CategoryID.required' => 'please select category name',
            'BranName.max' => 'max brand name content is 150 character',
        ]);

        $BranName = strtolower($request->BranName);
        $brands = (new ItemsDataService())->checkExistBrand($request->CategoryID, $BranName);

        if ($brands > 0) {
            Session::flash('error', 'this name already exit, please another name.');
            return redirect()->back();
        } else {
            $data = [
                'CateId' => $request['CategoryID'],
                'BranName' => $BranName,
                'BranBlName' => $request['BranBlName'],
                'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            ];

            try{

                $insert = (new ItemsDataService())->storeBrand($data);

                if ($insert) {
                    Session::flash('success', 'new brand store Successfully.');
                    return redirect()->route('brand.add');
                } else {
                    Session::flash('error', 'please try again.');
                    return redirect()->back();
                }
    
            }catch (\Exception $exception){
                
                Session::flash('error','Not addeed!!');
                return redirect()->back();
            }
        }
    }


    public function update(Request $request)
    {
        $id = $request->BranId;
        $this->validate($request, [
            'BranName' => 'required|max:150|unique:brands,BranName,' . $id . ',BranId',
            'BranBlName'=>'required|max:150',
            // 'BranName' => 'required|unique:brands,BranName,'.$id.',BranId,CateId,'.$CateId,
            'CategoryID' => 'required',
        ], [
            'BranName.required' => 'please enter brand name',
            'BranBlName.required' => 'please enter brandBl name',
            'CateId.required' => 'please select category name',
            'BranName.max' => 'max brand name content is 150 character',
            'BranBlName.max' => 'max brandBl name content is 150 character',
            'BranName.unique' => 'this brand name already exists! please another name',
        ]);

        $data = [
            'CateId' => $request['CategoryID'],
            'BranName' => $request['BranName'],
            'BranBlName' => $request['BranBlName'],
            'updated_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ];

        try{
    
            $update = (new ItemsDataService())->updateBrand($id, $data);

            if ($update) {
                Session::flash('success', 'brand updated Successfully.');
                return redirect()->route('brand.add');
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
