<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makanan = Category::where('nama_kategori', 'Makanan')->first();
        $minuman = Category::where('nama_kategori', 'Minuman')->first();

        if ($makanan) {
            Option::create(['category_id' => $makanan->id, 'nama_option' => 'Saus Barbaque']);
            Option::create(['category_id' => $makanan->id, 'nama_option' => 'Saus Mushroom']);
            Option::create(['category_id' => $makanan->id, 'nama_option' => 'Saus Blackpaper']);
        }

        if ($minuman) {
            Option::create(['category_id' => $minuman->id, 'nama_option' => 'Hot', 'tidak_berlaku_pada' => 'Air Mineral']);
            Option::create(['category_id' => $minuman->id, 'nama_option' => 'Ice', 'tidak_berlaku_pada' => 'Air Mineral']);
        }
    }
}
