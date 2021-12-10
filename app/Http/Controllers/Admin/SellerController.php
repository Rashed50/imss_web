<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSell;

class SellerController extends Controller{
    public function getAll(){
      return  $AllSellInfo= ProductSell::with('Customer')->get();
    }

    public function index(){
        $seller= $this->getAll();
        return view('admin.sell.index',compact('seller'));
    }
}
