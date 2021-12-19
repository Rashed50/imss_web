<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSell;

class SellerController extends Controller{

  /* =================================================================
  Databese Operation
  ===================================================================*/

    public function getAll(){
      return  $AllSellInfo= ProductSell::with('Customer')->get();
    }

    public function customerWieAllSell($id){
      return $allSell= ProductSell::where('CustId',$id)->get();
    }


/* =================================================================
  Blade file Operation
  ===================================================================*/


    public function index(){
        $seller= $this->getAll();
        return view('admin.sell.index',compact('seller'));
    }

    public function customerWieSell($id){
      $allSell= $this->customerWieAllSell($id);
      return view('admin.customer.sell.index', compact('allSell'));
    }

    
}
