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
use App\Http\Controllers\Admin\NotificationContrller;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Staff\StaffOrdersController;
use App\Http\Controllers\Staff\StaffProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Staff\StaffHistoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::post('/', [HomeController::class, 'store'])->name('index.store');

Route::get('/#menu', [HomeController::class, 'menu'])->name('index#menu');

Route::get('/history', [History::class, 'index'])->name('history');

Route::get('/details', [DetailsController::class, 'index'])->name('details');

Route::get('/testing', function () {
    return view('testing');
});

// Error Route Page
Route::get('/error', [ErrorController::class, 'index']);

// CART
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart/total', [CartController::class, 'getTotal'])->name('cart.total');


// ORDER CART
Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/order-success', function () {
    return view('order-success');
})->name('order.success');

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
Route::get('/export-histories', [HistoryController::class, 'export'])->name('admin.histories.export');
Route::get('/export-orders-today', [StaffOrdersController::class, 'exportToday'])->name('orders.today');
Route::get('/export-histories-today', [StaffHistoryController::class, 'exportToday'])->name('histories.today');

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
        'id',
        'customer_name',
        'status',
        'total_price',
        'created_at'
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

Route::resource('/admin/notification', NotificationContrller::class);

// Reviews
Route::resource('/admin/reviews', ReviewController::class);

// Chart Route
Route::get('/chart-data', [AdminController::class, 'getChartData']);
Route::get('/best-seller-chart', [AdminController::class, 'getBestSellerChartData']);
Route::get('/orders-stats', [AdminController::class, 'getOrdersStats']);
// Filter method chart
Route::get('/orders-stats', [AdminController::class, 'getOrdersStats']);

// Update status
Route::get('/orders/{id}/status', function ($id) {
    $order = Order::find($id);
    return response()->json(['status' => $order->status]);
});

// Table history route
Route::get('/get-histories', [HistoryController::class, 'getHistories']);

// Total Orders API
Route::get('/get-total-orders', function () {
    return response()->json([
        'total_orders' => Order::count(),
    ]);
});
Route::get('/get-total-orders-today', function () {
    return response()->json([
        'total_orders' => Order::whereDate('created_at', Carbon::today())->count(),
    ]);
});

Route::get('/get-orders', function () {
    $orders = Order::with('product')->orderBy('created_at', 'desc')->get();
    return response()->json($orders);
});


require __DIR__ . '/auth.php';
