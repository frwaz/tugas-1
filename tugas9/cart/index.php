<?php
$page_title = "Keranjang Belanja - Toko Sederhana";
require_once '../connect.php';

$cart = $_SESSION['cart'] ?? [];
$cartItems = [];
$grandTotal = 0;

if (!empty($cart)) {
    // Ambil produk sesuai isi cart
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $qty = $cart[$product['id']];
        $subtotal = $product['price'] * $qty;
        $grandTotal += $subtotal;

        $cartItems[] = [
            'product'  => $product,
            'quantity' => $qty,
            'subtotal' => $subtotal,
        ];
    }
}

include_once '../template/header.php';
?>
<main class="container my-5">
    <h1 class="mb-4">Keranjang Belanja</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-secondary">
            Keranjang belanja Anda masih kosong.
            <a href="../product/index.php" class="alert-link">Yuk mulai belanja</a>.
        </div>
    <?php else: ?>
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th style="width:150px;">Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../uploads/<?= htmlspecialchars($item['product']['image']); ?>" alt="<?= htmlspecialchars($item['product']['name']); ?>" width="60">
                                <span><?= htmlspecialchars($item['product']['name']); ?></span>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($item['product']['category']); ?></td>
                        <td>Rp<?= number_format($item['product']['price'], 0, ',', '.'); ?></td>
                        <td>
                            <form action="update.php" method="POST" class="d-flex gap-1">
                                <input type="hidden" name="product_id" value="<?= $item['product']['id']; ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1" max="<?= $item['product']['stock']; ?>" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Ubah</button>
                            </form>
                        </td>
                        <td>Rp<?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        <td>
                            <form action="remove.php" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                                <input type="hidden" name="product_id" value="<?= $item['product']['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total Belanja</th>
                    <th colspan="2">Rp<?= number_format($grandTotal, 0, ',', '.'); ?></th>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex justify-content-between">
            <a href="../product/index.php" class="btn btn-secondary">Lanjut Belanja</a>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
        </div>
    <?php endif; ?>
</main>
<?php include_once '../template/footer.php'; ?>
