<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function export() {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:225',
            'harga_menu' => 'required|numeric|min:0',
            'deskripsi_menu' => 'required',
            'gambar_menu' => 'image|required|mimes:jpg,jpeg,png,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status_produk' => 'required|in:active,unactive',
        ]);

        $path = $request->file('gambar_menu')->store('products', 'public');

        Product::create([
            'gambar_menu' => $path,
            'nama_menu' => $request->input('nama_menu'),
            'harga_menu' => $request->input('harga_menu'),
            'deskripsi_menu' => $request->input('deskripsi_menu'),
            'category_id' => $request->input('category_id'),
            'status_produk' => $request->input('status_produk'),
        ]);

        return redirect()->route('products.index')->with('success', 'Berhasil Menambahkan Produk');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_menu' => 'string|max:225',
            'harga_menu' => 'numeric|min:0',
            'deskripsi_menu' => 'string',
            'gambar_menu' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
            'category_id' => 'exists:categories,id',
            'status_produk' => 'in:active,unactive',
        ]);

        $data = ([
            'nama_menu' => $request->input('nama_menu'),
            'harga_menu' => $request->input('harga_menu'),
            'deskripsi_menu' => $request->input('deskripsi_menu'),
            'category_id' => $request->input('category_id'),
            'status_produk' => $request->input('status_produk'),
        ]);

        // Update Gambar Jika Ada
        if ($request->hasFile('gambar_menu')) {
            // hapus gambar lama
            if($product->gambar_menu) {
                Storage::delete($product->gambar_menu);
            }
            $data['gambar_menu'] = $request->file('gambar_menu')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Berhasil Mengubah Produk');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Sucsessfully Deleted');
    }
}
