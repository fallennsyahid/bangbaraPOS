<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function dashboard() {
        // fungsi untuk ,enghitung jumlah data
        $products = Product::count();
        $total_orders = Order::count();

        // fungsi chart
         // Mengambil data total orders per bulan
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $months = $orders->pluck('month')->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $totals = $orders->pluck('total');


        return view('admin.dashboard', compact('products', 'total_orders', 'months', 'totals'));
    }
}
