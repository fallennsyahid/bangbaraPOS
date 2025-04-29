<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
public function model(array $row)
{
    $gambarMenuPath = 'default.png';

    // Cek apakah gambar_menu memiliki URL untuk gambar
    if (!empty($row['gambar_menu'])) {
        try {
            // Mengunduh gambar dari URL (jika gambar berupa URL)
            $imageUrl = $row['gambar_menu'];
            $imageContents = @file_get_contents($imageUrl);

            if ($imageContents === false) {
                throw new \Exception("Gambar tidak dapat diunduh dari URL: $imageUrl");
            }

            // Membuat nama file unik untuk gambar
            $imageName = time() . '_' . basename($imageUrl);

            // Menyimpan gambar ke dalam folder public/products
            Storage::disk('public')->put('products/' . $imageName, $imageContents);

            // Menyimpan path gambar relatif di database
            $gambarMenuPath = 'products/' . $imageName;
        } catch (\Exception $e) {
            // Log error jika terjadi masalah saat mengunduh atau menyimpan gambar
            Log::error('Error saat memproses gambar: ' . $e->getMessage());
        }
    }

    // Cari kategori berdasarkan nama kategori
    $category = Category::firstOrCreate(
        ['nama_kategori' => $row['category_id']]
    );

    // Mengembalikan data Product
    return new Product([
        'category_id' => $category ? $category->id : null,
        'nama_menu' => $row['nama_menu'] ?? null,
        'harga_menu' => $row['harga_menu'] ?? null,
        'deskripsi_menu' => $row['deskripsi_menu'] ?? null,
        'gambar_menu' => $gambarMenuPath, // Menyimpan path gambar
        'status_produk' => $row['status_produk'] ?? null,
    ]);
}

}
