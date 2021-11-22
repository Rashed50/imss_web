<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;
use App\Models\ProductPurchase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;
use Cart;


class ProductPurchaseController extends Controller{
  /*
  |--------------------------------------------------------------------------
  | DATABASE OPERATION
  |--------------------------------------------------------------------------
  */

  public function getAll(){
    return $all = ProductPurchase::where('status',true)->orderBy('ProdPurcId','DESC')->get();
  }

  public function store(Request $request){
    // form validation


    // insert data in database
    $insert = ProductPurchase::insertGetId([
      'TransactionId' => 0,
      'TotalPrice' => 0,
      'PurchaseDate' => 0,
      'VendorId' => 0,
      'LabourCost' => 0,
      'PaymentType' => 0,
      'BankId' => 0,
      'Discount' => 0,
      'CarringCost' => 0,
      'DoNo' => 0,
      'TruckNo' => 0,
      'CreateById' => 0,
    ]);

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
     return view('admin.purchase.add', compact('purchaseProduct','allCatg','vendorList'));

  }






  /*
  |--------------------------------------------------------------------------
  | API OPERATION
  |--------------------------------------------------------------------------
  */


  /* ___________________________ ***** ___________________________ */
}
