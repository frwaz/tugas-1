<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Catatan: 'image' sengaja dibiarkan null karena belum ada file
        // gambar sungguhan di storage. Halaman produk sudah punya tampilan
        // fallback (ikon) untuk produk tanpa gambar.
        $products = [
            // Elektronik
            ['name' => 'Headphone Bluetooth X200', 'category' => 'Elektronik', 'price' => 350000, 'stock' => 25, 'description' => 'Headphone nirkabel dengan kualitas suara jernih dan baterai tahan lama.'],
            ['name' => 'Power Bank 20000mAh', 'category' => 'Elektronik', 'price' => 275000, 'stock' => 40, 'description' => 'Power bank kapasitas besar, cocok untuk perjalanan jauh.'],
            ['name' => 'Speaker Portable Mini', 'category' => 'Elektronik', 'price' => 189000, 'stock' => 15, 'description' => 'Speaker kecil dengan suara besar, tahan air.'],

            // Fashion
            ['name' => 'Kaos Polos Katun Premium', 'category' => 'Fashion', 'price' => 89000, 'stock' => 100, 'description' => 'Kaos berbahan katun combed 30s, nyaman dipakai sehari-hari.'],
            ['name' => 'Jaket Hoodie Unisex', 'category' => 'Fashion', 'price' => 215000, 'stock' => 30, 'description' => 'Hoodie tebal cocok untuk cuaca dingin, tersedia berbagai warna.'],
            ['name' => 'Tas Selempang Kanvas', 'category' => 'Fashion', 'price' => 125000, 'stock' => 20, 'description' => 'Tas kanvas serbaguna untuk kuliah maupun jalan-jalan.'],

            // Rumah Tangga
            ['name' => 'Rak Buku Minimalis 3 Susun', 'category' => 'Rumah Tangga', 'price' => 320000, 'stock' => 12, 'description' => 'Rak kayu minimalis, mudah dirakit, muat banyak buku.'],
            ['name' => 'Set Pisau Dapur Stainless', 'category' => 'Rumah Tangga', 'price' => 175000, 'stock' => 18, 'description' => 'Set 5 pisau dapur tajam dan tahan karat.'],
            ['name' => 'Lampu Meja LED Touch', 'category' => 'Rumah Tangga', 'price' => 95000, 'stock' => 35, 'description' => 'Lampu belajar dengan 3 tingkat kecerahan, hemat energi.'],

            // Olahraga
            ['name' => 'Matras Yoga Anti Slip', 'category' => 'Olahraga', 'price' => 145000, 'stock' => 22, 'description' => 'Matras tebal dan empuk, permukaan anti licin.'],
            ['name' => 'Botol Minum Olahraga 1L', 'category' => 'Olahraga', 'price' => 65000, 'stock' => 50, 'description' => 'Botol BPA-free dengan penanda takaran waktu minum.'],
            ['name' => 'Sepatu Lari Ringan', 'category' => 'Olahraga', 'price' => 450000, 'stock' => 10, 'description' => 'Sepatu lari dengan bantalan empuk dan sirkulasi udara baik.'],

            // Kecantikan
            ['name' => 'Serum Wajah Vitamin C', 'category' => 'Kecantikan', 'price' => 98000, 'stock' => 45, 'description' => 'Serum pencerah wajah dengan kandungan vitamin C 20%.'],
            ['name' => 'Sunscreen SPF 50 PA+++', 'category' => 'Kecantikan', 'price' => 79000, 'stock' => 60, 'description' => 'Tabir surya ringan, tidak lengket, cocok untuk kulit berminyak.'],

            // Makanan & Minuman
            ['name' => 'Kopi Robusta Bubuk 200g', 'category' => 'Makanan & Minuman', 'price' => 45000, 'stock' => 70, 'description' => 'Kopi lokal pilihan, digiling halus, aroma kuat.'],
            ['name' => 'Madu Hutan Asli 500ml', 'category' => 'Makanan & Minuman', 'price' => 120000, 'stock' => 28, 'description' => 'Madu murni tanpa campuran, langsung dari peternak lebah.'],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();

            Product::firstOrCreate(
                ['name' => $item['name']],
                [
                    'description'  => $item['description'],
                    'price'        => $item['price'],
                    'stock'        => $item['stock'],
                    'image'        => null,
                    'category_id'  => $category?->id,
                ]
            );
        }
    }
}
