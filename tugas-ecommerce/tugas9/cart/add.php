<?php
require_once '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productId = (int) ($_POST['product_id'] ?? 0);
    $qty       = (int) ($_POST['quantity'] ?? 1);

    if ($productId <= 0) {
        header('Location: ../product/index.php?error=' . urlencode('Produk tidak valid.'));
        exit();
    }
    if ($qty < 1) {
        $qty = 1;
    }

    // Cek produk ada
    $stmt = $pdo->prepare("SELECT id, stock FROM products WHERE id = :id");
    $stmt->execute([':id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        header('Location: ../product/index.php?error=' . urlencode('Produk tidak ditemukan.'));
        exit();
    }

    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Tambah/ubah quantity di keranjang
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $qty;
    } else {
        $_SESSION['cart'][$productId] = $qty;
    }

    // Batasi sesuai stok
    if ($_SESSION['cart'][$productId] > $product['stock']) {
        $_SESSION['cart'][$productId] = $product['stock'];
    }

    header('Location: ../product/index.php?success=' . urlencode('Produk ditambahkan ke keranjang!'));
    exit();
}

header('Location: ../product/index.php');
exit();
