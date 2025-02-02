<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('staff.dashboard');
    }

    public function dashboard() {
        // fungsi untuk ,enghitung jumlah data
        $products = Product::count();
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


        return view('staff.dashboard', compact('products', 'total_orders', 'months', 'totals', 'histories', 'totalIncome'));
    }
}
