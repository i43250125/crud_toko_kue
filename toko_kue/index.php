<?php
$page_title = "Sweet Cake - Toko Kue Lezat & Premium";
require_once __DIR__ . "/config/database.php";
include_once __DIR__ . "/includes/header.php";

// Fetch latest products
$query = mysqli_query(
    $conn,
    "SELECT * FROM produk ORDER BY id DESC LIMIT 6"
);

// Fallback images if database has non-existent local image files
$default_images = [
    'brownies.jpg' => 'uploads/produk/brownies.jpg',
    'cheesecake.jpg' => 'uploads/produk/cheesecake.jpg',
    'donat.jpg' => 'uploads/produk/donat.jpg'
];
?>

<!-- Hero Section -->
<section class="hero-wrapper">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-text">
                <div class="badge badge-primary" style="margin-bottom: 20px;">
                    <i class="fa-solid fa-crown" style="color: var(--secondary);"></i> #1 Toko Kue Terfavorit & Premium
                </div>
                <h1>Kelezatan Autentik Dalam Setiap <span>Gigitan Kue</span></h1>
                <p>Dipanggang segar setiap hari dengan bahan-bahan mentega impor berkualitas tinggi, coklat murni, dan keju terbaik. Sempurna untuk ulang tahun, pesta, atau momen istimewa Anda.</p>

                <div style="display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 40px;">
                    <a href="produk.php" class="btn btn-primary">
                        <i class="fa-solid fa-store"></i> Jelajahi Katalog
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Sweet%20Cake,%20saya%20ingin%20memesan%20kue%20custom" target="_blank" class="btn btn-outline">
                        <i class="fa-brands fa-whatsapp"></i> Pesan Custom Cake
                    </a>
                </div>

                <!-- Live Quick Stats Bar -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; background: var(--white); padding: 20px 24px; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); border: 1px solid var(--primary-soft);">
                    <div>
                        <h4 style="font-size: 1.6rem; color: var(--primary); font-weight: 800;">50+</h4>
                        <p style="font-size: 0.85rem; color: var(--muted-text); font-weight: 600;">Varian Kue Premium</p>
                    </div>
                    <div>
                        <h4 style="font-size: 1.6rem; color: var(--primary); font-weight: 800;">10K+</h4>
                        <p style="font-size: 0.85rem; color: var(--muted-text); font-weight: 600;">Pelanggan Puas</p>
                    </div>
                    <div>
                        <h4 style="font-size: 1.6rem; color: var(--primary); font-weight: 800;">4.9 ★</h4>
                        <p style="font-size: 0.85rem; color: var(--muted-text); font-weight: 600;">Rating Penilaian</p>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-img-box">
                    <img src="uploads/produk/cheesecake.jpg" alt="Featured Cake" onerror="this.src='https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=800&q=80'">
                </div>

                <!-- Floating Interactive Badges -->
                <div class="floating-card pos-1">
                    <div class="icon-box-sm">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div>
                        <h5 style="font-size: 0.92rem; font-weight: 700; color: var(--dark-main);">Pengiriman Cepat</h5>
                        <p style="font-size: 0.78rem; color: var(--muted-text);">Dikirim Langsung Hari Ini</p>
                    </div>
                </div>

                <div class="floating-card pos-2">
                    <div class="icon-box-sm" style="background: #fff8e7; color: #ffb703;">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div>
                        <h5 style="font-size: 0.92rem; font-weight: 700; color: var(--dark-main);">100% Halal & Fresh</h5>
                        <p style="font-size: 0.78rem; color: var(--muted-text);">Bahan Higienis & Premium</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category Highlights -->
<section style="padding: 60px 0 30px;">
    <div class="container">
        <div class="section-header">
            <span class="badge badge-primary">Kategori Pilihan</span>
            <h2>Temukan Varian Rasa Favorit Anda</h2>
            <p>Pilih dari berbagai kategori hidangan manis yang diracik khusus untuk memanjakan lidah Anda.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px;">
            <a href="produk.php?kategori=Cake" style="background: var(--white); border-radius: var(--radius-lg); padding: 30px 20px; text-align: center; box-shadow: var(--shadow-sm); border: 1px solid rgba(230, 57, 70, 0.08); transition: var(--transition);">
                <div style="width: 70px; height: 70px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 20px;">
                    <i class="fa-solid fa-cake-candles"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; color: var(--dark-main);">Cake & Tart</h3>
                <p style="font-size: 0.88rem; color: var(--muted-text);">Lembut, creamy, & elegan</p>
            </a>

            <a href="produk.php?kategori=Brownies" style="background: var(--white); border-radius: var(--radius-lg); padding: 30px 20px; text-align: center; box-shadow: var(--shadow-sm); border: 1px solid rgba(230, 57, 70, 0.08); transition: var(--transition);">
                <div style="width: 70px; height: 70px; border-radius: 50%; background: #fff3e0; color: #e65100; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 20px;">
                    <i class="fa-solid fa-cookie"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; color: var(--dark-main);">Brownies Fudgy</h3>
                <p style="font-size: 0.88rem; color: var(--muted-text);">Coklat lumer & gurih</p>
            </a>

            <a href="produk.php?kategori=Donat" style="background: var(--white); border-radius: var(--radius-lg); padding: 30px 20px; text-align: center; box-shadow: var(--shadow-sm); border: 1px solid rgba(230, 57, 70, 0.08); transition: var(--transition);">
                <div style="width: 70px; height: 70px; border-radius: 50%; background: #f3e5f5; color: #8e24aa; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 20px;">
                    <i class="fa-solid fa-circle-dot"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; color: var(--dark-main);">Donat Kentang</h3>
                <p style="font-size: 0.88rem; color: var(--muted-text);">Empuk dengan aneka topping</p>
            </a>

            <a href="produk.php?kategori=Pastry" style="background: var(--white); border-radius: var(--radius-lg); padding: 30px 20px; text-align: center; box-shadow: var(--shadow-sm); border: 1px solid rgba(230, 57, 70, 0.08); transition: var(--transition);">
                <div style="width: 70px; height: 70px; border-radius: 50%; background: #e8f5e9; color: #2e7d32; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 20px;">
                    <i class="fa-solid fa-bread-slice"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 6px; color: var(--dark-main);">Pastry & Bread</h3>
                <p style="font-size: 0.88rem; color: var(--muted-text);">Renyah beraroma mentega</p>
            </a>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section style="padding: 50px 0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; flex-wrap: wrap; gap: 16px;">
            <div>
                <span class="badge badge-primary" style="margin-bottom: 8px;">Koleksi Terbaru</span>
                <h2 style="font-size: 2.2rem; color: var(--dark-main);">Produk Terfavorit Hari Ini</h2>
            </div>
            <a href="produk.php" class="btn btn-outline btn-sm">
                Lihat Semua Produk <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid-products">
            <?php if ($query && mysqli_num_rows($query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)): 
                    $gambar_path = !empty($row['gambar']) && file_exists(__DIR__ . '/uploads/produk/' . $row['gambar']) 
                        ? 'uploads/produk/' . $row['gambar'] 
                        : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=600&q=80';
                ?>
                    <div class="card-product">
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
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px; background: var(--white); border-radius: var(--radius-lg);">
                    <i class="fa-solid fa-box-open" style="font-size: 3.5rem; color: var(--muted-text); margin-bottom: 16px;"></i>
                    <p style="color: var(--muted-text); font-size: 1.1rem;">Belum ada produk yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Special Offer Banner -->
<section style="padding: 40px 0 80px;">
    <div class="container">
        <div style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); border-radius: var(--radius-lg); padding: 50px; color: var(--white); position: relative; overflow: hidden; box-shadow: var(--shadow-lg);">
            <div style="position: absolute; right: -50px; bottom: -50px; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; pointer-events: none;"></div>
            
            <div style="max-width: 600px; position: relative; z-index: 2;">
                <span class="badge" style="background: var(--secondary); color: var(--dark-main); font-weight: 800; margin-bottom: 16px;">
                    <i class="fa-solid fa-fire"></i> PROMO SPESIAL MINGGU INI
                </span>
                <h2 style="font-size: 2.8rem; margin-bottom: 16px; color: var(--white);">Diskon 20% Untuk Pembelian Brownies Fudgy & Cheese Cake!</h2>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 30px;">Gunakan kode promo <strong>SWEETRED20</strong> saat melakukan pemesanan via WhatsApp. Berlaku sampai akhir pekan ini!</p>
                <a href="produk.php" class="btn btn-secondary">
                    <i class="fa-solid fa-gift"></i> Klaim Promo Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section style="padding: 30px 0 60px; background: var(--primary-light);">
    <div class="container">
        <div class="section-header">
            <span class="badge badge-primary">Testimoni Pelanggan</span>
            <h2>Apa Kata Pecinta Kue Kami?</h2>
            <p>Kepuasan Anda adalah rasa manis kebahagiaan bagi kami.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 28px;">
            <div style="background: var(--white); padding: 30px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--glass-border);">
                <div style="color: var(--secondary); margin-bottom: 16px; font-size: 1.1rem;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p style="font-style: italic; color: var(--muted-text); margin-bottom: 20px; font-size: 0.95rem;">"Cheese cake dari Sweet Cake benar-benar paling creamy yang pernah saya rasa. Rasa kejunya melimpah dan tidak bikin enek. Anak-anak dirumah suka banget!"</p>
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800;">
                        SL
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; color: var(--dark-main);">Siti Lestari</h4>
                        <span style="font-size: 0.8rem; color: var(--muted-text);">Jakarta</span>
                    </div>
                </div>
            </div>

            <div style="background: var(--white); padding: 30px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--glass-border);">
                <div style="color: var(--secondary); margin-bottom: 16px; font-size: 1.1rem;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p style="font-style: italic; color: var(--muted-text); margin-bottom: 20px; font-size: 0.95rem;">"Brownies coklatnya luar biasa crunchy di luar dan fudgy banget di dalam. Pengirimannya cepat dan kuenya sampai dengan kondisi masih sangat rapi!"</p>
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800;">
                        RP
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; color: var(--dark-main);">Reza Pratama</h4>
                        <span style="font-size: 0.8rem; color: var(--muted-text);">Bandung</span>
                    </div>
                </div>
            </div>

            <div style="background: var(--white); padding: 30px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--glass-border);">
                <div style="color: var(--secondary); margin-bottom: 16px; font-size: 1.1rem;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p style="font-style: italic; color: var(--muted-text); margin-bottom: 20px; font-size: 0.95rem;">"Pesan via WhatsApp sangat respon cepat dan ramah! Donat kentangnya empuk banget walau sudah besoknya. Pokoknya recommended bgt!"</p>
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800;">
                        AN
                    </div>
                    <div>
                        <h4 style="font-size: 1rem; color: var(--dark-main);">Anisa Nurul</h4>
                        <span style="font-size: 0.8rem; color: var(--muted-text);">Tangerang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once __DIR__ . "/includes/footer.php"; ?>