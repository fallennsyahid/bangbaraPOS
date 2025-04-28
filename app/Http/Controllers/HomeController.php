<?php

namespace App\Http\Controllers;

use App\Helpers\BadWordFilter;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Store;
use App\Models\Order;
use App\Models\RestaurantLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        $categories = Category::with(['products', 'options'])->get();
        $reviews = Review::orderBy('created_at', 'desc')->take(5)->get();
        $store = Store::first();
        $location = RestaurantLocation::first();

        return view('welcome', compact('categories', 'reviews', 'store', 'location'));
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
        $badWordsPath = public_path('json/badwords.json');

        // Daftar kata kasar yang perlu disensor
        $json = json_decode(file_get_contents($badWordsPath), true);
        $badWords = array_merge($json['indonesia'], $json['english']);

        // Menyaring pesan dari kata kasar
        $message = $request->message;
        foreach ($badWords as $word) {
            // $message = preg_replace('/\b' . preg_quote($word, '/') . '\b/i', '***', $message);
            $pattern = '/(?<!\w)' . preg_quote($word, '/') . '(?!\w)/i';
            $message = preg_replace($pattern, '***', $message);
        }

        // Validasi input
        $request->validate([
            'username' => 'required|string|max:225',
            'rating' => 'required|integer|between:1,5',
            'message' => 'required|string',
        ]);

        // Menyimpan ulasan dengan pesan yang sudah disensor
        Review::create([
            'username' => $request->username,
            'rating' => $request->rating,
            'message' => $message,
        ]);

        return redirect()->route('index')->with('success', 'Terimakasih atas masukan Anda😉');
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
