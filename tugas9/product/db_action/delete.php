<?php
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Hapus gambar lama
    $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $oldImage = $stmt->fetchColumn();
    if ($oldImage && file_exists('../../uploads/' . $oldImage)) {
        unlink('../../uploads/' . $oldImage);
    }

    // Hapus produk
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);

    header('Location: ../index.php');
    exit();
}
