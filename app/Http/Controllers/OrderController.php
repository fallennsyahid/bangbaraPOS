<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'request' => 'nullable',
            'serve_option' => 'required|in:take-away,dine-in',
            'payment_method' => 'required|in:Tunai,nonTunai,Debit',
            // 'payment_photo' => $request->payment_method ===  'nonTunai' ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable',
            'sauce' => 'nullable|string',
            'hot_ice' => 'nullable|string',
        ]);

        $sessionId = Session::getId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong!');
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu);

        $paymentPhotoPath = 'default.png';

        if ($request->hasFile('payment_photo')) {
            $paymentPhotoPath = $request->file('payment_photo')->store('payment_photos', 'public');
        }

        if ($request->payment_method !== 'Tunai' && !$request->hasFile('payment_photo')) {
            $paymentPhotoPath = null;
        }

        $products = $cartItems->map(fn($item) => [
            'product_id' => $item->product_id,
            'nama_menu' => $item->product->nama_menu,
            'gambar_menu' => $item->product->gambar_menu,
            'quantity' => $item->quantity,
            'price' => $item->product->harga_menu,
            'sauce' => $item->sauce,
            'hot_ice' => $item->hot_ice,
            'category' => $item->product->category->nama_kategori,
        ])->toArray();

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'request' => $request->input('request'),
            'products' => json_encode($products),
            'total_price' => $totalPrice,
            'status' => 'Pending',
            'serve_option' => $request->serve_option,
            'payment_method' => $request->payment_method,
            'payment_photo' => $paymentPhotoPath,
            'sauce' => $request->sauce,
            'hot_ice' => $request->hot_ice,
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

       $params = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . $order->id, // <- ini yang dikirim ke Midtrans
            'gross_amount' => $totalPrice,
        ],
        'item_details' => $cartItems->map(function($item) {
            return [
            'id' => $item->product_id,
            'price' => $item->product->harga_menu,
            'quantity' => $item->quantity,
            'name' => $item->product->nama_menu,
            ];
        })->toArray(),
        'customer_details' => [
            'first_name' => $request->customer_name,
        ]
    ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->snap_token = $snapToken;
        $order->save();

        // Hapus keranjang hanya milik session ini
        Cart::where('session_id', $sessionId)->delete();

        // return redirect()->route('index')->with('checkout_success', $request->payment_method === 'Tunai' ? 'tunai' : 'nonTunai');
        if ($request->payment_method === 'nonTunai') {
            return view('nontunaiPayment', [
                'order' => $order,
                'snap_token' => $snapToken,
                'products' => $products,
            ]);
        }

        return redirect()->route('index')->with('checkout_success', 'tunai');
    }

    // public function nonTunaiTransacion() {
    //     return view('nontunaiPayment');
    // }

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
