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

   // Controller (AdminController.php)
    public function dashboard(Request $request) {
        
        $products = Product::count();
        $total_orders_completed = Order::where('status', 'Completed')->count();
        $total_orders_cancelled = Order::where('status', 'Cancelled')->count();
        $total_orders = Order::count();
        $histories = History::count();
        $totalIncome = DB::table('histories')->sum('total_price');

        $year = $request->input('year', date('Y')); // Default tahun sekarang
        $years = History::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');

        // Ambil data awal untuk chart
        $history = History::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = $history->pluck('month')->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $totals = $history->pluck('total');

        return view('admin.dashboard', compact('products', 'total_orders', 'year', 'years', 'histories', 'totalIncome', 'total_orders_completed', 'total_orders_cancelled', 'months', 'totals'));
}


    public function getChartData(Request $request) {
        // fungsi chart
         // Mengambil data total orders per bulan
        $year = $request->input('year', date('Y')); // Ambil tahun dari request, default tahun sekarang

        $history = History::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', $year) // Filter berdasarkan tahun
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = $history->pluck('month')->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $totals = $history->pluck('total');

        // Ambil daftar tahun dari database
        return response()->json([
            'months' => $months,
            'totals' => $totals,
        ]);
    }
}
