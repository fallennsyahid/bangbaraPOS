<?php

namespace App\Http\Controllers\Staff;

use App\Exports\HistoryTodayExport;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StaffHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = History::with('product')->whereDate('created_at', Carbon::today())->get();
        return view('staff.staffHistories.index', compact('histories'));
    }

    public function exportToday() {
        return Excel::download(new HistoryTodayExport, 'histories-today.xlsx');
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
    public function show($id)
    {
        $history = History::findOrFail($id);
        $products = $products = json_decode($history->products, true);

        if (is_string($products)) {
            $products = json_decode($products, true);
        }
        return view('staff.staffHistories.show', compact('history', 'products'));
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
    public function destroy(string $id)
    {
        //
    }
}
