<?php
require_once '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int) ($_POST['product_id'] ?? 0);
    $qty       = (int) ($_POST['quantity'] ?? 1);

    if ($qty < 1) {
        $qty = 1;
    }

    if (isset($_SESSION['cart'][$productId])) {
        // Batasi sesuai stok
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = :id");
        $stmt->execute([':id' => $productId]);
        $stock = (int) $stmt->fetchColumn();

        if ($qty > $stock) {
            $qty = $stock;
        }

        $_SESSION['cart'][$productId] = $qty;
    }
}

header('Location: index.php');
exit();
