<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik',
            'Fashion',
            'Rumah Tangga',
            'Olahraga',
            'Kecantikan',
            'Makanan & Minuman',
        ];

        foreach ($categories as $name) {
            ProductCategory::firstOrCreate(['name' => $name]);
        }
    }
}
