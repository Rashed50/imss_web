<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DebitCreditController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\DataLayers\PurchaseDataService;
use App\Http\DataLayers\VendorDataService;
use Illuminate\Http\Request;
use App\Models\ProductPurchase;
use App\Models\PurchaseRecord;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Image;
use Cart;
use Illuminate\Support\Facades\Auth;


class ProductPurchaseController extends Controller{
  /*
  |--------------------------------------------------------------------------
  | DATABASE OPERATION
  |--------------------------------------------------------------------------
  */

  public function getAll(){
    return $all = ProductPurchase::where('status',true)->orderBy('ProdPurcId','DESC')->get();
  }


  // Produt Purchase Form Save Button Action
  public function store(Request $request){
    // form validation
     

    $loginId = Auth::user()->id;
    $debitAccount = $request->DebitAccount;
    $carts = Cart::content(); // cart items
    $aVendor = (new VendorDataService())->getAVendorRecordByVendorAutoId($request->VendorName);
    $purchaseId = (new PurchaseDataService())->insertNewPurchaseInformation($request->PayAmount,$request->CarryingBill,$request->Discount,
    $request->LabourCost, $request->PurchaseDate, $request->VendorName,1, $request->doNO, $request->TruckNo, $loginId,$debitAccount,$aVendor->ChartOfAcctId,$carts );


    if($purchaseId){
      // Cart Destroy
      // Cart::destroy();
      Session::flash('success','Successfully Saved');
      return redirect()->back();
    } 
   
  }


  /* ++++++++++++ Ajax Method IN Add To Cart ++++++++++++ */
  public function productAddToCart(Request $request){


    $id = uniqid();
    Cart::add([
      'id' => $id,
      'name' => 'Product Purchase',
      'qty' => $request->Qunatity,
      'price' => $request->UnitPrice,
      'weight' => 1,
      'options' => [
        'CategoryId' => $request->CategoryId,
        'BranId' => $request->BranId,
        'Size' => $request->Size,
        'Thickness' => $request->Thickness,
        // Name
        'CategoryName' => $request->CategoryName,
        'BrandName' => $request->BrandName,
        'SizeName' => $request->SizeName,
        'ThicknessName' => $request->ThicknessName,
        ]
      ]);
      return response()->json(['success' => 'Successfully Added Cart On Item']);
  }

  // Order list in Add To Card
  public function getOrderList(){
    $carts = Cart::content();
    $cartQty = Cart::count();
    $cartTotal = Cart::total();
    
    return response()->json(array(
      'carts' => $carts,
      'cartQty' => $cartQty,
      'cartTotal' => $cartTotal,
    ));
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

  public function productRemoveToCart(Request $request){
    Cart::remove($request->id);
    return response()->json(['success' => 'Product Remove From Cart']);
  }
  /* ++++++++++++ Ajax Method IN Add To Cart ++++++++++++ */





  /*
  |--------------------------------------------------------------------------
  | BLADE OPERATION
  |--------------------------------------------------------------------------
  */

  public function add(){
     // Category Object
     $VendorOBJ = new VendorController();
     $vendorList = $VendorOBJ->getAll();
     // Category Object
     $CatgOBJ = new CategoryController();
     $allCatg = $CatgOBJ->getAll();
     $purchaseProduct = $this->getAll();
     // Cart Destroy
     Cart::destroy();
     $chartOfAcc = new  ChartOfAccountController();
     $chartOffAccountList = $chartOfAcc->getAllChartOfAccount();
    // dd($chartOffAccountList);
     return view('admin.purchase.add', compact('purchaseProduct','allCatg','vendorList','chartOffAccountList'));

  }






  /*
  |--------------------------------------------------------------------------
  | API OPERATION
  |--------------------------------------------------------------------------
  */


  /* ___________________________ ***** ___________________________ */
}
