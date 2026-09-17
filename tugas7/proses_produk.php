<?php
/**
 * TUGAS VALIDASI + PROSES FORM
 * Menerima data dari form (2_form_produk.php), memvalidasi agar tidak kosong,
 * lalu menyimpannya ke tabel `products` di database.
 */

require "koneksi.php";

// Pastikan form dikirim dengan method POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ------------------------------------------
    // 1. AMBIL DATA DARI FORM (deklarasi variabel)
    // trim() untuk menghapus spasi kosong di awal/akhir input
    // ------------------------------------------
    $namaProduk = trim($_POST["nama_produk"] ?? "");
    $harga      = trim($_POST["harga"] ?? "");
    $deskripsi  = trim($_POST["deskripsi"] ?? "");
    $stok       = trim($_POST["stok"] ?? "");

    // ------------------------------------------
    // 2. VALIDASI SEDERHANA
    // Memastikan data yang wajib diisi tidak kosong,
    // dan harga/stok berupa angka yang valid (operator perbandingan)
    // ------------------------------------------
    $errors = [];

    if ($namaProduk === "") {
        $errors[] = "Nama produk tidak boleh kosong.";
    }

    if ($harga === "") {
        $errors[] = "Harga tidak boleh kosong.";
    } elseif (!is_numeric($harga) || $harga < 0) {
        $errors[] = "Harga harus berupa angka positif.";
    }

    if ($deskripsi === "") {
        $errors[] = "Deskripsi tidak boleh kosong.";
    }

    if ($stok === "") {
        $errors[] = "Stok tidak boleh kosong.";
    } elseif (!is_numeric($stok) || $stok < 0) {
        $errors[] = "Stok harus berupa angka positif.";
    }

    // ------------------------------------------
    // 3. IF-ELSE: JIKA ADA ERROR, KEMBALI KE FORM
    //    JIKA TIDAK, SIMPAN KE DATABASE
    // ------------------------------------------
    if (count($errors) > 0) {
        // Gabungkan semua pesan error menjadi satu string
        $pesanError = implode(" ", $errors);
        header("Location: 2_form_produk.php?error=" . urlencode($pesanError));
        exit;
    } else {
        // Gunakan prepared statement agar aman dari SQL Injection
        $stmt = $koneksi->prepare(
            "INSERT INTO products (product_name, price, description, stock) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("sdsi", $namaProduk, $harga, $deskripsi, $stok);

        if ($stmt->execute()) {
            header("Location: 2_form_produk.php?success=1");
            exit;
        } else {
            header("Location: 2_form_produk.php?error=" . urlencode("Gagal menyimpan data: " . $stmt->error));
            exit;
        }

        $stmt->close();
    }

    $koneksi->close();

} else {
    // Jika file diakses langsung tanpa mengirim form
    header("Location: 2_form_produk.php");
    exit;
}
