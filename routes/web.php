<?php

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




Route::middleware(['auth:sanctum', 'verified'])->get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::middleware(['auth:sanctum', 'verified'])->get('/product/show/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show_product');
Route::middleware(['auth:sanctum', 'verified'])->get('/product/delete/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('delete_product');
Route::middleware(['auth:sanctum', 'verified'])->post('/product/store', [\App\Http\Controllers\ProductController::class, 'store'])->name('store_product');
Route::middleware(['auth:sanctum', 'verified'])->post('/product/update', [\App\Http\Controllers\ProductController::class, 'update'])->name('update_product');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
