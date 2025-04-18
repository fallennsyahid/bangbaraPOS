<?php

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ErrorController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\StruckController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\NotificationContrller;
use App\Http\Controllers\Staff\StaffOrdersController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Staff\StaffHistoryController;
use App\Http\Controllers\Staff\StaffProfileController;

// Route halaman utama
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/', [HomeController::class, 'store'])->name('index.store');
Route::get('/#menu', [HomeController::class, 'menu'])->name('index#menu');

Route::get('/testing', function () {
    return view('testing');
});

// Halaman error
Route::get('/error', [ErrorController::class, 'index']);

// --- ROUTE KERANJANG (CART) ---
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart', [CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
// Route::get('/cart/total', [CartController::class, 'getTotal'])->name('cart.total');
// Route::patch('/cart/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');

// --- ROUTE ORDER ---
Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/order-success', function () {
    return view('order-success');
})->name('order.success');

// --- ROUTE STAFF ---
Route::get('/staff/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'staff'])
    ->name('staff.dashboard');

Route::resource('/staff/staffOrders', StaffOrdersController::class);
Route::resource('/staff/staffHistories', StaffHistoryController::class);
Route::resource('/staff/staffProfile', StaffProfileController::class);

// --- ROUTE ADMIN ---
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- EXPORT EXCEL ---
Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
Route::get('categories/export', [CategoryController::class, 'export'])->name('categories.export');
Route::get('orders/export', [OrderAdminController::class, 'export'])->name('orders.export');
Route::get('users/export', [StaffController::class, 'export'])->name('users.export');
Route::get('/export-histories', [HistoryController::class, 'export'])->name('admin.histories.export');
Route::get('/export-orders-today', [StaffOrdersController::class, 'exportToday'])->name('orders.today');
Route::get('/export-histories-today', [StaffHistoryController::class, 'exportToday'])->name('histories.today');

// --- IMPORT EXCEL ---
Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

// --- RESOURCE ROUTES ---
// Category Routes
Route::resource('/admin/categories', CategoryController::class);
// Product Routes
Route::resource('/admin/products', ProductController::class);
// Order Routes
Route::resource('/admin/orders', OrderAdminController::class);
// History Routes
Route::resource('/admin/histories', HistoryController::class);
// Staff Routes
Route::resource('/admin/staffs', StaffController::class);
Route::delete('/admin/staffs/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');
// Profile Routes
Route::resource('/admin/profile', AdminProfileController::class);

// --- UPDATE STATUS ORDER ---
// Untuk mengubah status order
Route::patch('/admin/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])->name('admin.orders.index');

// --- FILTER HISTORY ---
Route::get('histories/filter', [HistoryController::class, 'filter'])->name('histories.filter');

// --- NOTIFIKASI ---
Route::get('/notifications', function () {
    $orders = Order::where('status', 'Pending')
        ->whereDate('created_at', Carbon::today())
        ->latest()
        ->take(5)
        ->get([
            'id',
            'customer_name',
            'status',
            'total_price',
            'created_at'
        ]);

    return response()->json([
        'count'  => $orders->count(),
        'orders' => $orders->map(function ($order) {
            return [
                'id'            => $order->id,
                'customer_name' => $order->customer_name,
                'status'        => $order->status,
                'total_price'   => $order->total_price,
                'created_at'    => $order->created_at->diffForHumans()
            ];
        })
    ]);
});

Route::resource('/admin/notification', NotificationContrller::class);

// --- REALTIME ORDERS ---
// Route::get('/orders', OrdersTable::class)->name('orders.index');
Route::get('/orders/latest', function () {
    $latestOrder = Order::latest('created_at')->first();
    return response()->json($latestOrder);
});

Route::get('/orders/latest-today', function () {
    $latestOrder = Order::whereDate('created_at', Carbon::today())
        ->latest('created_at')
        ->first();
    return response()->json($latestOrder);
});

// --- REVIEWS ---
Route::resource('/admin/reviews', ReviewController::class);

// --- CHART ROUTES ---
Route::get('/chart-data', [AdminController::class, 'getChartData']);
Route::get('/best-seller-chart', [AdminController::class, 'getBestSellerChartData']);
Route::get('/best-seller-today', [DashboardController::class, 'getBestSellerChartData']);
Route::get('/best-seller-chart-filter', [AdminController::class, 'getBestSellerChartDataFilter']);
Route::get('/orders-stats', [AdminController::class, 'getOrdersStats']);
Route::get('/hourly-orders-stats', [AdminController::class, 'getHourlyPaymentStats']);

// --- UPDATE STATUS MELALUI GET ---
Route::get('/orders/{id}/status', function ($id) {
    $order = Order::find($id);
    return response()->json([
        'status' => $order->status
    ]);
});

// --- TABLE HISTORY ---
Route::get('/get-histories', [HistoryController::class, 'getHistories']);

// --- TOTAL ORDERS API ---
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
    $orders = Order::with('product')
        ->orderBy('created_at', 'desc')
        ->get();
    return response()->json($orders);
});

// --- ROUTE SWITCH TOKO ---
Route::post('/store/toggle-status', [StoreController::class, 'toggleStatus'])->name('store.toggleStatus');

// --- ROUTE BULK DELETE ---
// Route::delete('/admin/orders', [OrderAdminController::class, 'bulkDelete']);

// --- PRINT STRUK ---
// Route::get('/cetak-struk/{id}', [PrintController::class, 'print'])->name('print.struck');

Route::post('/admin/print-struk/{id}', [StruckController::class, 'print']);
Route::delete('/bulk-delete', [HistoryController::class, 'bulkDelete'])->name('histories.bulkDelete');

// Route Settings
Route::resource('/admin/settings', SettingsController::class);
Route::get('/staff/settings', [SettingsController::class, 'staffIndex'])->name('staffSettings.index');

// Autentikasi route
require __DIR__ . '/auth.php';
