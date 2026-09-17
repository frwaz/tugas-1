<?php
require_once '../connect.php';

// Update produk berdasarkan ID
$productId = 1;
$newName = "Laptop (Update)";
$newPrice = 8200000;
$newDescription = "Laptop performa tinggi versi terbaru.";
$newImage = "laptop_update.jpg";
$newStock = 15;

$sql = "UPDATE products SET name = :name, price = :price, description = :description, image = :image, stock = :stock WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':name' => $newName,
    ':price' => $newPrice,
    ':description' => $newDescription,
    ':image' => $newImage,
    ':stock' => $newStock,
    ':id' => $productId
]);
echo "Produk berhasil diupdate!";
?>
