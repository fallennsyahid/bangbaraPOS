<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FilteredHistoriesExport;
use App\Exports\HistoriesExport;
use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $years = History::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year');
    $months = History::selectRaw('MONTH(created_at) as months')->distinct()->pluck('months');
    $days = History::selectRaw('DAY(created_at) as days')->distinct()->pluck('days');

    // Query dengan filter
    $query = History::query();

    if ($request->has('filter_year') && $request->filter_year) {
        $query->whereYear('created_at', $request->filter_year);
    }

    if ($request->has('filter_month') && $request->filter_month) {
        $query->whereMonth('created_at', $request->filter_month);
    }

    if ($request->has('filter_day') && $request->filter_day) {
        $query->whereDay('created_at', $request->filter_day);
    }

    // Ambil data histories
    $histories = $query->get();

    // Jika permintaan AJAX, kembalikan data dalam format JSON
    if ($request->ajax()) {
        return response()->json([
            'histories' => $histories,
        ]);
    }

    return view('admin.histories.index', compact('histories', 'years', 'months', 'days'));
}





    public function export(Request $request)
{
$filters = [
        'filter_year' => $request->input('filter_year'),
        'filter_month' => $request->input('filter_month'),
        'filter_day' => $request->input('filter_day'),
    ];
    // Debug log untuk memastikan filter diterapkan
    // \Log::info('Exporting histories', ['filters' => $request->all(), 'count' => $history->count()]);

    return Excel::download(new HistoriesExport($filters), 'histories.xlsx');
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
