<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DataLayers\CustomerDataService;
use App\Http\DataLayers\SalesDataService;
use App\Http\DataLayers\DebitCreditDataService;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\DataLayers\ItemsDataService;
use Illuminate\Http\Request;
use App\Models\ProductSell;
use App\Models\ProductSellRecord;
use App\Models\CustomerInfo;
use Carbon\Carbon;
use Session;
use Image;
use Cart;
use Auth;

class RetailSellerController extends Controller{
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


  // product Purchase in retailer
  public function store(Request $request){

    // company Info
    $companyOBJ = new CompanyInfoController();
    $company = $companyOBJ->getCompanyInfo();
    // form validation
    $this->validate($request,[

    ],[

    ]);

// dd($request->all());

     // Customer info + Duie update
     $customerOBJ = new CustomerController();
    
    $acustomer = (new CustomerDataService())->searchACustomerByPhoneNumber($request->ContactNo);
   // dd($Customer);
    $login_user_id = Auth::user()->id;
    $oldDue = 0;
      if($acustomer){
          $customerId = $acustomer->CustId ;

          $oldDue = $acustomer->DueAmount ;
          $updateDue = $oldDue+$request->DueAmount;
      
          $customerDueUpdate = CustomerInfo::where('status',true)
                              ->where('CustId',$acustomer->CustId)->update([
                                  'DueAmount' => $updateDue,
                                ]);
      }else{
        $customerId =  (new CustomerDataService())->insertNewCustomerWithMinimumInformation($request->CustName,$request->ContactNo,$request->DueAmount,2,$request->Address,$login_user_id);          
        $oldDue = 0;
      }

        $request['TranTypeId'] = 1; // income
        $debitToAccount = 1;// 200;// Item Sales
        $creditToAccount = 1;// 190;// Petty Cash
        $newTransactionId =  (new DebitCreditDataService())->insertNewDebitCreditTransaction($debitToAccount,$creditToAccount,$request->PayAmount,$request->TranTypeId,$request->SellingDate);
 
       $sale_auto_id =  (new SalesDataService())->insertNewSalesInformation($customerId,$newTransactionId, $request->TotalCost, $request->NetAmount, $request->Discount, $request->DueAmount, $request->LabourCost, 
      $request->PayAmount, $request->SellingDate, $request->VoucharNo, $request->CarryingBill, $login_user_id);
     
      $stockConObj = new  StockController();

      $carts = Cart::content();
      foreach ($carts as $data) {
        (new SalesDataService())->insertNewSaleItemRecord($sale_auto_id,$data->qty,$data->price,$data->holLabourPerUnit,$data->options->holCategoryId,$data->options->holBranId,$data->options->holSize,$data->options->holThickness);

        $stockUpdate = $stockConObj->updateProductStockByCategoryBrandSizeThicknessId(
          $data->options->holCategoryId,
          $data->options->holBranId,
          $data->options->holSize,
          $data->options->holThickness,
          $data->qty*(-1)); 
      }

      if($sale_auto_id){
      // Cart Destroy
      Cart::destroy();
      // Redirect Back
        $notification=array(
            'message'=>'Successfully Purchase Product',
            'alert-type'=>'success'
        );
      
        // for making printable invoice 
      $sellInfo = ProductSell::where('ProdSellId',$sale_auto_id)->first();
      $sellRecord = ProductSellRecord::where('ProdSellId',$sale_auto_id)->get();
       return view('admin.voucher.voucher', compact('sellInfo', 'sellRecord', 'company', 'oldDue'))->with($notification);
    }

  }



  /*
  |--------------------------------------------------------------------------
  |  BLADE OPERATION
  |--------------------------------------------------------------------------
  */
  public function add(){
    $CatgOBJ = new CategoryController();
    $allCatg = (new ItemsDataService())->GetAllActiveCategoryRecords();
    // Call Customer
    $CustomerOBJ = new CustomerController();
    $allCustomer = $CustomerOBJ->getRetailCustomer();

    $vouchar = $CustomerOBJ->vouchar();
    $chartOfAcc = new  ChartOfAccountController();
    $chartOffAccountList = $chartOfAcc->getAllChartOfAccount();
    // Cart Destroy
    Cart::destroy();
    return view('admin.retailer.add',compact('allCatg','allCustomer','vouchar','chartOffAccountList'));
  }






  /*
  |--------------------------------------------------------------------------
  |  API OPERATION
  |--------------------------------------------------------------------------
  */





  /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
}
