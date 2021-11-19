<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thana;
use App\Models\Union;

class ThanaController extends Controller{
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





}
