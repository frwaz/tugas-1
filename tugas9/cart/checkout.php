<?php
$page_title = "Checkout - Toko Sederhana";
require_once '../connect.php';

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header('Location: index.php');
    exit();
}

// Ambil data produk yang ada di keranjang
$ids = array_keys($cart);
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
$stmt->execute($ids);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// user_id sementara pakai 1 (belum ada login)
$userId = 1;
$grandTotal = 0;

$insertOrder = $pdo->prepare(
    "INSERT INTO orders (user_id, product_id, quantity, total) VALUES (:user_id, :product_id, :quantity, :total)"
);

foreach ($products as $product) {
    $qty = $cart[$product['id']];
    $total = $product['price'] * $qty;
    $grandTotal += $total;

    $insertOrder->execute([
        ':user_id'    => $userId,
        ':product_id' => $product['id'],
        ':quantity'   => $qty,
        ':total'      => $total,
    ]);

    // Kurangi stok
    $pdo->prepare("UPDATE products SET stock = stock - :qty WHERE id = :id")
        ->execute([':qty' => $qty, ':id' => $product['id']]);
}

// Kosongkan keranjang
$_SESSION['cart'] = [];

include_once '../template/header.php';
?>
<main class="container my-5">
    <div class="alert alert-success">
        <h4 class="alert-heading">Checkout berhasil!</h4>
        <p class="mb-0">Total pesanan: <strong>Rp<?= number_format($grandTotal, 0, ',', '.'); ?></strong></p>
    </div>
    <a href="../product/index.php" class="btn btn-primary">Kembali Belanja</a>
</main>
<?php include_once '../template/footer.php'; ?>
