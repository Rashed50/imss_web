<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ThicknessController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\admin\VendorController;
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
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('size/add', [SizeController::class, 'add'])->name('size.add');
    Route::get('size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
    Route::post('size/add', [SizeController::class, 'store'])->name('size.store');
    Route::post('size/edit', [SizeController::class, 'update'])->name('size.update');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('thickness/add', [ThicknessController::class, 'add'])->name('thickness.add');
    Route::get('thickness/edit/{id}', [ThicknessController::class, 'edit'])->name('thickness.edit');
    Route::post('thickness/add', [ThicknessController::class, 'store'])->name('thickness.store');
    Route::post('thickness/edit', [ThicknessController::class, 'update'])->name('thickness.update');
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



require __DIR__.'/auth.php';
