<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function model(array $row)
{
    // dd($row); // Debugging: pastikan ini muncul!

    $category = Category::where('nama_kategori', $row['category_id'])->first();

    return new Product([
        'category_id' => $category ? $category->id : null,
        'nama_menu' => $row['nama_menu'] ?? null,
        'harga_menu' => $row['harga_menu'] ?? null,
        'deskripsi_menu' => $row['deskripsi_menu'] ?? null,
        'gambar_menu' => $row['gambar_menu'] ?? null,
        'status_produk' => $row['status_produk'] ?? null,
    ]);
}

}
