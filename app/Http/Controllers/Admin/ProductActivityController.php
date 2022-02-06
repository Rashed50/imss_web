<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ThicknessController;
use App\Http\Controllers\Admin\SizeController;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Thickness;
use Illuminate\Support\Facades\Session;

class ProductActivityController extends Controller
{

    public function index()
    {
        $CategoryOBJ = new CategoryController();
        $allCate = $CategoryOBJ->getAll();
        return view('admin.activity.index', compact('allCate'));
    }

    public function brand(Request $request)
    {
        $brand = $request->brandId;

        if ($brand != null) {
            $totalBrand = count($brand);
            for ($i = 0; $i < $totalBrand; $i++) {

                $thisList = new SizeController();
                $allSize = $thisList->idWiseBransActiveList($brand[$i]);
                $allSizeCount = count($allSize[$i]);
                if($allSizeCount){
                    $updateBrandObj = new BrandController();
                    $update = $updateBrandObj->updateBrandNameStatus($brand[$i]);
                }

                // $seats = $this->updateBrandNameStatus($brand[$i]);

                // for ($x = 0; $x < $allSizeCount; $x++) {
                //     $asize = $allSize[$x];
                //     $seats = $this->updateSizeStatus($asize->SizeId);
                // }
            }


            Session::flash('success', 'Status update Successfully.');
            return redirect()->route('product.activity');
        } else {
            Session::flash('error_no_data', 'No data found.');
            return redirect()->back();
        }
    }

    public function size(Request $request)
    {
        $SizeID = $request->SizeID;
        if ($SizeID != null) {
            $sizeIdList = count($SizeID);
            for ($i = 0; $i < $sizeIdList; $i++) {

                // $thickListObj = new ThicknessController();
                // $allThickness = $thickListObj->activeThicknessList($SizeID[$i]);

                // $allThickCouun = count($allThickness);
                $idWiseAcdtiveThickness = new ThicknessController();
                $thisList = $idWiseAcdtiveThickness->idWiseActiveThicknessList($SizeID[$i]);

                $countAcdtiveThickness = count($thisList);

                if($countAcdtiveThickness < 1){
                    $updateSizeObj = new SizeController();
                    $update = $updateSizeObj->updateSizeStatus($SizeID[$i]);
                    // $seats = $this->updateSizeStatus($SizeID[$i]);
                }
            }

            Session::flash('success', 'Status update Successfully.');
            return redirect()->route('product.activity');
        } else {
            Session::flash('error_no_data', 'No data found.');
            return redirect()->back();
        }
    }

    public function thikness(Request $request)
    {

        $ThicId = $request->ThicId;

        if ($ThicId != null) {

            $totalThicId = count($ThicId);

            for ($i = 0; $i < $totalThicId; $i++) {
                //  $allSize = Size::where('SizeStatus',true)->where('ThicId',$ThicId[$i])->get();
                // $allSizeCount = count($allSize);
                // Size::where('SizeStatus',true)->where('BranId',$brand[$i])->count();

                    $stockObj = new StockController();
                   $countList = $stockObj->countListOfActiveStock($ThicId[$i]);

                   if($countList < 1){
                       $updateObj = new ThicknessController();
                       $seats = $updateObj->updateThicknessStatus($ThicId[$i]);
                   }

                //  foreach($allSize as $aSize){
                //        // $asize = $allSize[$x];
                //         $seats = $this->updateSizeStatus($aSize->SizeId);
                //     }
            }
            

            Session::flash('success', 'Status update Successfully.');
            return redirect()->route('product.activity');
        } else {
            Session::flash('error_no_data', 'No data found.');
            return redirect()->back();
        }
    }
}
