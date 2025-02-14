<?php

use Illuminate\Support\Facades\Route;
use App\Models\Order;
use App\Models\History;
use Carbon\Carbon;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ErrorController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Staff\StaffOrdersController;
use App\Http\Controllers\Staff\StaffProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Staff\StaffHistoryController;
use App\Models\Product;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::post('/', [HomeController::class, 'store'])->name('index.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/history', [History::class, 'index'])->name('history');

Route::get('/details', [DetailsController::class, 'index'])->name('details');

// Error Route Page
Route::get('/error', [ErrorController::class, 'index']);

// Staff Route
Route::get('/staff/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'staff'])
    ->name('staff.dashboard');

Route::resource('/staff/staffOrders', StaffOrdersController::class);
Route::resource('/staff/staffHistories', StaffHistoryController::class);
Route::resource('/staff/staffProfile', StaffProfileController::class);

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
Route::get('users/export', [StaffController::class, 'export'])->name('users.export');
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
// Profile Routes
Route::resource('/admin/profile', AdminProfileController::class);
// Untuk mengubah status
Route::patch('/admin/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.index');

// Filter History
Route::get('histories/filter', [HistoryController::class, 'filter'])->name('histories.filter');

//notif
Route::get('/notifications', function () {
    $orders = Order::where('status', 'Pending')->whereDate('created_at', Carbon::today())->latest()->take(5)->get([
        'id', 'customer_name', 'status', 'total_price', 'created_at'
    ]);

    return response()->json([
        'count' => $orders->count(),
        'orders' => $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'customer_name' => $order->customer_name,
                'status' => $order->status,
                'total_price' => $order->total_price,
                'created_at' => $order->created_at->diffForHumans()
            ];
        })
    ]);
});

// Reviews
Route::resource('/admin/reviews', ReviewController::class);

// Chart Route
Route::get('/chart-data', [AdminController::class, 'getChartData']);

// Update status
Route::get('/orders/{id}/status', function ($id) {
    $order = Order::find($id);
    return response()->json(['status' => $order->status]);
});

// Table history route
Route::get('/get-histories', [HistoryController::class, 'getHistories']);


require __DIR__ . '/auth.php';
