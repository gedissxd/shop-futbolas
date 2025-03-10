<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');


Route::view('dashboard', 'dashboard.index')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Dashboard home
    Route::get('/dashboard', function () {
        $products = Product::latest()->get();
        return view('dashboard.index', compact('products'));
    })->name('dashboard');

    Route::get('/dashboard/update/{id}', function ($id) {
        $product = Product::find($id);
        return view('dashboard.update', compact('product'));
    })->name('dashboard.update');

    Route::get('/dashboard/create', function () {
        return view('dashboard.create');
    })->name('dashboard.create');

    Route::patch('/dashboard/update/{id}', [ProductController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/update/{id}', [ProductController::class, 'destroy'])->name('dashboard.destroy');
});

require __DIR__.'/auth.php';
