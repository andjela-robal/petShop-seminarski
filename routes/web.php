<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Admin Login Information
// Email: 'andjela@gmail.com'
// Password: '12345678'

// Normal User Login Information
// Email: 'test@gmail.com'
// Password: '87654321'

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::resource('products', ProductController::class);

//Products
Route::get('product/{category}', [ProductController::class, 'procat']);
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::delete('/products/{slug}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{slug}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/{slug}/edit', [ProductController::class, 'edit'])->name('products.edit');

//Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

//Shipping placeholder
Route::post('/shipping', function () {
    return redirect()->back()->with('success', 'Shipping information submitted successfully.');
})->name('shipping.store');
