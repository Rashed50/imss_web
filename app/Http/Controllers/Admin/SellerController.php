<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSell;
use App\Models\CustomerPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller{

  /* =================================================================
  Databese Operation
  ===================================================================*/

    public function getAll(){
      return  $AllSellInfo= ProductSell::with('Customer')->get();
    }

    public function dateAndIdWiseSellRecord($fromDate, $toDate, $id){
      return $data = ProductSell::where('CustId',$id)->whereDate('SellingDate','>=',$fromDate)->whereDate('SellingDate','<=',$toDate)->get();
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
     $toDate = date('Y-m-d', strtotime(Carbon::now()));
     $fromDate = date('Y-m-d', strtotime(Carbon::now()->subMonth(2)));  

      $allSell= $this->dateAndIdWiseSellRecord($fromDate,$toDate,$id);
      return view('admin.customer.sell.index', compact('allSell', 'toDate', 'fromDate'));

    }


    public function dateAndIdWiseSellInfo(Request $request){

      $allSell= $this->dateAndIdWiseSellRecord($request->fromDate,$request->toDate,$request->id);
      return view('admin.customer.sell.index', compact('allSell'));
    }

    
}
