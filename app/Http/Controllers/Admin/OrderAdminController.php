<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        $statusOptions = ['Pending', 'Processed', 'Cancelled', 'Completed'];
        return view('admin.orders.index', compact('orders', 'statusOptions'));
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
    public function show(Order $order)
    {
        $order->load('products');
        return view('admin.orders.show', compact('order'));
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
   public function updateStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Validasi status yang dipilih
        $validStatuses = ['Status', 'Processed', 'Completed', 'Cancelled'];
        if (!in_array($request->status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        // Update status pesanan
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
