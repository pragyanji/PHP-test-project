<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('products.index');
});

Route::view('/test/{item}', 'testpage');
// Route for products
Route::get('/product/details', [ProductController::class, 'product_details'])->name('products.product_details');
// Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');

// Product routes that require authentication
Route::middleware('auth')->group(function () {
    Route::view('/product/create', 'products.create')->name('products.create');
    Route::post('/product', [ProductController::class, 'store'])->name('products.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/product/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');

    // Sales Routes
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sale}/receipt', [SaleController::class, 'receipt'])->name('sales.receipt');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
