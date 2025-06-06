<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Product;
use App\Models\Order;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    //  public function checkAutoUpdateStatus() {
    //     $store = Store::first();
    //     $currentHour = Carbon::now()->format('H'); // jam format 24 jam

    //    if ($currentHour >= 10 && $currentHour < 21 && $store->status != 1) {
    //         $store->status = 1; // buka
    //         $store->save();
    //     } elseif (($currentHour >= 21 || $currentHour < 10) && $store->status != 0) {
    //         $store->status = 0; // tutup
    //         $store->save();
    //     }

    // }
    

    // Controller (AdminController.php)
    public function dashboard(Request $request)
    {
        // Untuk check update status toko
        // $this->checkAutoUpdateStatus();

        $products = Product::count();
        $total_orders_completed = History::where('status', 'Completed')->count();
        $total_orders_cancelled = History::where('status', 'Cancelled')->count();
        $total_orders = Order::count();
        $histories = History::count();
        $totalIncome = DB::table('histories')->sum('total_price');
        $store = Store::first();

        $year = $request->input('year', date('Y')); // Default tahun sekarang
        $years = History::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');

        // Ambil data awal untuk chart income
        $history = History::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Siapkan array 12 bulan default
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        $totals = array_fill(0, 12, 0); // isi 0 default
        foreach ($history as $item) {
            $totals[$item->month - 1] = $item->total;
        }

        $months = array_values($monthNames); // label bulan full Januari–Desember

        // Data untuk metode pembayaran Tunai
        $tunai = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('payment_method', 'Tunai')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Data untuk metode pembayaran nonTunai
        $nonTunai = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('payment_method', 'nonTunai')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Siapkan array 12 bulan default untuk masing-masing metode
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

        return view('admin.dashboard', compact(
            'products',
            'total_orders',
            'year',
            'years',
            'histories',
            'totalIncome',
            'total_orders_completed',
            'total_orders_cancelled',
            'months',
            'totals',
            'tunaiData',
            'nonTunaiData',
            'store'
        ));
    }

    public function getChartData(Request $request)
    {
        // fungsi chart
        // Mengambil data total orders per bulan
        $year = $request->input('year', date('Y')); // Ambil tahun dari request, default tahun sekarang

        // Untuk array total untuk 12 bulan dengan nilai 0
        $totals = array_fill(0, 12, 0);


        $history = History::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', $year) // Filter berdasarkan tahun
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // $months = $history->pluck('month')->map(function ($month) {
        //     return Carbon::create()->month($month)->format('F');
        // });

        foreach ($history as $item) {
            $totals[$item->month - 1] = $item->total;
        }

        // $totals = $history->pluck('total');

        // Ambil daftar tahun dari database
        return response()->json([
            // 'months' => $months,
            'totals' => $totals,
        ]);
    }

    public function getBestSellerChartData()
    {
        // Ambil data orders
        $history = History::where('status', 'Completed')->get();

        $productTotals = [];

        foreach ($history as $history) {
            // Mengubah data json
            $products = json_decode(json_decode($history->products, true));

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

    public function getOrderStats(Request $request)
    {
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

        // Ambil data history untuk metode pembayaran Debit
        $debit = History::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('payment_method', 'Debit')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // inisialisasi
        $tunaiData = array_fill(0, 12, 0);
        $nonTunaiData = array_fill(0, 12, 0);
        $debitData = array_fill(0, 12, 0);

        // isi data berdasarkan bulan (index 0 untuk januari, dst.)
        foreach ($tunai as $item) {
            $index = $item->month - 1;
            $tunaiData[$index] = (int)$item->total;
        }

        foreach ($nonTunai as $item) {
            $index = $item->month - 1;
            $nonTunaiData[$index] = (int)$item->total;
        }

        foreach ($debit as $item) {
            $index = $item->month - 1;
            $debitData[$index] = (int)$item->total;
        }

        // Kirim data ke dashboard
        return response()->json([
            'Tunai'     => $tunaiData,
            'nonTunai' => $nonTunaiData,
            'Debit' => $debit,
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

        // Query untuk metode Debit (misalnya selain Tunai)
        $debit = History::selectRaw('HOUR(created_at) as hour, COUNT(*) as total')
            ->whereDate('created_at', $date)
            ->where('payment_method', '<>', 'nonTunai')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        // Inisialisasi array untuk 24 jam (0-23) dengan default 0
        $tunaiData = array_fill(0, 24, 0);
        $nonTunaiData = array_fill(0, 24, 0);
        $debitData = array_fill(0, 24, 0);

        foreach ($tunai as $item) {
            $index = (int)$item->hour;
            $tunaiData[$index] = (int)$item->total;
        }

        foreach ($nonTunai as $item) {
            $index = (int)$item->hour;
            $nonTunaiData[$index] = (int)$item->total;
        }
        
        foreach ($debit as $item) {
            $index = (int)$item->hour;
            $debitData[$index] = (int)$item->total;
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
            'debit' => $debitData,
        ]);
    }

    public function getBestSellerChartDataFilter(Request $request)
    {
        // Tangkap parameter tanggal (bisa pakai 'start_date' dan 'end_date' dari request)
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query dasar
        $query = History::where('status', 'Completed');

        // Jika ada parameter tanggal, terapkan filter
        if ($startDate && $endDate) {
            // Pastikan format tanggal valid sesuai kolom di database
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Eksekusi query
        $histories = $query->get();

        $productTotals = [];

        foreach ($histories as $history) {
            // Mengubah data JSON menjadi array
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
