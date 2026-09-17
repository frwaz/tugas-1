<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class DashboardController extends Controller
{
    // Tampilkan halaman dashboard utama beserta ringkasan statistik toko
    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = ProductCategory::count();
        $totalClicks     = Product::sum('clicks');

        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalClicks'));
    }
}
