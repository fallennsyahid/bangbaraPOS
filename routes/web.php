<?php

use Illuminate\Support\Facades\Route;
use App\Models\Order;
use App\Models\History;
use Carbon\Carbon;
use App\Http\Controllers\CartController;
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
use App\Http\Controllers\Admin\StruckController;
use App\Http\Controllers\Admin\StruckOrderController;
use App\Http\Controllers\Staff\StaffOrdersController;
use App\Http\Controllers\Staff\StaffProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Staff\StaffHistoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Staff\StruckHistoryController;
use App\Http\Controllers\Staff\StruckOrdersStaffController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::post('/', [HomeController::class, 'store'])->name('index.store');

Route::get('/#menu', [HomeController::class, 'menu'])->name('index#menu');

Route::get('/testing', function () {
    return view('testing');
});

// Error Route Page
Route::get('/error', [ErrorController::class, 'index']);

// CART
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart', [CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
// Route::get('/cart/total', [CartController::class, 'getTotal'])->name('cart.total');
// Route::patch('/cart/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');


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

// Staff Struck Route
Route::post('/staff/histories/print-struk/{id}', [StruckHistoryController::class, 'print']);
Route::post('/staff/orders/print-struk/{id}', [StruckOrdersStaffController::class, 'print']);


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

// Import Excel
Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

// Category Routes
Route::resource('/admin/categories', CategoryController::class);
Route::delete('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');

// Products Routes
Route::resource('/admin/products', ProductController::class);
Route::delete('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulkDelete');

// Orders Routes
Route::resource('/admin/orders', OrderAdminController::class);
Route::delete('/orders/bulk-delete', [OrderAdminController::class, 'bulkDelete'])->name('orders.bulkDelete');
Route::post('/admin/orders/print-struk/{id}', [StruckOrderController::class, 'print']);


// History Routes
Route::resource('/admin/histories', HistoryController::class);
Route::delete('/bulk-delete', [HistoryController::class, 'bulkDelete'])->name('histories.bulkDelete');
Route::post('/admin/histories/print-struk/{id}', [StruckController::class, 'print'])->name('admin.print.struk');


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
// Table Orders Realtime
// Route::get('/orders', OrdersTable::class)->name('orders.index');
Route::get('/orders/latest', function () {
    $latestOrder = Order::latest('created_at')->first();
    return response()->json($latestOrder);
});

Route::get('/orders/latest-today', function () {
    $latestOrder = Order::whereDate('created_at', Carbon::today())->latest('created_at')->first();
    return response()->json($latestOrder);
});


// Reviews
Route::resource('/admin/reviews', ReviewController::class);
Route::delete('/reviews/bulkDelete', [ReviewController::class, 'bulkDelete'])->name('reviews.bulkDelete');

// Chart Route
Route::get('/chart-data', [AdminController::class, 'getChartData']);
Route::get('/best-seller-chart', [AdminController::class, 'getBestSellerChartData']);
Route::get('/best-seller-today', [DashboardController::class, 'getBestSellerChartData']);
Route::get('/hourly-orders-stats', [DashboardController::class, 'getOrderStats']);
Route::get('/best-seller-chart-filter', [AdminController::class, 'getBestSellerChartDataFilter']);
Route::get('/orders-stats', [AdminController::class, 'getOrdersStats']);
// Filter method chart
Route::get('/hourly-orders-stats', [AdminController::class, 'getHourlyPaymentStats']);

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

// Route Switch Toko
Route::post('/store/toggle-status', [StoreController::class, 'toggleStatus'])->name('store.toggleStatus');

// Route Bulk Delete
// Route::delete('/admin/orders', [OrderAdminController::class, 'bulkDelete']);


require __DIR__ . '/auth.php';
