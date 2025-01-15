<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth', 'admin');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Export Excel
Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
Route::get('categories/export', [CategoryController::class, 'export'])->name('categories.export');

// Category Routes
Route::resource('/admin/categories', CategoryController::class);
// Products Routes
Route::resource('/admin/products', ProductController::class);
// Orders Routes
Route::resource('/admin/orders', OrderAdminController::class);

// Untuk mengubah status
Route::patch('/admin/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.index');

require __DIR__.'/auth.php';
