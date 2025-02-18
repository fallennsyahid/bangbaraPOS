<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Log;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as Enter;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function checkout(Request $request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        $request->validate([
            'customer_name' => 'required|',
            'customer_phone' => 'required|',
            'request' => 'nullable',
            'payment_method' => 'required',
            'payment_photo' => 'nullable',
        ]);

        $cartItems = Cart::with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu);

        $paymentPhotoPath = null;
        if ($request->hasFile('payment_photo')) {
            $paymentPhotoPath = $request->file('payment_photo')->store('payment_receipts', 'public');
        }

        if ($request->payment_method === 'tunai') {
            $paymentPhotoPath = 'default.png'; // atau string lain yang tidak NULL
        }


        $products = $cartItems->map(fn($item) => [
            'product_id' => $item->product_id,
            'nama_menu' => $item->product->nama_menu,
            'gambar_menu' => $item->product->gambar_menu,
            'quantity' => $item->quantity,
            'price' => $item->product->harga_menu,
        ])->toArray();

        Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'request' => $request->input('request'),
            'products' => json_encode($products),
            'total_price' => $totalPrice,
            'status' => 'Pending',
            'payment_method' => $request->payment_method,
            'payment_photo' => $paymentPhotoPath,
        ]);

        Cart::truncate();

        return redirect()->route('index')->with('success', 'Pesanan Anda telah berhasil!');
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
    public function show(string $id)
    {
        //
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
