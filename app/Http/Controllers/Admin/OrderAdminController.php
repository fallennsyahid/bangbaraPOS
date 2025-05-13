<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Events\StatusUpdated;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        $statusOptions = ['Pending', 'Processed', 'Cancelled', 'Completed'];
        return view('admin.orders.index', compact('orders', 'statusOptions'));
        return response()->json(["data" => $orders]);
    }



    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
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
        $products = json_decode($order->products, true);
        return view('admin.orders.show', compact('order', 'products'));
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

         // Jika status diubah menjadi "Processed", simpan nama kasir dari user yang sedang login
        if ($request->status === 'Processed' || $request->status === 'Completed' ||  $request->status === 'Cancelled') {
            $order->casier_name = Auth::user()->name; // ← ambil langsung dari Auth
        }
        // Simpan perubahan 
        $order->save();

        $statusCounts = [
            'pending' => Order::where('status', 'Pending')->count(),
            'processed' => Order::where('status', 'Processed')->count(),
            'completed' => Order::where('status', 'Completed')->count(),
            'canceled' => Order::where('status', 'Cancelled')->count(),
        ];

        broadcast(new StatusUpdated($statusCounts))->toOthers();


        return response()->json([
         'message' => 'Order status updated successfully',
         'statusCounts' => $statusCounts
        ]);
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
        $deleted = Order::whereIn('id', $ids)->delete();

        // Periksa apakah data berhasil dihapus
        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Selected items deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete selected items.']);
        }
    }
    




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order Successfully Deleted');
    }
}
