<?php
require_once '../../connect.php';

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data form
    $id = $_POST['id'];
    // Ambil nama gambar lama dari database
    $sql = "SELECT image FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $oldImage = $stmt->fetchColumn();
    // Hapus file gambar lama jika ada
    if ($oldImage && file_exists('../../uploads/' . $oldImage)) {
        unlink('../../uploads/' . $oldImage);
    }

    // Hapus produk dari database
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    // Redirect ke halaman daftar produk setelah berhasil hapus
    header('Location: ../index.php');
    exit();
}
