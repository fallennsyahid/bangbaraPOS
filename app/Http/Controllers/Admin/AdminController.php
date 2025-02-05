<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function dashboard() {
        // fungsi untuk ,enghitung jumlah data
        $products = Product::count();
        $total_orders_completed = Order::where('status', 'Completed')->count();
        $total_orders_cancelled = Order::where('status', 'Cancelled')->count();
        $total_orders = Order::count();
        $histories = History::count();
        $totalIncome = DB::table('histories')->sum('total_price');

        // fungsi chart
         // Mengambil data total orders per bulan
        $history = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $months = $history->pluck('month')->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $totals = $history->pluck('total');


        return view('admin.dashboard', compact('products', 'total_orders', 'months', 'totals', 'histories', 'totalIncome', 'total_orders_completed', 'total_orders_cancelled'));
    }
}
