<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessionId = Session::getId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();
        $imagePayment = Image::first();

        return view('cart', compact('cartItems', 'imagePayment'));
    }

    // Tambah produk ke keranjang
   public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'sauce' => 'nullable|string|in:barbaque,mushroom,blackpepper',
        'hot_ice' => 'nullable|string|in:hot,ice,biasa',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);


    $sessionId = Session::getId();
    $product_id = $request->product_id;
    $quantity = $request->quantity;
    $sauce = $request->sauce;
    $hot_ice = $request->hot_ice;

    $cartItem = Cart::where('session_id', $sessionId)
        ->where('product_id', $product_id)
        ->where('sauce', $sauce)
        ->where('hot_ice', $hot_ice)
        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity', $quantity);
    } else {
        Cart::create([
            'session_id' => $sessionId,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'sauce' => $sauce,
            'hot_ice' => $hot_ice,
        ]);
    }

    return redirect()->route('index#menu')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}

/**
 * Hitung jarak antara 2 titik koordinat (haversine formula)
 */
// private function calculateDistance($lat1, $lng1, $lat2, $lng2)
// {
//     $earthRadius = 6371; // radius bumi dalam kilometer

//     $dLat = deg2rad($lat2 - $lat1);
//     $dLng = deg2rad($lng2 - $lng1);

//     $a = sin($dLat/2) * sin($dLat/2) +
//          cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
//          sin($dLng/2) * sin($dLng/2);

//     $c = 2 * atan2(sqrt($a), sqrt(1-$a));

//     return $earthRadius * $c;
// }

    // Hapus produk dari keranjang
    public function removeFromCart($id)
    {
        // Cart::destroy($id);

        $sessionId = Session::getId();
        $cartItem = Cart::where('session_id', $sessionId)->where('id', $id)->first();

        if (!$cartItem) {
            return redirect()->route('cart')->with('error', 'Produk tidak ditemukan di keranjang');
        }

        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang');
    }

    // Update quantity produk di keranjang
    public function updateQuantity(Request $request, $id)
    {
        $sessionId  = Session::getId();
        $item = Cart::where('session_id', $sessionId)->where('id', $id)->first();

        if (!$item) {
            return response()->json(['message' => 'Item tidak ditemukan'], 404);
        }

        $newQuantity = $request->input('quantity');

        if ($newQuantity <= 0) {
            $item->delete();  // Hapus item jika quantity 0
        } else {
            $item->update(['quantity' => $newQuantity]);
        }

        // Hitung ulang total items & total harga tanpa join
        $totalItems = Cart::where('session_id', $sessionId)->sum('quantity');
        $totalPrice = Cart::where('session_id', $sessionId)
            ->with('product')
            ->get()
            ->sum(function ($cart) {
                return $cart->quantity * $cart->product->harga_menu;
            });
        // $totalItems = Cart::sum('quantity');
        // $totalPrice = Cart::all()->sum(fn($cart) => $cart->quantity * $cart->product->harga_menu);

        return response()->json([
            'quantity' => $newQuantity > 0 ? $item->quantity : 0,
            'total' => $newQuantity > 0 ? $item->quantity * $item->product->harga_menu : 0,
            'remove' => $newQuantity <= 0,
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice
        ]);
    }

    public function getCartQuantity()
    {
        $sessionId = Session::getId();
        // Menghitung jumlah produk yang berbeda di keranjang berdasarkan product_id
        $uniqueProductsCount = Cart::where('session_id', $sessionId)->distinct('product_id')->count('product_id');

        return response()->json(['quantity' => $uniqueProductsCount]);
    }

    public function getCartQuantityDesktop()
    {
        $sessionId = Session::getId();
        // Menghitung jumlah produk yang berbeda di keranjang berdasarkan product_id
        $uniqueProductsCount = Cart::where('session_id', $sessionId)->distinct('product_id')->count('product_id');

        return response()->json(['quantity' => $uniqueProductsCount]);
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
