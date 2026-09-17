<?php
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Validasi
    $errors = [];
    if (empty($name)) $errors['name'] = 'Nama produk harus diisi.';
    if (empty($category)) $errors['category'] = 'Kategori harus dipilih.';
    if (empty($price) || !is_numeric($price) || $price < 0) $errors['price'] = 'Harga harus angka positif.';
    if (empty($stock) || !is_numeric($stock) || $stock < 0) $errors['stock'] = 'Stok harus angka positif.';
    if (empty($image)) $errors['image'] = 'Gambar harus diunggah.';

    if (empty($errors)) {
        // Upload gambar
        $upload_dir = '../../uploads/';
        $image = str_replace(' ', '_', $image);
        $image = time() . '_' . basename($image);
        $image_path = $upload_dir . $image;

        if (move_uploaded_file($image_tmp, $image_path)) {
            $sql = "INSERT INTO products (name, category, price, stock, description, image) VALUES (:name, :category, :price, :stock, :description, :image)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':category' => $category,
                ':price' => $price,
                ':stock' => $stock,
                ':description' => $description,
                ':image' => $image
            ]);
            header('Location: ../index.php');
            exit();
        } else {
            $errors['image'] = 'Gagal mengunggah gambar.';
        }
    }

    if (!empty($errors)) {
        $pesanError = implode(' ', $errors);
        header('Location: ../create.php?error=' . urlencode($pesanError));
        exit();
    }
}
