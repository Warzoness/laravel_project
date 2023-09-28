<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

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

Route::get('/logon',[AccountController::class,'logonIndex'])->name('logon.index');
Route::post('/logon',[AccountController::class,'logon'])->name('logon');
Route::get('/logout',[AccountController::class,'logout'])->name('logout');

Route::get('/register',[AccountController::class,'registerIndex'])->name('register.index');

Route::post('/register',[AccountController::class,'register'])->name('register');


Route::prefix('fe')->group(function () {
    
});



Route::prefix('admin')->middleware('admin_auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('search',[CategoryController::class,'search'])->name('categories.search');
    Route::resource('products',ProductsController::class);
    Route::get('/trash-can-category',[CategoryController::class,'trashIndex'])->name('trashCate.index');
    Route::get('/trash-can-category/{id}',[CategoryController::class,'trashRestore'])->name('trashCate.restore');
    Route::delete('/trash-can-category-delete/{id}',[CategoryController::class,'forceDelete'])->name('trashCate.forceDelete');
});