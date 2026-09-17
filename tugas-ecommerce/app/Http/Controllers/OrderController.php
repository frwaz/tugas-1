<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan daftar order (misalnya untuk halaman riwayat pesanan)
    public function index()
    {
        $orders = Order::with('product')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    // Simpan order baru saat checkout
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $total = $product->price * $validated['quantity'];

        $order = Order::create([
            'user_id'    => auth()->id() ?? 1, // sementara, sebelum ada login
            'product_id' => $product->id,
            'quantity'   => $validated['quantity'],
            'total'      => $total,
        ]);

        return redirect()->route('checkout.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
