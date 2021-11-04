<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller{

    public function index(){
        return view('admin.brand.all');
    }

    public function add(){
        return view('admin.brand.add');
    }
}
