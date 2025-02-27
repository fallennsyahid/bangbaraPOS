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

        // Ambil data chart awal (orders stats) untuk tahun yang dipilih
        // Data untuk metode pembayaran Tunai
        $tunai = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('payment_method', 'Tunai')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Data untuk nonTunai
        $nonTunai = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('payment_method', 'nonTunai')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Inisialisasi array untuk 12 bulan (default 0)
        $tunaiData = array_fill(0, 12, 0);
        $nonTunaiData = array_fill(0, 12, 0);

        foreach ($tunai as $item) {
            $index = $item->month - 1;
            $tunaiData[$index] = (int) $item->total;
        }

        foreach ($nonTunai as $item) {
            $index = $item->month - 1;
            $nonTunaiData[$index] = (int) $item->total;
        }

        return view('admin.dashboard', compact('products', 'total_orders', 'year', 'years', 'histories', 'totalIncome', 'total_orders_completed', 'total_orders_cancelled', 'months', 'totals', 'tunaiData', 'nonTunaiData'));
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

    public function getBestSellerChartData(){
        // Ambil data orders
        $orders = Order::where('status', 'Completed')->get();

        $productTotals = [];

        foreach ($orders as $order) {
            // Mengubah data json
            $products = json_decode($order->products, true);

            if (is_array($products)) {
                foreach ($products as $product) {
                    // Gunakan nama produk
                    $key = $product['nama_menu'];
                    // Tambahkan quantity produk
                    $productTotals[$key] = isset($productTotals[$key])
                    ? $productTotals[$key] + (int)$product['quantity']
                    : (int)$product['quantity'];
                }
            }
        }

        // urutkan berdasarkan total sold
        arsort($productTotals);

        // ambil 5 produk teratas
        $bestSellers = array_slice($productTotals, 0, 5, true);

        // data untuk chart.js
        $products = array_keys($bestSellers);
        $totals = array_values($bestSellers);

        return response()->json([
            'products' => $products,
            'totals' => $totals,
        ]);
    }

    public function getOrderStats(Request $request) {
        $year = $request->input('year', date('Y'));

        // Ambil data history untuk metode pembayaran Tunai
        $tunai = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->where('payment_method', 'Tunai')
         ->whereYear('created_at', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Ambil data history untuk metode pembayaran nonTunai
         $nonTunai = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->where('payment_method', 'nonTunai')
        ->whereYear('created_at', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // inisialisasi
        $tunaiData = array_fill(0, 12, 0);
        $nonTunaiData = array_fill(0, 12, 0);

        // isi data berdasarkan bulan (index 0 untuk januari, dst.)
        foreach ($tunai as $item) {
            $index = $item->month - 1 ;
            $tunaiData[$index] = (int)$item->total;

        }

        foreach ($nonTunai as $item) {
            $index = $item->month - 1 ;
            $nonTunaiData[$index] = (int)$item->total;

        }

        // Kirim data ke dashboard
        return response()->json([
        'Tunai'     => $tunaiData,
        'nonTunai' => $nonTunaiData,
    ]);


    }

    public function getHourlyPaymentStats(Request $request)
{
    // Ambil input tanggal, default ke hari ini jika tidak ada input
    $date = $request->input('date', date('Y-m-d'));

    // Query untuk metode Tunai
    $tunai = History::selectRaw('HOUR(created_at) as hour, COUNT(*) as total')
        ->whereDate('created_at', $date)
        ->where('payment_method', 'Tunai')
        ->groupBy('hour')
        ->orderBy('hour')
        ->get();

    // Query untuk metode nonTunai (misalnya selain Tunai)
    $nonTunai = History::selectRaw('HOUR(created_at) as hour, COUNT(*) as total')
        ->whereDate('created_at', $date)
        ->where('payment_method', '<>', 'Tunai')
        ->groupBy('hour')
        ->orderBy('hour')
        ->get();

    // Inisialisasi array untuk 24 jam (0-23) dengan default 0
    $tunaiData = array_fill(0, 24, 0);
    $nonTunaiData = array_fill(0, 24, 0);

    foreach ($tunai as $item) {
        $index = (int)$item->hour;
        $tunaiData[$index] = (int)$item->total;
    }

    foreach ($nonTunai as $item) {
        $index = (int)$item->hour;
        $nonTunaiData[$index] = (int)$item->total;
    }

    // Buat label untuk 24 jam (00:00, 01:00, dst.)
    $labels = [];
    for ($i = 0; $i < 24; $i++) {
        $labels[] = sprintf("%02d:00", $i);
    }

    return response()->json([
        'labels' => $labels,
        'tunai' => $tunaiData,
        'non_tunai' => $nonTunaiData,
    ]);
}

public function getBestSellerChartDataFilter(Request $request)
{
    // Tangkap parameter tanggal (bisa pakai 'start_date' dan 'end_date' dari request)
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Query dasar
    $query = Order::where('status', 'Completed');

    // Jika ada parameter tanggal, terapkan filter
    if ($startDate && $endDate) {
        // Pastikan format tanggal valid sesuai kolom di database
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Eksekusi query
    $orders = $query->get();

    $productTotals = [];

    foreach ($orders as $order) {
        // Mengubah data JSON menjadi array
        $products = json_decode($order->products, true);

        if (is_array($products)) {
            foreach ($products as $product) {
                // Gunakan nama produk
                $key = $product['nama_menu'];
                // Tambahkan quantity produk
                $productTotals[$key] = isset($productTotals[$key])
                    ? $productTotals[$key] + (int)$product['quantity']
                    : (int)$product['quantity'];
            }
        }
    }

    // Urutkan berdasarkan total sold (descending)
    arsort($productTotals);

    // Ambil 5 produk teratas (jika ingin lebih, silakan ubah angka 5)
    $bestSellers = array_slice($productTotals, 0, 5, true);

    // Siapkan data untuk Chart.js
    $products = array_keys($bestSellers);
    $totals = array_values($bestSellers);

    return response()->json([
        'products' => $products,
        'totals' => $totals,
    ]);
}


}
