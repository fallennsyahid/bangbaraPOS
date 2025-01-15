<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoryExport;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function export() {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        Category::create([
            'nama_kategori' => $request->input('nama_kategori')
        ]);

        return redirect()->route('categories.index')->with('success' , 'Berhasil Menambahkan Kategori');
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_kategori' => 'string',
        ]);

        $data = ([
            'nama_kategori' => $request->input('nama_kategori'),
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Berhasil Update Kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Berhasil Menghapus Kategori');
    }
}
