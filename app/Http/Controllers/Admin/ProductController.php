<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        $allIds = Product::pluck('id')->toArray(); // Ambil semua ID

        return view('admin.products.index', compact('products', 'categories', 'allIds'));
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

  public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);

    // Simpan file ke storage/app/public/imports/
    $path = $request->file('file')->store('imports', 'public');


    // Gunakan storage_path untuk mengambil file yang benar
    Excel::import(new ProductsImport, storage_path("app/public/" . $path));

    return back()->with('success', 'Produk berhasil diimport!');
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
            'status_produk' => 'required|in:Active,Non-active',
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
            'status_produk' => 'in:Active,Non-active',
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
            if ($product->gambar_menu) {
                Storage::delete($product->gambar_menu);
            }
            $data['gambar_menu'] = $request->file('gambar_menu')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Berhasil Mengubah Produk');
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
    $deleted = Product::whereIn('id', $ids)->delete();

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
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Sucsessfully Deleted');
    }
}
