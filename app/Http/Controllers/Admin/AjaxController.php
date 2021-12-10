<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Thana;
use App\Models\Union;
use App\Models\LabourRate;

class AjaxController extends Controller{
    
    public function getDistrict(Request $request){
      $DiviId = $request->DiviId;
    return  $district = District::where('DiviId',$DiviId)->orderBy('DistId','DESC')->get();
      return json_encode($district);
    }

    public function getThana(Request $request){
      $distId = $request->DistId;
      $thana = Thana::where('DistId',$distId)->orderBy('ThanId','DESC')->get();
      return json_encode($thana);
    }

    public function getUnion(Request $request){
      $ThanId = $request->ThanId;
      $union = Union::where('ThanId',$ThanId)->orderBy('UnioId','DESC')->get();
      return json_encode($union);
    }

    public function getLabourCost(Request $request){
      $SizeId= $request->SizeId;
      $CateId= $request->CateId;
      $LabourCost = LabourRate::with('cateInfo','sizeInfo')
     ->where('SizeId',$SizeId)->where('CateId',$CateId)->first();
      return json_encode($LabourCost);
    }


}
