<?php
$page_title = "Katalog Produk Kue Premium";
require_once __DIR__ . '/config/database.php';
include_once __DIR__ . '/includes/header.php';

// Filter parameter
$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$sort = $_GET['sort'] ?? 'newest';

$where = [];

if ($keyword != '') {
    $keyword_safe = mysqli_real_escape_string($conn, $keyword);
    $where[] = "(nama LIKE '%$keyword_safe%' OR deskripsi LIKE '%$keyword_safe%')";
}

if ($kategori != '') {
    $kategori_safe = mysqli_real_escape_string($conn, $kategori);
    $where[] = "kategori = '$kategori_safe'";
}

$where_sql = "";
if (count($where) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

// Sorting logic
$order_by = "ORDER BY id DESC";
if ($sort == 'price_low') {
    $order_by = "ORDER BY harga ASC";
} elseif ($sort == 'price_high') {
    $order_by = "ORDER BY harga DESC";
} elseif ($sort == 'name_asc') {
    $order_by = "ORDER BY nama ASC";
}

$query = mysqli_query($conn, "SELECT * FROM produk $where_sql $order_by");
$total_found = $query ? mysqli_num_rows($query) : 0;
?>

<!-- Header Banner -->
<section style="background: linear-gradient(135deg, #fff5f5 0%, #ffe3e5 100%); padding: 60px 0; border-radius: 0 0 40px 40px; margin-bottom: 40px;">
    <div class="container" style="text-align: center;">
        <span class="badge badge-primary" style="margin-bottom: 12px;">
            <i class="fa-solid fa-cake-candles"></i> Anugerah Kelezatan
        </span>
        <h1 style="font-size: 3rem; color: var(--dark-main); margin-bottom: 14px;">Katalog Kue & Pastry</h1>
        <p style="color: var(--muted-text); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Pilih dan nikmati aneka kreasi kue spesial buatan chef pastry berpengalaman kami.</p>
    </div>
</section>

<main class="container" style="padding-bottom: 80px;">
    <!-- Interactive Search Bar -->
    <div class="search-box-wrapper">
        <form action="produk.php" method="GET" id="searchForm">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" name="keyword" class="search-input" id="liveSearchInput" placeholder="Cari kue favorit Anda (misal: Brownies, Cheese Cake)..." value="<?= htmlspecialchars($keyword); ?>">
            <?php if (!empty($kategori)): ?>
                <input type="hidden" name="kategori" value="<?= htmlspecialchars($kategori); ?>">
            <?php endif; ?>
        </form>
    </div>

    <!-- Category Filter Tabs -->
    <div class="filter-container">
        <a href="produk.php" class="filter-btn <?= empty($kategori) ? 'active' : ''; ?>">
            <i class="fa-solid fa-border-all"></i> Semua Kue
        </a>
        <a href="produk.php?kategori=Cake" class="filter-btn <?= $kategori == 'Cake' ? 'active' : ''; ?>">
            <i class="fa-solid fa-cake-candles"></i> Cake & Tart
        </a>
        <a href="produk.php?kategori=Brownies" class="filter-btn <?= $kategori == 'Brownies' ? 'active' : ''; ?>">
            <i class="fa-solid fa-cookie"></i> Brownies
        </a>
        <a href="produk.php?kategori=Donat" class="filter-btn <?= $kategori == 'Donat' ? 'active' : ''; ?>">
            <i class="fa-solid fa-circle-dot"></i> Donat
        </a>
        <a href="produk.php?kategori=Pastry" class="filter-btn <?= $kategori == 'Pastry' ? 'active' : ''; ?>">
            <i class="fa-solid fa-bread-slice"></i> Pastry
        </a>
    </div>

    <!-- Toolbar Info & Sorting -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 16px; background: var(--white); padding: 16px 24px; border-radius: var(--radius-md); box-shadow: var(--shadow-sm);">
        <div style="font-size: 0.95rem; color: var(--muted-text); font-weight: 600;">
            Menampilkan <strong style="color: var(--primary);"><?= $total_found; ?></strong> varian kue
            <?php if (!empty($keyword)): ?> untuk pencarian "<strong><?= htmlspecialchars($keyword); ?></strong>"<?php endif; ?>
        </div>

        <div style="display: flex; align-items: center; gap: 10px;">
            <label style="font-size: 0.88rem; font-weight: 700; color: var(--dark-main);">Urutkan:</label>
            <form action="produk.php" method="GET" id="sortForm">
                <?php if(!empty($keyword)): ?><input type="hidden" name="keyword" value="<?= htmlspecialchars($keyword); ?>"><?php endif; ?>
                <?php if(!empty($kategori)): ?><input type="hidden" name="kategori" value="<?= htmlspecialchars($kategori); ?>"><?php endif; ?>
                <select name="sort" onchange="document.getElementById('sortForm').submit();" style="margin: 0; padding: 8px 16px; border-radius: var(--radius-full); border: 1px solid rgba(230,57,70,0.2); font-size: 0.88rem; font-weight: 600; cursor: pointer; background: var(--white);">
                    <option value="newest" <?= $sort == 'newest' ? 'selected' : ''; ?>>Terbaru</option>
                    <option value="price_low" <?= $sort == 'price_low' ? 'selected' : ''; ?>>Harga: Terendah -> Tertinggi</option>
                    <option value="price_high" <?= $sort == 'price_high' ? 'selected' : ''; ?>>Harga: Tertinggi -> Terendah</option>
                    <option value="name_asc" <?= $sort == 'name_asc' ? 'selected' : ''; ?>>Nama (A-Z)</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid-products" id="productGrid">
        <?php if ($total_found > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($query)): 
                $gambar_path = !empty($row['gambar']) && file_exists(__DIR__ . '/uploads/produk/' . $row['gambar']) 
                    ? 'uploads/produk/' . $row['gambar'] 
                    : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=600&q=80';
            ?>
                <div class="card-product product-item-card" data-nama="<?= strtolower(htmlspecialchars($row['nama'])); ?>" data-desc="<?= strtolower(htmlspecialchars($row['deskripsi'])); ?>">
                    <div class="card-img-wrapper">
                        <span class="card-category-badge">
                            <i class="fa-solid fa-tag"></i> <?= htmlspecialchars($row['kategori'] ?? 'Cake'); ?>
                        </span>
                        <img src="<?= $gambar_path; ?>" alt="<?= htmlspecialchars($row['nama']); ?>">
                        <div class="card-overlay-actions">
                            <button class="action-btn-circle" title="Lihat & Pesan Modal" onclick="openModal(<?= $row['id']; ?>, '<?= addslashes($row['nama']); ?>', '<?= addslashes($row['kategori']); ?>', '<?= addslashes($row['deskripsi']); ?>', <?= $row['harga']; ?>, <?= $row['stok']; ?>, '<?= $gambar_path; ?>')">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <a href="detail.php?id=<?= $row['id']; ?>" class="action-btn-circle" title="Detail Halaman">
                                <i class="fa-solid fa-link"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-content">
                        <h3 class="card-title"><?= htmlspecialchars($row['nama']); ?></h3>
                        <p class="card-desc"><?= htmlspecialchars($row['deskripsi']); ?></p>
                        
                        <div class="card-footer-row">
                            <div class="card-price">
                                Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                            </div>
                            <button class="btn btn-primary btn-sm" onclick="openModal(<?= $row['id']; ?>, '<?= addslashes($row['nama']); ?>', '<?= addslashes($row['kategori']); ?>', '<?= addslashes($row['deskripsi']); ?>', <?= $row['harga']; ?>, <?= $row['stok']; ?>, '<?= $gambar_path; ?>')">
                                <i class="fa-solid fa-cart-shopping"></i> Pesan
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 70px 20px; background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                <i class="fa-solid fa-cookie-bite" style="font-size: 4rem; color: var(--primary); margin-bottom: 20px;"></i>
                <h3 style="font-size: 1.5rem; color: var(--dark-main); margin-bottom: 8px;">Kue Tidak Ditemukan</h3>
                <p style="color: var(--muted-text); margin-bottom: 24px;">Maaf, tidak ada kue yang cocok dengan pencarian Anda saat ini.</p>
                <a href="produk.php" class="btn btn-primary">
                    <i class="fa-solid fa-rotate-left"></i> Reset Pencarian
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
// Client-side Live Search Filter
const liveSearchInput = document.getElementById('liveSearchInput');
if (liveSearchInput) {
    liveSearchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const cards = document.querySelectorAll('.product-item-card');
        
        cards.forEach(card => {
            const nama = card.getAttribute('data-nama');
            const desc = card.getAttribute('data-desc');
            if (nama.includes(filter) || desc.includes(filter)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
}
</script>

<?php include_once __DIR__ . '/includes/footer.php'; ?>