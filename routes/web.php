<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
=======
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ThicknessController;
use App\Http\Controllers\admin\StockController;
>>>>>>> f7de62e53aa71514528198d9e084326a0902d0a5
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

<<<<<<< HEAD
Route::get('/clear-cache', function() {

    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    return view('admin.dashboard.index');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth'])->name('dashboard');

//brand route


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/brand', [BrandController::class, 'index'])->name('brand');
    Route::get('/brand/add', [BrandController::class, 'add'])->name('brand-add');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('admin/user', [UserController::class, 'index'])->name('user');
    Route::get('admin/user/add', [UserController::class, 'add'])->name('user-add');
    Route::get('admin/user/edit/{slug}', [UserController::class, 'edit'])->name('user-edit');
    Route::get('admin/user/view/{slug}', [UserController::class, 'view'])->name('user-view');
    Route::post('admin/user', [UserController::class, 'insert'])->name('user');
    Route::post('admin/user/update', [UserController::class, 'update'])->name('user-update');
    Route::post('admin/user/softdelete', [UserController::class, 'softdelete'])->name('user-softdelete');
    Route::post('admin/user/restore', [UserController::class, 'restore'])->name('user-restore');
    Route::post('admin/user/delete', [UserController::class, 'delete'])->name('user-delete');
});

//member panel routes start
Route::get('dashboard/member/password', [MemberApplicationController::class, 'password']);
Route::get('dashboard/member/information', [MemberApplicationController::class, 'information']);
Route::post('dashboard/member/information/update', [MemberApplicationController::class, 'updateInfo']);
Route::post('dashboard/member/password/update', [MemberApplicationController::class, 'updatePass']);
=======
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
});


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/add', [BrandController::class, 'store'])->name('brand.store');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('size/add', [SizeController::class, 'add'])->name('size.add');
    Route::get('size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
    Route::post('size/add', [SizeController::class, 'store'])->name('size.store');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('thickness/add', [ThicknessController::class, 'add'])->name('thickness.add');
    Route::get('thickness/edit/{id}', [ThicknessController::class, 'edit'])->name('thickness.edit');
    Route::post('thickness/add', [ThicknessController::class, 'store'])->name('thickness.store');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('stock/add', [StockController::class, 'add'])->name('stock.add');
    Route::get('stock/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
    Route::post('stock/add', [StockController::class, 'store'])->name('stock.store');
});
>>>>>>> f7de62e53aa71514528198d9e084326a0902d0a5



require __DIR__.'/auth.php';
