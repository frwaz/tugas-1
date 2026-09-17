<?php
require_once '../connect.php';

// Hapus produk berdasarkan ID
$productId = 1;
$sql = "DELETE FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $productId]);
echo "Produk berhasil dihapus!";
?>
