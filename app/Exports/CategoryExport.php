<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithHeadings
{
    /**
     * Mendapatkan data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil semua produk dari database
        // return Category::all(['id', 'nama_kategori', 'created_at']);
        return Category::withCount('products')
        ->get(['id', 'nama_kategori', 'products_count', 'created_at']);
    }

    /**
     * Menentukan judul kolom di Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        // Headings saat di excel nya
        return ['ID', 'Category', 'Created At', 'Total Products'];
    }
}
