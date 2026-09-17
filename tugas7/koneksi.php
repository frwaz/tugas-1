<?php
/**
 * KONEKSI DATABASE
 * Sesuaikan host, username, password, dan nama database
 * dengan pengaturan MySQL di komputer/server kamu.
 */

$host     = "localhost";
$username = "root";
$password = "";
$database = "ecommerce_db";

$koneksi = new mysqli($host, $username, $password, $database);

// Cek apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
