<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::with('product')->get();
        return view('cart', compact('cartItems'));
    }

    // Tambah produk ke keranjang
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = Cart::where('product_id', $product->id)->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    // Hapus produk dari keranjang
    public function removeFromCart($id)
    {
        Cart::destroy($id);
        return redirect()->route('cart')->with('success', 'Produk dihapus dari keranjang');
    }

    public function updateQuantity(Request $request, $id)
    {
        $item = Cart::find($id);

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
        $totalItems = Cart::sum('quantity');
        $totalPrice = Cart::all()->sum(fn($cart) => $cart->quantity * $cart->product->harga_menu);

        return response()->json([
            'quantity' => $newQuantity > 0 ? $item->quantity : 0,
            'total' => $newQuantity > 0 ? $item->quantity * $item->product->harga_menu : 0,
            'remove' => $newQuantity <= 0,
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice
        ]);
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
