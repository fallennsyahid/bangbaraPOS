<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FilteredHistoriesExport;
use App\Exports\HistoriesExport;
use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
      $query = History::query(); // Pastikan pakai query builder dari Eloquent

        if ($request->filled('periode_awal') && $request->filled('periode_akhir')) {
        $start = $request->periode_awal . " 00:00:00";
        $end = $request->periode_akhir . " 23:59:59";
        $query->whereBetween('created_at', [$start, $end]);
        
    }


        $histories = $query->orderBy('created_at', 'desc')->get(); // Ambil data hasil filter
        $allIds = History::pluck('id')->toArray(); // Ambil semua ID
        return view('admin.histories.index', compact('histories', 'allIds')); // Pastikan `history.index` adalah view yang benar
    
    }

     public function getHistories(Request $request)
{
    $query = History::query();

    if ($request->filled('periode_awal') && $request->filled('periode_akhir')) {
        $query->whereBetween('created_at', [$request->periode_awal, $request->periode_akhir]);
    }

    return response()->json($query->get());
}


    public function export(Request $request)
{
    $periode_awal = $request->query('periode_awal');
    $periode_akhir = $request->query('periode_akhir');

       // Validasi apakah kedua tanggal diisi
    if (!$periode_awal || !$periode_akhir) {
        return redirect()->back()->with('error', 'Pilih rentang tanggal terlebih dahulu.');
    }

    // Konversi ke format Y-m-d agar sesuai dengan created_at di database
    try {
        $periode_awal = Carbon::parse($periode_awal)->startOfDay(); 
        $periode_akhir = Carbon::parse($periode_akhir)->endOfDay();
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Format tanggal tidak valid.');
    }

    // Ambil data berdasarkan rentang tanggal
    $histories = History::whereBetween('created_at', [$periode_awal, $periode_akhir])->get();

    if ($histories->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada data dalam rentang tanggal yang dipilih.');
    }

    return Excel::download(new HistoriesExport($histories), 'histories.xlsx');
}

    public function bulkDelete(Request $request)
{
    // Ambil array ID dari request
    $ids = $request->input('ids');

    // Validasi jika tidak ada ID yang dikirim
    if (!$ids || count($ids) === 0) {
        return response()->json(['success' => false, 'message' => 'No items selected.']);
    }

    // Hapus data berdasarkan ID
    $deleted = History::whereIn('id', $ids)->delete();

    // Periksa apakah data berhasil dihapus
    if ($deleted) {
        return response()->json(['success' => true, 'message' => 'Selected items deleted successfully.']);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to delete selected items.']);
    }
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
{
    $products = json_decode($history->products, true); // Decode pertama: hasilnya masih string

    if (is_string($products)) {
        $products = json_decode($products, true); // Decode kedua: hasilnya array as expected
    }

    if (!is_array($products)) {
        $products = []; // Jaga-jaga kalau masih gagal decode
    }

    return view('admin.histories.show', compact('history', 'products'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        $history->delete();

        return redirect()->route('histories.index')->with('success', 'History Successfully Deleted');
    }
}
