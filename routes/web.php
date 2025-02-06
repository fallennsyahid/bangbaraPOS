<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ErrorController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\ProductController as Enter;
use App\Http\Controllers\Staff\StaffOrdersController;
use App\Http\Controllers\HistoryController as History;
use App\Http\Controllers\Staff\StaffHistoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', Enter::class);

Route::get('/#menu', [HistoryController::class, 'indexMenu'])->name('indexMenu');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/history', [History::class, 'index'])->name('history');

Route::get('/details', [DetailsController::class, 'index'])->name('details');

Route::get('/error', [ErrorController::class, 'index']);

// Staff Route
Route::get('/staff/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'staff'])
    ->name('staff.dashboard');

Route::resource('/staff/staffOrders', StaffOrdersController::class);
Route::resource('/staff/staffHistories', StaffHistoryController::class);

// Admin Route
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Export Excel
Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
Route::get('categories/export', [CategoryController::class, 'export'])->name('categories.export');
Route::get('orders/export', [OrderAdminController::class, 'export'])->name('orders.export');
Route::get('/admin/histories/export', [HistoryController::class, 'export'])->name('admin.histories.export');

// Category Routes
Route::resource('/admin/categories', CategoryController::class);
// Products Routes
Route::resource('/admin/products', ProductController::class);
// Orders Routes
Route::resource('/admin/orders', OrderAdminController::class);
// History Routes
Route::resource('/admin/histories', HistoryController::class);
// Staffs Routes
Route::resource('/admin/staffs', StaffController::class);
Route::delete('/admin/staffs/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');

// Untuk mengubah status
Route::patch('/admin/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.index');

// Filter History
Route::get('histories/filter', [HistoryController::class, 'filter'])->name('histories.filter');

// 


require __DIR__ . '/auth.php';
