<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * Mendapatkan data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil semua produk dari database
        return Product::with('category:id,nama_kategori')
        ->get()
        ->map(function ($product) {
            return [
                $product->id,
                $product->nama_menu,
                $product->category->nama_kategori,
                $product->status_produk,
                $product->harga_menu,
                $product->created_at,
            ];
        })
        ;
    }

    /**
     * Menentukan judul kolom di Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        // Headings saat di excel nya
        return ['ID', 'Product Name', 'Category ID', 'Status', 'Price', 'Created At'];
    }
}
