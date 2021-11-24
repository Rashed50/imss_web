<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ThicknessController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\CustomerTypeController;
use App\Http\Controllers\admin\CompanyInfoController;
use App\Http\Controllers\admin\HoleSellerController;

use App\Http\Controllers\admin\ThanaController;
use App\Http\Controllers\admin\ProductPurchaseController;
use App\Http\Controllers\admin\EmployeeInfoController;

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

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/add', function () {
    return view('admin.add');
})->middleware(['auth'])->name('add.here');

/* ++++++++++++++++++++++ Employee ++++++++++++++++++++++ */
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('employee/add', [EmployeeInfoController::class, 'add'])->name('employee.add');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/add', [CategoryController::class, 'store'])->name('category.store');
    Route::post('category/edit', [CategoryController::class, 'update'])->name('category.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/add', [BrandController::class, 'store'])->name('brand.store');
    Route::post('brand/edit', [BrandController::class, 'update'])->name('brand.update');
    // ajax route
    Route::post('category-wise-brand', [BrandController::class, 'categoryWiseBrand'])->name('Category-wise-Brand');
    // ajax route
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('size/add', [SizeController::class, 'add'])->name('size.add');
    Route::get('size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
    Route::post('size/add', [SizeController::class, 'store'])->name('size.store');
    Route::post('size/edit', [SizeController::class, 'update'])->name('size.update');
    // ajax route
    Route::post('brand-wise-size', [SizeController::class, 'brandWiseSize'])->name('Brand-wise-size');
    // ajax route
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('thickness/add', [ThicknessController::class, 'add'])->name('thickness.add');
    Route::get('thickness/edit/{id}', [ThicknessController::class, 'edit'])->name('thickness.edit');
    Route::post('thickness/add', [ThicknessController::class, 'store'])->name('thickness.store');
    Route::post('thickness/edit', [ThicknessController::class, 'update'])->name('thickness.update');
    // ajax route
    Route::post('size-wise-thickness', [ThicknessController::class, 'sizeWiseThickness'])->name('size-wise-thickness');
    // ajax route
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('stock/add', [StockController::class, 'add'])->name('stock.add');
    Route::get('stock/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
    Route::get('stock/getBrand/{id}', [StockController::class, 'getBrand'])->name('stock.getBrand');
    Route::get('stock/getSize/{id}', [StockController::class, 'getSize'])->name('stock.getSize');
    Route::get('stock/getThick/{id}', [StockController::class, 'getThick'])->name('stock.getThick');
    Route::post('stock/add', [StockController::class, 'store'])->name('stock.store');
    Route::post('stock/edit', [StockController::class, 'update'])->name('stock.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('vendor/add', [VendorController::class, 'add'])->name('vendor.add');
    Route::get('vendor/edit/{id}', [VendorController::class, 'edit'])->name('vendor.edit');
    Route::post('vendor/add', [VendorController::class, 'store'])->name('vendor.store');
    Route::post('vendor/edit', [VendorController::class, 'update'])->name('vendor.update');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('customer/add', [CustomerController::class, 'add'])->name('customer.add');
    Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('customer/add', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('customer/edit', [CustomerController::class, 'update'])->name('customer.update');
    /* ++++++++++++ Ajax Route IN Customer Id Wise Customer information ++++++++++++ */
    Route::post('customer/information/for/product-purchase', [CustomerController::class, 'CustIdWiseCustomerInformation'])->name('TradeName-wise-Customer.information');
    /* ++++++++++++ Ajax Route IN Customer Id Wise Customer information ++++++++++++ */
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('customer/type/add', [CustomerTypeController::class, 'add'])->name('customer.type.add');
    Route::get('customer/type/edit/{id}', [CustomerTypeController::class, 'edit'])->name('customer.type.edit');
    Route::post('customer/type/add', [CustomerTypeController::class, 'store'])->name('customer.type.store');
    Route::post('customer/type/edit', [CustomerTypeController::class, 'update'])->name('customer.type.update');
});



Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('company/add', [CompanyInfoController::class, 'add'])->name('company.add');
    Route::get('company/edit/{id}', [CompanyInfoController::class, 'edit'])->name('company.edit');
    Route::post('company/add', [CompanyInfoController::class, 'store'])->name('company.store');
    Route::post('company/edit', [CompanyInfoController::class, 'update'])->name('company.update');
});


Route::middleware('auth')->prefix('dashboard')->group(function () {

    Route::post('district-wise-thana', [ThanaController::class, 'getThana'])->name('District-wise-thana');
    Route::post('thana-wise-union', [ThanaController::class, 'getUnion'])->name('Thana-wise-union');
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


require __DIR__.'/auth.php';
