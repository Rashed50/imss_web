<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;
use App\Models\ProductPurchase;
use App\Models\PurchaseRecord;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Image;
use Cart;
use Auth;


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
    $CreateBy = Auth::user()->id;

    // insert data in database
    $insert = ProductPurchase::insertGetId([
      'TransactionId' => 0,
      'TotalPrice' => $request->PayAmount,
      'PurchaseDate' => $request->PurchaseDate,
      'VendorId' => $request->VendorName,
      'LabourCost' => $request->LabourCost,
      'PaymentType' => 1,
      'BankId' => 1,
      'Discount' => $request->Discount,
      'CarringCost' => $request->CarryingBill,
      'DoNo' => $request->doNO,
      'TruckNo' => $request->TruckNo,
      'CreateById' => $CreateBy,
      'created_at' => Carbon::now(),
    ]);

    // insert Cart Content
    $carts = Cart::content();
    foreach ($carts as $data) {
      PurchaseRecord::insert([
        'Quantity' => $data->qty,
        'UnitPrice' => $data->price,
        'Amount' => $data->subtotal,
        'ProdPurcId' => $insert,
        'CateId' => $data->options->CategoryId,
        'BranId' => $data->options->BranId,
        'SizeId' => $data->options->Size,
        'ThicId' => $data->options->Thickness,
      ]);
    }
    // Cart Destroy
    Cart::destroy();
    // Redirect Back
    if($insert){
      Session::flash('success','value');
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
     return view('admin.purchase.add', compact('purchaseProduct','allCatg','vendorList'));

  }






  /*
  |--------------------------------------------------------------------------
  | API OPERATION
  |--------------------------------------------------------------------------
  */


  /* ___________________________ ***** ___________________________ */
}
