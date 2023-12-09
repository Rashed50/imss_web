<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ThicknessController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Admin\CustomerPaymentController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\HoleSellerController;
use App\Http\Controllers\Admin\RetailSellerController;

use App\Http\Controllers\Admin\ThanaController;
use App\Http\Controllers\Admin\ProductPurchaseController;

use App\Http\Controllers\Admin\EmployeeInfoController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\UnionController;
use App\Http\Controllers\Admin\LabourRateController;
use App\Http\Controllers\Admin\DebitVoucherController;
use App\Http\Controllers\Admin\DuePaymentController;
use App\Http\Controllers\Admin\CreditVoucherController;
use App\Http\Controllers\Admin\CreditTypeController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\DebitTypeController;
use App\Http\Controllers\Admin\SellReturnController;
use App\Http\Controllers\Admin\ProductActivityController;
use App\Http\Controllers\Admin\TestController;


use App\Http\Controllers\Admin\Authorization\RoleController;
//use App\Http\Controllers\Admin\Authorization\RoleController;
use App\Http\Controllers\Admin\Authorization\UserController;
//App\Http\Controllers\App\Http\Controllers\Admin\Authorization\RoleController



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pdf', function () {
    return view('admin.voucher.pdf-voucher');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/add', function () {
    return view('admin.add');
})->middleware(['auth'])->name('add.here');



Route::middleware('auth')->prefix('dashboard')->group(function() {
   // Route::resource('roles', RoleController::class);
    Route::get('roles/add', [RoleController::class, 'index'])->name('roles.add');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('roles/store', [RoleController::class, 'store'])->name('roles.store');

    Route::resource('users', UserController::class);
   // Route::resource('roles', RoleController::class);
});


/* ++++++++++++++++++++++ Employee ++++++++++++++++++++++ */
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('employee/add', [EmployeeInfoController::class, 'add'])->name('employee.add');
    Route::get('employee', [EmployeeInfoController::class, 'creditFoEmployee'])->name('employee.credit');
    Route::get('employee/edit/{EmplInfoId}', [EmployeeInfoController::class, 'edit'])->name('employee.edit');
    Route::post('employee/information/store', [EmployeeInfoController::class, 'store'])->name('store-employee.information');
    Route::post('employee/information/update', [EmployeeInfoController::class, 'update'])->name('update-employee.information');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::post('category/add', [CategoryController::class, 'store'])->name('category.store');
    Route::post('category/edit', [CategoryController::class, 'update'])->name('category.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::get('brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
    Route::post('brand/add', [BrandController::class, 'store'])->name('brand.store');
    Route::post('brand/edit', [BrandController::class, 'update'])->name('brand.update');
    // ajax route
    Route::post('category-wise-brand', [BrandController::class, 'categoryWiseBrand'])->name('Category-wise-Brand');
    // ajax route
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('size/add', [SizeController::class, 'add'])->name('size.add');
    Route::get('size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
    Route::get('size/delete/{id}', [SizeController::class, 'delete'])->name('size.delete');
    Route::post('size/add', [SizeController::class, 'store'])->name('size.store');
    Route::post('size/edit', [SizeController::class, 'update'])->name('size.update');
    // ajax route
    Route::post('brand-wise-size', [SizeController::class, 'brandWiseSize'])->name('Brand-wise-size');
    // ajax route
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('thickness/add', [ThicknessController::class, 'add'])->name('thickness.add');
    Route::get('thickness/edit/{id}', [ThicknessController::class, 'edit'])->name('thickness.edit');
    Route::get('thickness/delete/{id}', [ThicknessController::class, 'delete'])->name('thickness.delete');
    Route::post('thickness/add', [ThicknessController::class, 'store'])->name('thickness.store');
    Route::post('thickness/edit', [ThicknessController::class, 'update'])->name('thickness.update');
    // ajax route
    Route::post('size-wise-thickness', [ThicknessController::class, 'sizeWiseThickness'])->name('size-wise-thickness');
    // ajax route
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('stock/add', [StockController::class, 'add'])->name('stock.add');
    Route::get('stock/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
    Route::get('stock/delete/{id}', [StockController::class, 'delete'])->name('stock.delete');
    Route::get('stock/getBrand/{id}', [StockController::class, 'getBrand'])->name('stock.getBrand');
    Route::get('stock/getSize/{id}', [StockController::class, 'getSize'])->name('stock.getSize');
    Route::get('stock/getThick/{id}', [StockController::class, 'getThick'])->name('stock.getThick');
    Route::post('stock/add', [StockController::class, 'store'])->name('stock.store');
    Route::post('stock/edit', [StockController::class, 'update'])->name('stock.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('vendor/add', [VendorController::class, 'add'])->name('vendor.add');
    Route::get('vendor/edit/{id}', [VendorController::class, 'edit'])->name('vendor.edit');
    Route::get('vendor/delete/{id}', [VendorController::class, 'delete'])->name('vendor.delete');
    Route::post('vendor/add', [VendorController::class, 'store'])->name('vendor.store');
    Route::post('vendor/edit', [VendorController::class, 'update'])->name('vendor.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('labour-rate/add', [LabourRateController::class, 'add'])->name('labour.add');
    Route::get('labour-rate/edit/{id}', [LabourRateController::class, 'edit'])->name('labour.edit');
    Route::get('labour-rate/delete/{id}', [LabourRateController::class, 'delete'])->name('labour.delete');
    Route::post('stock/labour/getSize', [LabourRateController::class, 'getSize'])->name('CategoryIdWiseSize');
    Route::post('labour-rate/add', [LabourRateController::class, 'store'])->name('labour.store');
    Route::post('labour-rate/edit', [LabourRateController::class, 'update'])->name('labour.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('customer/add', [CustomerController::class, 'add'])->name('customer.add');
    Route::get('customer/search/customer/sale', [CustomerController::class, 'searchSalesCustomer'])->name('customer.search.sales');
    Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('customer/add', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('customer/edit', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
    
    
    /* ++++++++++++ Ajax Route IN Customer Id Wise Customer information ++++++++++++ */
    Route::post('check/Contact/number', [CustomerController::class, 'checkCustomerContact'])->name('check.Contact-Number');

    Route::post('customer/information/for/product-purchase', [CustomerController::class, 'CustIdWiseCustomerInformation'])->name('TradeName-wise-Customer.information');

    Route::get('holeseller/customer-list', [CustomerController::class, 'holesellerCustomer'])->name('holeseller-wise.customer');
    Route::get('retailer/customer-list', [CustomerController::class, 'retailerCustomer'])->name('retailer-wise.customer');

    Route::post('define/customer-due', [CustomerController::class, 'DefineCustomerDue'])->name('customerId-wise-customerdue');
    Route::post('Product/sellId/wise/sale/record', [CustomerController::class, 'sellIdWiseSaleRecord'])->name('Product-SellId-wise-sale-record');
    /* ++++++++++++ Ajax Route IN Customer Id Wise Customer information ++++++++++++ */

    // ======##### customer list route   #######=======
    Route::get('customer/list', [CustomerController::class, 'list'])->name('customer.list');
    Route::post('customer/search', [CustomerController::class, 'search'])->name('customer.search');


    // ======##### customer search name phone trade name list route   #######=======
    Route::get('customer/list/search', [CustomerController::class, 'searchlist'])->name('customer.list.search');
    Route::post('customer/list/search', [CustomerController::class, 'searchlistResult'])->name('customer.list.search.result');


    // ======##### customer payment route   #######=======
    Route::get('payment/customer/list', [CustomerController::class, 'listForPay'])->name('payment.customer.list');
     Route::post('payment/customer/search', [CustomerController::class, 'searchForPay'])->name('payment.customer.search');


       // ======##### customer type wise sell info route   #######=======
    Route::get('customer/type-wise/sell/details/list', [CustomerController::class, 'customerTypewiseSellDetailsList'])->name('customer.type-wise.sell-details.list');
    Route::post('customer/type-wise/sell/details/list/search', [CustomerController::class, 'searchCustomerTypewiseSellDetailsList'])->name('customer.type-wise.sell-details.search');



    /* =========== Customer Payment =========== */
    Route::get('customer/payment/add', [CustomerPaymentController::class, 'add'])->name('customer.payment');
    Route::get('customer/payment/edit/{CustPaymId}', [CustomerPaymentController::class, 'edit'])->name('customer.payment-edit');
    Route::get('customer/payment/delete/{CustPaymId}', [CustomerPaymentController::class, 'delete'])->name('customer.payment-delete');
    Route::post('customer/payment/store', [CustomerPaymentController::class, 'store'])->name('store-customer.payment');
    Route::post('customer/payment/update', [CustomerPaymentController::class, 'update'])->name('update-customer.payment');
    Route::post('payment/customer/store', [CustomerPaymentController::class, 'paymentStore'])->name('payment.customer.store');
    Route::get('payment/info/customer/view/{id}', [CustomerPaymentController::class, 'custIdWisePaymentInfo'])->name('payment.info.view.customer');
    Route::get('payment/info/view/{id}', [CustomerPaymentController::class, 'payIdWisePaymentInfo'])->name('payment.info.view');
    Route::get('payment/info/delete/{id}', [CustomerPaymentController::class, 'payIdWisePaymentInfoDelete'])->name('payment.info.delete');
    Route::post('customer/id/date/wise/payment/info/view', [CustomerPaymentController::class, 'dateAndCustomerIdWiseFindPayment'])->name('date.id.wise.payment.info.view');


});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('payment/due/add', [DuePaymentController::class, 'add'])->name('due.payment.add');
    Route::get('payment/due/edit/{id}', [DuePaymentController::class, 'edit'])->name('due.payment.edit');
    Route::post('payment/due/add', [DuePaymentController::class, 'store'])->name('due.payment.store');
    Route::post('payment/due/edit', [DuePaymentController::class, 'update'])->name('due.payment.update');
});


// Route::middleware('auth')->prefix('dashboard')->group(function () {
//     Route::get('customer/type/add', [CustomerTypeController::class, 'add'])->name('customer.type.add');
//     Route::get('customer/type/edit/{id}', [CustomerTypeController::class, 'edit'])->name('customer.type.edit');
//     Route::post('customer/type/add', [CustomerTypeController::class, 'store'])->name('customer.type.store');
//     Route::post('customer/type/edit', [CustomerTypeController::class, 'update'])->name('customer.type.update');
// });


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('company/add', [CompanyInfoController::class, 'add'])->name('company.add');
    Route::get('company/edit/{id}', [CompanyInfoController::class, 'edit'])->name('company.edit');
    Route::post('company/add', [CompanyInfoController::class, 'store'])->name('company.store');
    Route::post('company/edit', [CompanyInfoController::class, 'update'])->name('company.update');

});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('product/activity', [ProductActivityController::class, 'index'])->name('product.activity');
    Route::post('product/activity/brand', [ProductActivityController::class, 'brand'])->name('product.activity.brand');
    Route::post('product/activity/size', [ProductActivityController::class, 'size'])->name('product.activity.size');
    Route::post('product/activity/thik', [ProductActivityController::class, 'thikness'])->name('product.activity.thik');
});




Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('division/add', [DivisionController::class, 'add'])->name('division.add');
    Route::get('division/edit/{id}', [DivisionController::class, 'edit'])->name('division.edit');
    Route::post('division/add', [DivisionController::class, 'store'])->name('division.store');
    Route::post('division/edit', [DivisionController::class, 'update'])->name('division.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('district/add', [DistrictController::class, 'add'])->name('district.add');
    Route::get('district/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
    Route::post('district/add', [DistrictController::class, 'store'])->name('district.store');
    Route::post('district/edit', [DistrictController::class, 'update'])->name('district.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('thana/add', [ThanaController::class, 'add'])->name('thana.add');
    Route::get('thana/edit/{id}', [ThanaController::class, 'edit'])->name('thana.edit');
    Route::post('thana/add', [ThanaController::class, 'store'])->name('thana.store');
    Route::post('thana/edit', [ThanaController::class, 'update'])->name('thana.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('union/add', [UnionController::class, 'add'])->name('union.add');
    Route::get('union/edit/{id}', [UnionController::class, 'edit'])->name('union.edit');
    Route::post('union/add', [UnionController::class, 'store'])->name('union.store');
    Route::post('union/edit', [UnionController::class, 'update'])->name('union.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::post('Division-wise-District', [AjaxController::class, 'getDistrict'])->name('Division-wise-District');
    Route::post('district-wise-thana', [AjaxController::class, 'getThana'])->name('District-wise-thana');
    Route::post('thana-wise-union', [AjaxController::class, 'getUnion'])->name('Thana-wise-union');
});



Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('product/purchase/add', [ProductPurchaseController::class, 'add'])->name('product.purchase.add');

    Route::get('product/purchase/edit/{id}', [ProductPurchaseController::class, 'edit'])->name('product.purchase.edit');

    Route::post('product/purchase/add', [ProductPurchaseController::class, 'store'])->name('product.purchase.store');

    Route::post('product/purchase/edit', [ProductPurchaseController::class, 'update'])->name('product.purchase.update');

    /* ++++++++++++ Ajax Route IN Add To Cart ++++++++++++ */
    Route::post('product/purchase/add-to-cart', [ProductPurchaseController::class, 'productAddToCart'])->name('product-purchase.addToCart');

    Route::get('product/purchase/order-list', [ProductPurchaseController::class, 'getOrderList'])->name('product-purchase-listIn.addToCart');

    Route::post('product/purchase/qunatity-increment', [ProductPurchaseController::class, 'QunatityIncrement'])->name('QunatityIncrement');

    Route::post('product/purchase/qunatity-decrement', [ProductPurchaseController::class, 'QunatityDecrement'])->name('QunatityDecrement');

    Route::post('product/purchase/remove', [ProductPurchaseController::class, 'productRemoveToCart'])->name('remove-cart');
    /* ++++++++++++ Ajax Route IN Add To Cart ++++++++++++ */
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('product/hole-seller/purchase', [HoleSellerController::class, 'add'])->name('Product.Hole.Seller');
    /* ++++++++++++ Ajax Route IN Add To Cart ++++++++++++ */
    Route::post('product/hole-seller/purchase/add-to-cart', [HoleSellerController::class, 'productAddToCart'])->name('holeseller-purchase.addToCart');

    Route::post('product/hole-seller/purchase/remove-to-cart', [HoleSellerController::class, 'productRemoveToCart'])->name('remove-cart-in.holeseller');

    Route::post('product/hole-seller/purchase/increment-to-cart', [HoleSellerController::class, 'QunatityIncrement'])->name('QunatityIncrementInHoleSeller');

    Route::post('product/hole-seller/purchase/decrement-to-cart', [HoleSellerController::class, 'QunatityDecrement'])->name('cartDecrementInHoleSeller');

    /* ++++++++++++ Ajax Route IN Add To Cart ++++++++++++ */
    Route::post('product/hole-seller/store', [HoleSellerController::class, 'productSellStore'])->name('product.seller');

});

/* ============ Retailer ============ */
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('product/retail-seller/purchase', [RetailSellerController::class, 'add'])->name('Product.Retailer.Seller');
    Route::post('product/retail-seller/purchase/store', [RetailSellerController::class, 'store'])->name('product.purchase-in.retailer');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('credit/type', [CreditTypeController::class, 'add'])->name('credit.type');
    Route::post('credit/type', [CreditTypeController::class, 'store'])->name('credit.type.store');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('debit/type', [DebitTypeController::class, 'add'])->name('debit.type');
    Route::post('debit/type', [DebitTypeController::class, 'store'])->name('debit.type.store');
});


/* ============ credit-voucher ============ */
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('credit-voucher/add', [CreditVoucherController::class, 'index'])->name('CreitVoucher.add');
    Route::get('credit-voucher/edit/{id}', [CreditVoucherController::class, 'edit'])->name('CreitVoucher.edit');
    Route::get('credit-voucher/delete/{id}', [CreditVoucherController::class, 'delete'])->name('CreitVoucher.delete');
    Route::post('credit-voucher/add', [CreditVoucherController::class, 'store'])->name('CreitVoucher.store');
    Route::post('credit-voucher/edit', [CreditVoucherController::class, 'update'])->name('CreitVoucher.update');
});

/* ============ debit-voucher ============ */
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('debit-voucher/add', [DebitVoucherController::class, 'index'])->name('DebitVoucher.add');

    Route::post('debit-voucher/edit/', [DebitVoucherController::class, 'edit'])->name('DebitVoucher.edit');

    Route::get('debit-voucher/delete/{id}', [DebitVoucherController::class, 'delete'])->name('DebitVoucher.delete');
    Route::post('debit-voucher/add', [DebitVoucherController::class, 'store'])->name('DebitVoucher.store');
    Route::post('debit-voucher/update', [DebitVoucherController::class, 'update'])->name('DebitVoucher.update');
});

/* ============ cseller controller ============ */
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('sell-info', [SellerController::class, 'index'])->name('sell.info');
    Route::get('sell/info/customer/view/{id}', [SellerController::class, 'customerWieSell'])->name('customer.wise.sell.info');
    Route::get('sell/info/customer/view/', [SellerController::class, 'dateAndIdWiseSellInfo'])->name('customer.id.date.wise.sell.info');
});



// ========######### Sell Return ##########===========
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('sell-return', [SellReturnController::class, 'index'])->name('sell.return');
});


/* ============ Category & size wise labour cost ============ */
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::post('category-size/wise/labour/cost', [AjaxController::class, 'getLabourCost'])->name('Category.sizeWise.LabourCost');
});
require __DIR__.'/auth.php';
