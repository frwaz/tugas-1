<?php
$page_title = "Daftar Produk - Toko Sederhana";
include_once '../template/header.php';

// Ambil produk
require_once '../connect.php';

// Pencarian & filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Kategori untuk dropdown
$sql_categories = "SELECT DISTINCT category FROM products ORDER BY category";
$stmt_categories = $pdo->query($sql_categories);
$categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

// Query produk
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($search)) {
    $sql .= " AND name LIKE ?";
    $params[] = "%{$search}%";
}

if (!empty($category)) {
    $sql .= " AND category = ?";
    $params[] = $category;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="container my-5">
    <h1 class="mb-4">Daftar Produk</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <a href="create.php" class="btn btn-primary mb-3">Tambah Produk</a>

    <!-- Form pencarian dan filter -->
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= htmlspecialchars($search); ?>">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-control">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['category']); ?>" <?= $cat['category'] === $category ? 'selected' : ''; ?>><?= htmlspecialchars($cat['category']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
                <th>Keranjang</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id']); ?></td>
                    <td><?= htmlspecialchars($product['name']); ?></td>
                    <td><?= htmlspecialchars($product['price']); ?></td>
                    <td><?= htmlspecialchars($product['description']); ?></td>
                    <td><img src="../uploads/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" width="100"></td>
                    <td><?= htmlspecialchars($product['stock']); ?></td>
                    <td><?= htmlspecialchars($product['category']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= htmlspecialchars($product['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="db_action/delete.php" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']); ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <?php if ($product['stock'] > 0): ?>
                            <form action="../cart/add.php" method="POST" class="d-flex gap-1">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="number" name="quantity" value="1" min="1" max="<?= $product['stock']; ?>" class="form-control form-control-sm" style="width:70px;">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <span class="badge bg-secondary">Stok Habis</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="9" class="text-center">Tidak ada produk ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
<?php include_once '../template/footer.php'; ?>
