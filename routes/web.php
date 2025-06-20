<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [ProductController::class, 'showFeatured'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{name}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', function () {
    return view('cart.index');
})->name('cart');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');


Route::middleware(['auth'])->group(function () {

    //settings
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    Route::middleware('can:admin-access')->group(function () {
        Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users');
        Route::delete('/dashboard/users/delete/{id}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');
        Route::get('/dashboard/users/edit/{id}', [UserController::class, 'edit'])->name('dashboard.users.edit');
        Route::patch('/dashboard/users/edit/{id}', [UserController::class, 'update'])->name('dashboard.users.update');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
        Route::post('/dashboard/create', [DashboardController::class, 'store'])->name('dashboard.store');
        Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard.edit');
        Route::patch('/dashboard/update/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
        Route::delete('/dashboard/update/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
        Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
    });
});
require __DIR__.'/auth.php';
