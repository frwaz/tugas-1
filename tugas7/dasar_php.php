<?php
/**
 * TUGAS DASAR PHP
 * Latihan: deklarasi variabel, operator, dan penggunaan if-else
 * File ini bisa dijalankan langsung untuk melihat cara kerja dasar PHP,
 * sebelum dipakai untuk memproses data form yang sesungguhnya.
 */

// ------------------------------------------
// 1. DEKLARASI VARIABEL
// ------------------------------------------
$namaProduk = "Smartphone X10";   // string
$harga      = 3500000;            // integer
$stok       = 25;                 // integer
$diskonPersen = 10;                // integer (persen diskon)
$tersedia   = true;                // boolean

// ------------------------------------------
// 2. OPERATOR
// ------------------------------------------

// Operator aritmatika: menghitung harga setelah diskon
$potongan     = $harga * ($diskonPersen / 100); // operator perkalian & pembagian
$hargaSetelahDiskon = $harga - $potongan;        // operator pengurangan

// Operator perbandingan: mengecek apakah stok mencukupi
$stokMinimal = 5;
$stokCukup   = $stok > $stokMinimal;   // hasil: true / false

// Operator logika: gabungan beberapa syarat
$bisaDibeli = $tersedia && $stokCukup;  // AND logika

// ------------------------------------------
// 3. PENGGUNAAN IF-ELSE
// ------------------------------------------
echo "<h2>Latihan Dasar PHP</h2>";

echo "<p>Nama Produk: $namaProduk</p>";
echo "<p>Harga Awal: Rp" . number_format($harga, 0, ',', '.') . "</p>";
echo "<p>Harga Setelah Diskon: Rp" . number_format($hargaSetelahDiskon, 0, ',', '.') . "</p>";

// if-else sederhana untuk status stok
if ($stok == 0) {
    echo "<p>Status Stok: <b>Habis</b></p>";
} elseif ($stok < $stokMinimal) {
    echo "<p>Status Stok: <b>Menipis, segera restock!</b></p>";
} else {
    echo "<p>Status Stok: <b>Aman ($stok unit tersedia)</b></p>";
}

// if-else untuk menentukan apakah produk bisa dibeli
if ($bisaDibeli) {
    echo "<p style='color:green;'>Produk ini bisa dibeli.</p>";
} else {
    echo "<p style='color:red;'>Produk ini belum bisa dibeli.</p>";
}
