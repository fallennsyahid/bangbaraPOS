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
    public function index()
    {
        return view('staff.dashboard');
    }

    public function dashboard(Request $request)
    {

        $products = Product::count();
        $total_orders_completed = History::where('status', 'Completed')->whereDate('created_at', Carbon::today())->count();
        $total_orders_cancelled = History::where('status', 'Cancelled')->whereDate('created_at', Carbon::today())->count();
        $total_orders = History::whereDate('created_at', Carbon::today())->count();
        $histories = History::whereDate('created_at', Carbon::today())->count();
        $totalIncome = DB::table('histories')->whereDate('created_at', Carbon::today())->sum('total_price');

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

        $debit = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('payment_method', 'Debit')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Inisialisasi array untuk 12 bulan (default 0)
        $tunaiData = array_fill(0, 12, 0);
        $nonTunaiData = array_fill(0, 12, 0);
        $debitData = array_fill(0, 12, 0);

        foreach ($tunai as $item) {
            $index = $item->month - 1;
            $tunaiData[$index] = (int) $item->total;
        }

        foreach ($nonTunai as $item) {
            $index = $item->month - 1;
            $nonTunaiData[$index] = (int) $item->total;
        }

        foreach ($debit as $item) {
            $index = $item->month - 1;
            $debitData[$index] = (int) $item->total;
        }

        return view('staff.dashboard', compact('products', 'total_orders', 'year', 'years', 'histories', 'totalIncome', 'total_orders_completed', 'total_orders_cancelled', 'months', 'totals',  'tunaiData', 'nonTunaiData', 'debitData'));
    }


    public function getChartData(Request $request)
    {
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

    public function getBestSellerChartData()
    {
        // Ambil data orders
        $histories = History::where('status', 'Completed')
            ->whereDate('created_at', Carbon::today()) // Ambil pesanan hanya dari hari ini
            ->orderBy('created_at', 'desc') // Urutkan dari terbaru
            ->get();

        $productTotals = [];

        foreach ($histories as $history) {
            // Mengubah data json
            $products = json_decode(json_decode($history->products, true), true);

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

    public function getOrderStats()
    {
        $today = Carbon::today()->toDateString(); // ambil tanggal hari ini

        $tunai = array_fill(0, 24, 0);
        $nonTunai = array_fill(0, 24, 0);
        $debit = array_fill(0, 24, 0);
    

        $orders = History::whereDate('created_at', $today)->get();

        foreach ($orders as $order) {
            $hour = (int)date('G', strtotime($order->created_at));
            $payment = strtolower($order->payment_method);

            if ($payment === 'tunai') {
                $tunai[$hour]++;
            } elseif ($payment === 'nontunai') {
                $nonTunai[$hour]++;
            }
        }

        return response()->json([
            'labels' => array_map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00', range(0, 23)),
            'tunai' => $tunai,
            'non_tunai' => $nonTunai,
            'debit' => $debit,
        ]);
    }
}
