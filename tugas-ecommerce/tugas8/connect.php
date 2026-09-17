<?php
// Koneksi database PHP menggunakan PDO
$host    = 'localhost';
$db      = 'ecommerce_db';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Berhasil terhubung ke database!";
} catch (\PDOException $e) {
    // echo "Koneksi gagal: " . $e->getMessage();
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
