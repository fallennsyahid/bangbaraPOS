<?php

namespace App\Http\Controllers;

// use Log as LOGS;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notification;

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
            'customer_phone' => 'nullable',
            'request' => 'nullable',
            'serve_option' => 'required|in:take-away,dine-in',
            'payment_method' => 'required|in:Tunai,nonTunai,Debit',
            'sauce' => 'nullable|string',
            'hot_ice' => 'nullable|string',
        ], [
            'customer_phone.required' => 'Mohon isi terlebih dahulu nomor telepon kamu!',
        ]);

        $phone = $request->customer_phone;
        if (preg_match('/^08/', $phone)) {
            $phone = preg_replace('/^0/', '+62', $phone);
        }

        // Veriphone API
        $response = Http::get('https://api.veriphone.io/v2/verify', [
            'phone' => $phone,
            'key' => env('VERIPHONE_API_KEY'),
        ]);

        // dd($response->json());

        $data = $response->json();

        // Cek jika response tidak ok atau nomor telepon tidak valid
        if (!$response->ok() || !$data['phone_valid']) {
            return back()->withErrors([
                'customer_phone' => 'Nomor telepon tidak valid atau tidak aktif.',
            ])->withInput();
        }

        $sessionId = Session::getId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong!');
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->quantity * $item->product->harga_menu);

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

        // Konfigurasi Midtrans
        // Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Develop midtrans mode
        \Midtrans\Config::$isProduction = false;
        // Sanitized type mode
        \Midtrans\Config::$isSanitized = true;
        // is3ds type mode
        \Midtrans\Config::$is3ds = true;

        // Params for midtrans item
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . time() . '-' . rand(), // unik, tidak pakai ID dari DB
                'gross_amount' => $totalPrice,
            ],

            'item_details' => $cartItems->map(fn($item) => [
                'id' => $item->product_id,
                'price' => $item->product->harga_menu,
                'quantity' => $item->quantity,
                'name' => $item->product->nama_menu,
            ])->toArray(),

            'customer_details' => [
                'first_name' => $request->customer_name,
            ],

            'custom_fields' => [
                'session_id' => $sessionId,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'request' => $request->input('request'),
                'products' => json_encode($products),
                'serve_option' => $request->serve_option,
                'payment_method' => $request->payment_method,
                'sauce' => $request->sauce,
                'hot_ice' => $request->hot_ice,
            ]
        ];

        // Get snap token when order is created
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Create order
        Order::create([
            'order_id' => $params['transaction_details']['order_id'],
            'session_id' => $sessionId,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'request' => $request->input('request'),
            'products' => json_encode($products),
            'total_price' => $totalPrice,
            'serve_option' => $request->serve_option,
            'payment_method' => $request->payment_method,
            'status' => 'Pending',
        ]);

        if ($request->payment_method === 'nonTunai') {
            Session::put('pending_cart_session_id', $sessionId);
            Session::put('pending_cart_order_id', $params['transaction_details']['order_id']);

            return view('nontunaiPayment', [
                'snap_token' => $snapToken,
                'products' => $products,
            ]);
        } else {
            Cart::where('session_id', $sessionId)->delete();

            return redirect()->route('index')->with('success', 'Silahkan pergi ke kasir untuk konfirmasi pembayaran!');
        }


        return redirect()->route('index')->with('success', 'Silahkan pergi ke kasir untuk konfirmasi pembayaran!');
    }

    public function callback(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $orderId = $notif->order_id;
        $transactionStatus = strtolower($notif->transaction_status); // langsung lowercase
        $paymentType = $notif->payment_type;

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            $order->status = 'Processed';
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $order->status = 'Cancelled'; // perbaiki typo (Canceled vs Cancelled, samakan di DB kamu)
        } elseif ($transactionStatus == 'pending') {
            $order->status = 'Pending';
        }

        $order->save(); // cukup save sekali di akhir

        return response()->json(['message' => 'Notification processed successfully']);
    }

    public function paymentSuccess()
    {
        $sessionId = Session::get('pending_cart_session_id');

        if ($sessionId) {
            Cart::where('session_id', $sessionId)->delete();
            Session::forget('pending_cart_session_id');
            Session::forget('pending_cart_order_id');
        }

        return redirect()->route('index')->with('success', 'Pembayaran berhasil!');
    }

    // public function midtransCallback(Request $request)
    // {
    //     Log::info('Callback masuk:', $request->all());
    //     $serverKey = config('midtrans.serverKey');
    //     $hashed = hash(
    //         "sha512",
    //         $request->order_id .
    //             $request->status_code .
    //             $request->gross_amount .
    //             $serverKey
    //     );

    //     if ($hashed !== $request->signature_key) {
    //         return response()->json(['message' => 'Invalid signature'], 403);
    //     }

    //     if (in_array($request->transaction_status, ['capture', 'settlement'])) {
    //         $tempOrder = Order::where('order_id', $request->order_id)->first();

    //         if (!$tempOrder) {
    //             return response()->json(['message' => 'Order tidak ditemukan'], 404);
    //         }

    //         Order::create([
    //             'customer_name' => $tempOrder->customer_name,
    //             'customer_phone' => $tempOrder->customer_phone,
    //             'request' => $tempOrder->request,
    //             'products' => $tempOrder->products,
    //             'total_price' => $tempOrder->total_price,
    //             'status' => 'Processed',
    //             'serve_option' => $tempOrder->serve_option,
    //             'payment_method' => $tempOrder->payment_method,
    //             'session_id' => $tempOrder->session_id,
    //             'snap_token' => $request->input('token'),
    //         ]);

    //         Cart::where('session_id', $tempOrder->session_id)->delete();
    //         $tempOrder->delete(); // opsional: bersihkan temp order
    //     }

    //     return response()->json(['message' => 'Callback received'], 200);
    // }

    // public function hapusKeranjangSetelahPembayaran(Request $request)
    // {
    //     Cart::where('session_id', $request->session_id)->delete();
    //     return response()->json(['message' => 'Keranjang berhasil dihapus']);
    // }

    // public function indexPayment()
    // {
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
