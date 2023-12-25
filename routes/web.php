<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products', [ProductController::class, 'productsList'])->name('products.list');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');
    Route::get('/export', [ProductController::class, 'export']);
});

Route::controller(AuthController::class)->middleware('guest')->group(function(){
    Route::get('/', 'index')->name('login');
    Route::post('/authenticate','authenticate');
});
