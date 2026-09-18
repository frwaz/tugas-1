<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori sudah dibuat oleh CategorySeeder; ambil datanya di sini.
        $categoryModels = ProductCategory::all()->keyBy('name');

        $products = [
            ['name' => 'Smartphone X1', 'category' => 'Elektronik', 'price' => 2500000, 'stock' => 10, 'description' => 'Smartphone layar 6.5 inci, RAM 4GB.'],
            ['name' => 'Headphone Bluetooth', 'category' => 'Elektronik', 'price' => 350000, 'stock' => 25, 'description' => 'Headphone nirkabel dengan noise cancelling.'],
            ['name' => 'Kaos Polos Pria', 'category' => 'Fashion', 'price' => 75000, 'stock' => 50, 'description' => 'Kaos katun combed 30s, berbagai warna.'],
            ['name' => 'Sepatu Sneakers', 'category' => 'Fashion', 'price' => 320000, 'stock' => 15, 'description' => 'Sneakers unisex, nyaman untuk harian.'],
            ['name' => 'Panci Set Anti Lengket', 'category' => 'Rumah Tangga', 'price' => 275000, 'stock' => 8, 'description' => 'Set panci 3 ukuran, anti lengket.'],
            ['name' => 'Bola Basket', 'category' => 'Olahraga', 'price' => 150000, 'stock' => 20, 'description' => 'Bola basket ukuran standar.'],
            ['name' => 'Serum Wajah', 'category' => 'Kecantikan', 'price' => 89000, 'stock' => 30, 'description' => 'Serum vitamin C untuk mencerahkan wajah.'],
            ['name' => 'Kopi Bubuk Robusta', 'category' => 'Makanan & Minuman', 'price' => 45000, 'stock' => 40, 'description' => 'Kopi bubuk robusta 250 gram.'],
        ];

        foreach ($products as $item) {
            Product::firstOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'],
                    'price'       => $item['price'],
                    'stock'       => $item['stock'],
                    'category_id' => $categoryModels[$item['category']]->id,
                ]
            );
        }
    }
}
