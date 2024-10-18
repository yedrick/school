<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::group(['prefix' => 'products'], function(){
    Route::get('/', [ProductController::class ,'index'])->name('products.index');
    Route::get('/create', [ProductController::class ,'create'])->name('products.create');
    Route::post('/store', [ProductController::class ,'store'])->name('products.store');
    Route::get('/{product}/show', [ProductController::class ,'show'])->name('products.show');
    Route::get('/{product}/edit', [ProductController::class ,'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class ,'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class ,'destroy'])->name('products.destroy');
    Route::get('/generate-excel', [ProductController::class ,'generateExcel'])->name('products.generateExcel');
});

// category
Route::group(['prefix' => 'categories'], function(){
    Route::get('/', [CategoryController::class ,'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class ,'create'])->name('categories.create');
    Route::post('/store', [CategoryController::class ,'store'])->name('categories.store');
    Route::get('/{category}/show', [CategoryController::class ,'show'])->name('categories.show');
    Route::get('/{category}/edit', [CategoryController::class ,'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class ,'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class ,'destroy'])->name('categories.destroy');
});

