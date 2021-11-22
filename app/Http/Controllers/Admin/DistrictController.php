<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller{
    public function getAll(){
      return $all = District::orderBy('DistId','DESC')->get();
    }
}
