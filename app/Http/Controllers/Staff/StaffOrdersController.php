<?php

namespace App\Http\Controllers\Staff;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class StaffOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('product')->whereDate('created_at', Carbon::today())->get();
        $statusOptions = ['Pending', 'Processed', 'Cancelled', 'Completed'];
        return view('staff.staffOrders.index', compact('orders', 'statusOptions'));    }

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
        $order = Order::findOrFail($id);

        return view('staff.staffOrders.show', compact('order'));
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
