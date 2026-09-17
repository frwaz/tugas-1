<?php
require_once '../connect.php';

// Menghapus data dari tabel products berdasarkan ID
$productId = 1; // ID produk yang akan dihapus
$sql = "DELETE FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $productId]);
echo "Produk berhasil dihapus!";
?>
