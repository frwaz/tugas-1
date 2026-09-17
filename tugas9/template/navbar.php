<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../product/index.php">
            <i class="bi bi-shop me-1"></i> Toko Sederhana
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="../product/index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../product/create.php">Tambah Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative" href="../cart/index.php">
                        <i class="bi bi-cart3 fs-5"></i> Keranjang
                        <?php $jumlahItemKeranjang = array_sum($_SESSION['cart'] ?? []); ?>
                        <?php if ($jumlahItemKeranjang > 0): ?>
                            <span class="badge bg-warning text-dark rounded-pill ms-1"><?= $jumlahItemKeranjang ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
