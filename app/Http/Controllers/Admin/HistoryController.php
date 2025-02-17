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


        $histories = $query->get(); // Ambil data hasil filter

        return view('admin.histories.index', compact('histories')); // Pastikan `history.index` adalah view yang benar
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
        $history->load('product');
        return view('admin.histories.show', compact('history'));
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
