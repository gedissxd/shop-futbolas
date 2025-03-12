<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Models\Cart;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\DashboardUsersController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', function () {
    return view('cart.index');
})->name('cart');


    
Route::middleware(['auth'])->group(function () {

    //settings
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');




    //dashboard
    Route::get('/orders', [OrderController::class, 'index'])->name('dashboard.orders');

    Route::get('/dashboard/users', [DashboardUsersController::class, 'index'])->name('dashboard.users');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/create', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard.edit');
    
    Route::patch('/dashboard/update/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/update/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');

    //stripe

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});
require __DIR__.'/auth.php';
