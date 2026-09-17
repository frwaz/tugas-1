<?php
require_once '../connect.php';

// Insert produk baru
$name = "Laptop";
$price = 8500000;
$description = "Laptop performa tinggi untuk gaming dan kerja.";
$image = "laptop.jpg";
$stock = 10;
$category = "Elektronik";

$sql = "INSERT INTO products (name, price, description, image, stock, category) VALUES (:name, :price, :description, :image, :stock, :category)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':name' => $name,
    ':price' => $price,
    ':description' => $description,
    ':image' => $image,
    ':stock' => $stock,
    ':category' => $category
]);

echo "Produk baru berhasil ditambahkan!";
?>
