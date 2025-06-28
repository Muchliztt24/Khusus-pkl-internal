<?php

namespace Database\Seeders;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'nama' => 'Smartphone XYZ',
            'slug' => 'smartphone-xyz',
            'deskripsi' => 'Smartphone dengan spesifikasi tinggi dan kamera terbaik.',
            'harga' => 2999.99,
            'gambar' => 'smartphone_xyz.jpg',
            'stok' => 50,
            'categori_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'nama' => 'Kemeja Formal',
            'slug' => 'kemeja-formal',
            'deskripsi' => 'Kemeja formal untuk acara bisnis dan pertemuan.',
            'harga' => 499.99,
            'gambar' => 'kemeja_formal.jpg',
            'stok' => 100,
            'categori_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'nama' => 'Krim Wajah',
            'slug' => 'krim-wajah',
            'deskripsi' => 'Krim wajah dengan bahan alami untuk kulit sehat.',
            'harga' => 199.99,
            'gambar' => 'krim_wajah.jpg',
            'stok' => 200,
            'categori_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'nama' => 'Sepatu Olahraga',
            'slug' => 'sepatu-olahraga',
            'deskripsi' => 'Sepatu olahraga yang nyaman dan stylish.',
            'harga' => 899.99,
            'gambar' => 'sepatu_olahraga.jpg',
            'stok' => 75,
            'categori_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'nama' => 'Snack Sehat',
            'slug' => 'snack-sehat',
            'deskripsi' => 'Snack sehat dengan bahan organik dan tanpa pengawet.',
            'harga' => 49.99,
            'gambar' => 'snack_sehat.jpg',
            'stok' => 500,
            'categori_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
