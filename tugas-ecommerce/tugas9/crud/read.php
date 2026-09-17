<?php
require_once '../connect.php';

// Ambil & tampilkan semua produk
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "ID: " . $product['id'] . "<br>";
    echo "Nama: " . $product['name'] . "<br>";
    echo "Harga: " . $product['price'] . "<br>";
    echo "Deskripsi: " . $product['description'] . "<br>";
    echo "Gambar: " . $product['image'] . "<br>";
    echo "Stok: " . $product['stock'] . "<br>";
    echo "Kategori: " . $product['category'] . "<br>";
    echo "<hr>";
}
?>
