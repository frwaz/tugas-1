<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            // Jangan buat order dummy kalau belum ada user/produk
            // (mis. UserSeeder atau ProductSeeder belum jalan).
            return;
        }

        // Beberapa kombinasi pesanan dummy: [user index, product index, quantity]
        $orders = [
            [0, 0, 1],
            [1, 2, 2],
            [1, 5, 1],
            [2, 1, 3],
            [2, 8, 1],
        ];

        foreach ($orders as [$userIndex, $productIndex, $quantity]) {
            $user = $users[$userIndex] ?? $users->random();
            $product = $products[$productIndex] ?? $products->random();

            Order::firstOrCreate(
                [
                    'user_id'    => $user->id,
                    'product_id' => $product->id,
                ],
                [
                    'quantity' => $quantity,
                    'total'    => $product->price * $quantity,
                ]
            );
        }
    }
}
