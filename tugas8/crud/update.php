<?php

require_once '../connect.php';

// Update data di tabel products (name, price, description, image, stock) berdasarkan ID
$productId = 1; // ID produk yang akan diupdate
$newName = "Laptop (Update)";
$newPrice = 8200000;
$newDescription = "Laptop performa tinggi versi terbaru, cocok untuk gaming dan kerja profesional.";
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
