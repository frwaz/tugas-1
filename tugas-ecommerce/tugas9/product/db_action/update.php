<?php
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    // Validasi
    $errors = [];
    if (empty($name)) $errors['name'] = 'Nama produk harus diisi.';
    if (empty($category)) $errors['category'] = 'Kategori harus dipilih.';
    if (empty($price) || !is_numeric($price) || $price < 0) $errors['price'] = 'Harga harus angka positif.';
    if (empty($stock) || !is_numeric($stock) || $stock < 0) $errors['stock'] = 'Stok harus angka positif.';

    if (!empty($errors)) {
        $pesanError = implode(' ', $errors);
        header('Location: ../edit.php?id=' . $id . '&error=' . urlencode($pesanError));
        exit();
    }

    // Ganti gambar jika ada upload baru
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $upload_dir = '../../uploads/';
        $image = str_replace(' ', '_', $image);
        $image = time() . '_' . basename($image);
        $image_path = $upload_dir . $image;
        move_uploaded_file($image_tmp, $image_path);

        // Hapus gambar lama
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $oldImage = $stmt->fetchColumn();
        if ($oldImage && file_exists($upload_dir . $oldImage)) {
            unlink($upload_dir . $oldImage);
        }

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

    header('Location: ../index.php');
    exit();
}
