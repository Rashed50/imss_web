<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
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



require __DIR__.'/auth.php';
