<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller{
  public function index(){
    // updated from office pc code
    return view('admin.dashboard.index');
  }

  public function add(){
    return view('admin.dashboard.add');
  }
}
