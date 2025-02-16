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

    return Excel::download(new HistoriesExport($request), 'histories.xlsx');
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
        $history->load('products');
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
