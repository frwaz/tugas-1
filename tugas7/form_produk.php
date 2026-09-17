<?php
/**
 * TUGAS FORM INPUT
 * Form untuk menambahkan produk baru: nama, harga, deskripsi.
 * Saat disubmit, data dikirim (method POST) ke 3_proses_produk.php
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width:600px;">
    <h2 class="mb-4">Tambah Produk Baru</h2>

    <?php
    // Menampilkan pesan error dari proses_produk.php jika ada (dikirim lewat query string)
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success">Produk berhasil ditambahkan!</div>';
    }
    ?>

    <form action="3_proses_produk.php" method="POST">
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                   placeholder="Contoh: Smartphone X10">
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga"
                   placeholder="Contoh: 3500000" min="0">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                      placeholder="Deskripsikan produk secara singkat"></textarea>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok"
                   placeholder="Contoh: 10" min="0">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
    </form>
</div>
</body>
</html>
