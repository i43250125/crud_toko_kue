<?php
$page_title = "Detail Produk";
require_once "config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    header("Location: produk.php");
    exit;
}

$page_title = $produk['nama'] . " - Sweet Cake";
include_once __DIR__ . "/includes/header.php";

$gambar_path = !empty($produk['gambar']) && file_exists(__DIR__ . '/uploads/produk/' . $produk['gambar'])
    ? 'uploads/produk/' . $produk['gambar']
    : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=800&q=80';

// Fetch related products in the same category
$kategori_safe = mysqli_real_escape_string($conn, $produk['kategori']);
$related_query = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = '$kategori_safe' AND id != $id LIMIT 3");
?>

<div style="background: linear-gradient(135deg, #fff5f5 0%, #ffe3e5 100%); padding: 30px 0;">
    <div class="container">
        <ul style="display: flex; gap: 10px; list-style: none; font-size: 0.9rem; color: var(--muted-text);">
            <li><a href="index.php" style="color: var(--primary); font-weight: 600;">Beranda</a></li>
            <li>/</li>
            <li><a href="produk.php" style="color: var(--primary); font-weight: 600;">Katalog</a></li>
            <li>/</li>
            <li style="color: var(--dark-main); font-weight: 700;"><?= htmlspecialchars($produk['nama']); ?></li>
        </ul>
    </div>
</div>

<main class="container" style="padding: 60px 24px 90px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; background: var(--white); border-radius: var(--radius-lg); padding: 40px; box-shadow: var(--shadow-md); border: 1px solid var(--glass-border); margin-bottom: 70px;">
        <!-- Left Column: Image View -->
        <div style="position: relative; border-radius: var(--radius-md); overflow: hidden; background: var(--primary-light); max-height: 480px;">
            <span class="badge badge-primary" style="position: absolute; top: 20px; left: 20px; z-index: 5; font-size: 0.85rem;">
                <i class="fa-solid fa-tag"></i> <?= htmlspecialchars($produk['kategori'] ?? 'Cake'); ?>
            </span>
            <img src="<?= $gambar_path; ?>" alt="<?= htmlspecialchars($produk['nama']); ?>" style="width: 100%; height: 100%; object-fit: cover; display: block; transition: var(--transition);">
        </div>

        <!-- Right Column: Product Specs & Ordering -->
        <div style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h1 style="font-size: 2.5rem; color: var(--dark-main); margin-bottom: 12px; font-weight: 700; font-family: 'Playfair Display', serif;">
                    <?= htmlspecialchars($produk['nama']); ?>
                </h1>

                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
                    <div style="color: var(--secondary); font-size: 1.1rem;">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <span style="color: var(--dark-main); font-size: 0.9rem; font-weight: 700; margin-left: 6px;">4.9 (48 Ulasan)</span>
                    </div>

                    <div style="width: 1px; height: 16px; background: #ddd;"></div>

                    <?php if ($produk['stok'] > 0): ?>
                        <span class="badge" style="background: #e8f5e9; color: #2e7d32; font-size: 0.82rem;">
                            <i class="fa-solid fa-circle-check"></i> Stok Tersedia (<?= $produk['stok']; ?> pax)
                        </span>
                    <?php else: ?>
                        <span class="badge" style="background: #ffebee; color: #c62828; font-size: 0.82rem;">
                            <i class="fa-solid fa-circle-xmark"></i> Stok Habis
                        </span>
                    <?php endif; ?>
                </div>

                <div style="background: var(--primary-light); padding: 18px 24px; border-radius: var(--radius-md); margin-bottom: 28px; display: flex; align-items: baseline; gap: 12px;">
                    <span style="font-size: 0.95rem; color: var(--muted-text); font-weight: 600;">Harga:</span>
                    <span style="font-size: 2.2rem; font-weight: 800; color: var(--primary-dark);">
                        Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
                    </span>
                </div>

                <div style="margin-bottom: 30px;">
                    <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--dark-main); margin-bottom: 8px;">Deskripsi Produk:</h3>
                    <p style="color: var(--muted-text); line-height: 1.7; font-size: 0.98rem;">
                        <?= nl2br(htmlspecialchars($produk['deskripsi'])); ?>
                    </p>
                </div>

                <!-- Interactive Quantity Calculator -->
                <div style="margin-bottom: 30px;">
                    <label style="font-weight: 700; font-size: 0.95rem; color: var(--dark-main);">Pilih Jumlah:</label>
                    <div class="qty-counter" style="margin-top: 10px;">
                        <button class="qty-btn" onclick="changeDetailQty(-1)">-</button>
                        <span class="qty-val" id="detailQtyVal">1</span>
                        <button class="qty-btn" onclick="changeDetailQty(1)">+</button>
                        
                        <div style="margin-left: auto; text-align: right;">
                            <span style="font-size: 0.85rem; color: var(--muted-text); display: block;">Subtotal:</span>
                            <span id="detailSubtotalText" style="font-size: 1.3rem; font-weight: 800; color: var(--primary);">
                                Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                <button onclick="orderDetailViaWA()" class="btn btn-wa" style="flex: 1; padding: 16px 28px; border-radius: var(--radius-md); font-size: 1.05rem;">
                    <i class="fa-brands fa-whatsapp" style="font-size: 1.3rem;"></i> Pesan via WhatsApp
                </button>
                <a href="produk.php" class="btn btn-outline" style="padding: 16px 24px; border-radius: var(--radius-md);">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <?php if ($related_query && mysqli_num_rows($related_query) > 0): ?>
        <div>
            <h2 style="font-size: 2rem; color: var(--dark-main); margin-bottom: 30px; font-family: 'Playfair Display', serif;">
                Produk Sejenis Lainnya
            </h2>

            <div class="grid-products">
                <?php while ($rel = mysqli_fetch_assoc($related_query)): 
                    $rel_img = !empty($rel['gambar']) && file_exists(__DIR__ . '/uploads/produk/' . $rel['gambar']) 
                        ? 'uploads/produk/' . $rel['gambar'] 
                        : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=600&q=80';
                ?>
                    <div class="card-product">
                        <div class="card-img-wrapper">
                            <span class="card-category-badge">
                                <i class="fa-solid fa-tag"></i> <?= htmlspecialchars($rel['kategori']); ?>
                            </span>
                            <img src="<?= $rel_img; ?>" alt="<?= htmlspecialchars($rel['nama']); ?>">
                            <div class="card-overlay-actions">
                                <a href="detail.php?id=<?= $rel['id']; ?>" class="action-btn-circle" title="Lihat Detail">
                                    <i class="fa-solid fa-link"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card-content">
                            <h3 class="card-title"><?= htmlspecialchars($rel['nama']); ?></h3>
                            <p class="card-desc"><?= htmlspecialchars($rel['deskripsi']); ?></p>
                            
                            <div class="card-footer-row">
                                <div class="card-price">
                                    Rp <?= number_format($rel['harga'], 0, ',', '.'); ?>
                                </div>
                                <a href="detail.php?id=<?= $rel['id']; ?>" class="btn btn-primary btn-sm">
                                    Detail <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
</main>

<script>
let detailUnitHarga = <?= (float)$produk['harga']; ?>;
let detailMaxStok = <?= (int)$produk['stok']; ?>;
let currentDetailQty = 1;

function changeDetailQty(delta) {
    let newQty = currentDetailQty + delta;
    if (newQty >= 1 && (detailMaxStok === 0 || newQty <= detailMaxStok)) {
        currentDetailQty = newQty;
        document.getElementById('detailQtyVal').textContent = currentDetailQty;
        let subtotal = detailUnitHarga * currentDetailQty;
        document.getElementById('detailSubtotalText').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    }
}

function orderDetailViaWA() {
    let total = detailUnitHarga * currentDetailQty;
    let text = `Halo Sweet Cake, saya tertarik dan ingin memesan:\n` +
               `🍰 *<?= addslashes($produk['nama']); ?>*\n` +
               `🔢 Jumlah: ${currentDetailQty} pax\n` +
               `💰 Total Harga: Rp ${total.toLocaleString('id-ID')}\n\n` +
               `Mohon info cara pembayaran dan pengirimannya. Terima kasih!`;
    let url = `https://wa.me/6281234567890?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
}
</script>

<?php include_once __DIR__ . "/includes/footer.php"; ?>