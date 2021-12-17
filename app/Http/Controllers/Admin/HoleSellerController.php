<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Http\Request;
use App\Models\ProductSell;
use App\Models\ProductSellRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;
use Cart;
use Auth;


class HoleSellerController extends Controller{
  /*
  |--------------------------------------------------------------------------
  |  DATABASE OPERATION
  |--------------------------------------------------------------------------
  */


  /* ++++++++++++ Ajax Method IN Add To Cart ++++++++++++ */
  public function productAddToCart(Request $request){
    $id = uniqid();
    Cart::add([
      'id' => $id,
      'name' => 'Product Purchase',
      'qty' => $request->holQunatity,
      'price' => $request->holUnitPrice,
      'weight' => 1,
      'options' => [
        'holCategoryId' => $request->holCategoryId,
        'holBranId' => $request->holBranId,
        'holSize' => $request->holSize,
        'holThickness' => $request->holThickness,
        'holLabourPerUnit' => $request->holLabourPerUnit,
        // Name
        'holCategoryName' => $request->holCategoryName,
        'holBrandName' => $request->holBrandName,
        'holSizeName' => $request->holSizeName,
        'holThicknessName' => $request->holThicknessName,
        ]
      ]);
      return response()->json(['success' => 'Successfully Added Cart On Item']);
  }

  public function productRemoveToCart(Request $request){
    Cart::remove($request->id);
    return response()->json(['success' => 'Product Remove From Cart']);
  }

  public function QunatityIncrement(Request $request){
    $row = Cart::get($request->rowId);
    Cart::update($request->rowId, $row->qty + 1);
    return response()->json('increment');
  }

  public function QunatityDecrement(Request $request){
    $row = Cart::get($request->rowId);
    Cart::update($request->rowId, $row->qty - 1);
    return response()->json('decrement');
  }
  /* ++++++++++++ Ajax Method IN Add To Cart ++++++++++++ */


  public function productSellStore(Request $request){


    $request['TranAmount'] = $request->PayAmount;
    $request['TranTypeId'] = 1;

    $transObj = new  TransactionsController();
    $transId = $transObj->createNewTransaction($request); 
    

    // Credit Transaction
    $request['Amount'] = $request->PayAmount;
    $request['TranId'] = $transId;
    $request['ChartOfAcctId'] = 1;
    $request['DrCrTypeId'] = 1;
    $decrObj = new  DebitCreditController();
    $drcrId = $decrObj->insertNewDebitCreditTransaction($request); 
 
    // Debit Transaction
    $request['ChartOfAcctId'] = 1;
    $request['DrCrTypeId'] = 2;
    $drcrId = $decrObj->insertNewDebitCreditTransaction($request); 
    

    /* From Validation */
    $createBy = Auth::user()->id;
    /* Insert Data IN Database */
    $insert = ProductSell::insertGetId([
      'Commission' => $request->Discount,
      'TotalAmount' => $request->TotalCost,
      'NetAmount' => $request->NetAmount,
      'DueAmount' => $request->DueAmount,
      'PaidAmount' => $request->PayAmount,
      'LabourCost' => $request->LabourCost,
      'SellingDate' => $request->SellingDate,
      'VoucharNo' => $request->VoucharNo,
      'CarryingCost' => $request->CarryingBill,
      'CreateById' => $createBy,
      'TranId' => $transId,
      'CustId' => $request->TradeName,
      'created_at' => Carbon::now(),
    ]);

    /* Hole Seller Record */

    $stockConObj = new  StockController();

    $carts = Cart::content();
    foreach ($carts as $data) {
        ProductSellRecord::insert([
          'Quantity' => $data->qty,
          'Amount' => $data->price,
          'LabourCost' => $data->holLabourPerUnit,
          'ProdSellId' => $insert,
          'CateId' => $data->options->holCategoryId,
          'BranId' => $data->options->holBranId,
          'SizeId' => $data->options->holSize,
          'ThicId' => $data->options->holThickness,
        ]);
        $stockUpdate = $stockConObj->updateProductStockByCategoryBrandSizeThicknessId(
          $data->options->holCategoryId,$data->options->holBranId
          ,$data->options->holSize,$data->options->holThickness,$data->qty*(-1)); 

    }
    // Cart Destroy
    Cart::destroy();
    // Redirect Back
    if($insert){
      $notification=array(
          'message'=>'Successfully Purchase Product',
          'alert-type'=>'success'
      );
      return Redirect()->back()->with($notification);
    }

  }





  /*
  |--------------------------------------------------------------------------
  |  BLADE OPERATION
  |--------------------------------------------------------------------------
  */
  public function add(){
    $CatgOBJ = new CategoryController();
    $allCatg = $CatgOBJ->getAll();
    // Call Customer
    $CustomerOBJ = new CustomerController();
    $allCustomer = $CustomerOBJ->getAllWholeCustomer();

    $vouchar = $CustomerOBJ->vouchar();
    // Cart Destroy
    Cart::destroy();
    return view('admin.holeseller.add',compact('allCatg','allCustomer','vouchar'));
  }



  




  /*
  |--------------------------------------------------------------------------
  |  API OPERATION
  |--------------------------------------------------------------------------
  */


    



  /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

}
