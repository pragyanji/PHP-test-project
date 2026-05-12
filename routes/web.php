<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::get('/', function () {
    return view('products.index');
});

// Route for products
Route::get('/product/details', [ProductController::class, 'product_details'])->name('products.product_details');
Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/product', [ProductController::class, 'store'])->name('products.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/product/delete/{product}', [ProductController::class, 'delete'])->name('products.delete');


// Route for User
Route::post('/save/user', [RegisteredUserController::class, 'store'])->name('save.user');
Route::post('/login/user', [AuthenticatedSessionController::class, 'store'])->name('login.user');

Route::get(uri: '/user/login', action: function (){
    return view('auth.login');
})->name(name: 'login');

Route::get(uri: '/user/register', action: function (){
    return view('auth.register');
})->name(name: 'user.register');

Route::get(uri: '/user/register', action: function (){
    return view('auth.register');
})->name(name: 'user.register');

Route::get(uri: '/user/forgot-password', action: function (){
    return view('auth.forgot-password');
})->name(name: 'user.forgot-password');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
