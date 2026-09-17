<?php
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    // Validasi data form
    $errors = [];
    if (empty($name)) {
        $errors['name'] = 'Nama produk harus diisi.';
    }
    if (empty($category)) {
        $errors['category'] = 'Kategori produk harus dipilih.';
    }
    if (empty($price) || !is_numeric($price) || $price < 0) {
        $errors['price'] = 'Harga produk harus berupa angka positif.';
    }
    if (empty($stock) || !is_numeric($stock) || $stock < 0) {
        $errors['stock'] = 'Stok produk harus berupa angka positif.';
    }
    if (!empty($errors)) {
        $pesanError = implode(' ', $errors);
        header('Location: ../edit.php?id=' . $id . '&error=' . urlencode($pesanError));
        exit();
    }

    // Cek apakah ada gambar baru yang diunggah
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        // Pindahkan gambar baru ke folder tujuan
        $upload_dir = '../../uploads/';
        $image = str_replace(' ', '_', $image);
        $image = time() . '_' . basename($image); // Ganti nama agar tidak bentrok
        $image_path = $upload_dir . $image;
        move_uploaded_file($image_tmp, $image_path);

        // Hapus gambar lama jika ada
        $sql = "SELECT image FROM products WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $oldImage = $stmt->fetchColumn();
        if ($oldImage && file_exists($upload_dir . $oldImage)) {
            unlink($upload_dir . $oldImage);
        }

        // Update produk beserta gambar baru
        $sql = "UPDATE products SET name = :name, category = :category, price = :price, stock = :stock, description = :description, image = :image WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':price' => $price,
            ':stock' => $stock,
            ':description' => $description,
            ':image' => $image,
            ':id' => $id
        ]);
    } else {
        // Update produk tanpa mengganti gambar
        $sql = "UPDATE products SET name = :name, category = :category, price = :price, stock = :stock, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':price' => $price,
            ':stock' => $stock,
            ':description' => $description,
            ':id' => $id
        ]);
    }

    // Redirect ke halaman daftar produk setelah berhasil update
    header('Location: ../index.php');
    exit();
}
