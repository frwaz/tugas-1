<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard beserta statistik ringkas toko:
     * jumlah produk, total klik produk, dan jumlah kategori.
     */
    public function index()
    {
        $totalProducts   = Product::count();
        $totalClicks     = Product::sum('klik');
        $totalCategories = ProductCategory::count();

        // Beberapa produk dengan klik terbanyak, untuk ditampilkan di dashboard.
        $mostViewedProducts = Product::with('category')
            ->orderByDesc('klik')
            ->take(5)
            ->get();

        // Produk terbaru, ditampilkan sebagai kartu yang bisa diklik di halaman utama.
        $latestProducts = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard.index', [
            'totalProducts'      => $totalProducts,
            'totalClicks'        => $totalClicks,
            'totalCategories'    => $totalCategories,
            'mostViewedProducts' => $mostViewedProducts,
            'latestProducts'     => $latestProducts,
        ]);
    }
}
