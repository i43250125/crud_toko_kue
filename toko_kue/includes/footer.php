    <!-- Floating WhatsApp Button -->
    <div class="floating-wa">
        <span class="wa-tooltip">Tanya / Pesan via WA</span>
        <a href="https://wa.me/6281234567890?text=Halo%20Sweet%20Cake,%20saya%20ingin%20bertanya%20mengenai%20produk%20kue%20Anda." target="_blank" class="wa-btn" aria-label="WhatsApp Chat">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

    <!-- Quick View / Order Modal -->
    <div class="modal-backdrop" id="productModal">
        <div class="modal-card">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <div class="modal-img-box">
                <img src="" id="modalImg" alt="Detail Produk">
            </div>
            <div class="modal-body">
                <div>
                    <span class="badge badge-primary" id="modalKategori">Kategori</span>
                    <h2 class="brand-font" id="modalNama" style="font-size: 1.8rem; margin: 12px 0 8px; color: var(--dark-main);">Nama Produk</h2>
                    <p id="modalDesc" style="color: var(--muted-text); font-size: 0.92rem; line-height: 1.5; margin-bottom: 16px;">Deskripsi singkat produk.</p>
                    
                    <div style="display: flex; align-items: center; justify-content: space-between; background: var(--primary-light); padding: 12px 16px; border-radius: var(--radius-md);">
                        <span style="font-size: 0.9rem; color: var(--muted-text); font-weight: 600;">Harga Satuan:</span>
                        <span id="modalHargaText" style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">Rp 0</span>
                    </div>

                    <div style="margin-top: 20px;">
                        <label style="font-weight: 700; font-size: 0.9rem; color: var(--dark-main);">Jumlah Pesanan:</label>
                        <div class="qty-counter">
                            <button class="qty-btn" onclick="updateQty(-1)">-</button>
                            <span class="qty-val" id="modalQty">1</span>
                            <button class="qty-btn" onclick="updateQty(1)">+</button>
                            <span style="margin-left: auto; font-size: 0.9rem; color: var(--muted-text);" id="modalStokInfo">Stok: 0</span>
                        </div>
                    </div>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; font-weight: 800; font-size: 1.1rem;">
                        <span>Total Pembayaran:</span>
                        <span id="modalTotalHarga" style="color: var(--primary-dark); font-size: 1.4rem;">Rp 0</span>
                    </div>
                    <button class="btn btn-wa" style="width: 100%; border-radius: var(--radius-md);" onclick="orderViaWA()">
                        <i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i> Pesan via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3><i class="fa-solid fa-cake-candles"></i> Sweet Cake</h3>
                    <p>Menghadirkan kelezatan kue manis premium buatan tangan dengan bahan-bahan organik berkualitas tinggi untuk setiap momen istimewa Anda.</p>
                    <div class="social-links">
                        <a href="#" class="social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-icon" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#" class="social-icon" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="index.php"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i> Beranda</a></li>
                        <li><a href="produk.php"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i> Katalog Produk</a></li>
                        <li><a href="tentang.php"><i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i> Tentang Kami</a></li>
                        <li><a href="auth/login.php"><i class="fa-solid fa-lock" style="font-size: 0.75rem;"></i> Portal Admin</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Kategori</h4>
                    <ul>
                        <li><a href="produk.php?kategori=Cake">Cake & Tart</a></li>
                        <li><a href="produk.php?kategori=Brownies">Brownies Fudgy</a></li>
                        <li><a href="produk.php?kategori=Donat">Donat Kentang</a></li>
                        <li><a href="produk.php?kategori=Pastry">Pastry & Cookies</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Kontak & Jam Buka</h4>
                    <ul style="gap: 14px;">
                        <li style="display: flex; gap: 10px; color: #b59f9f; font-size: 0.95rem;">
                            <i class="fa-solid fa-location-dot" style="color: var(--primary); margin-top: 4px;"></i>
                            <span>Jl. Mawar Indah No. 88, Jakarta Selatan</span>
                        </li>
                        <li style="display: flex; gap: 10px; color: #b59f9f; font-size: 0.95rem;">
                            <i class="fa-solid fa-phone" style="color: var(--primary); margin-top: 4px;"></i>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li style="display: flex; gap: 10px; color: #b59f9f; font-size: 0.95rem;">
                            <i class="fa-solid fa-clock" style="color: var(--primary); margin-top: 4px;"></i>
                            <span>Buka Setiap Hari: 08.00 - 21.00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; <?= date('Y'); ?> <strong>Sweet Cake</strong>. Hak Cipta Dilindungi. Dibuat dengan <i class="fa-solid fa-heart" style="color: var(--primary);"></i> untuk Pecinta Kue.</p>
            </div>
        </div>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        // Mobile Navigation Toggle
        const menuBtn = document.getElementById('menuBtn');
        const navMenu = document.getElementById('navMenu');
        if (menuBtn && navMenu) {
            menuBtn.addEventListener('click', () => {
                navMenu.classList.toggle('show');
            });
        }

        // Modal State & Functions
        let activeProduct = {
            id: null,
            nama: '',
            harga: 0,
            stok: 0,
            qty: 1
        };

        function openModal(id, nama, kategori, deskripsi, harga, stok, gambar) {
            activeProduct = { id, nama, harga: parseFloat(harga), stok: parseInt(stok), qty: 1 };
            
            document.getElementById('modalNama').textContent = nama;
            document.getElementById('modalKategori').textContent = kategori || 'Koleksi Kue';
            document.getElementById('modalDesc').textContent = deskripsi || 'Resep lezat buatan tangan dengan bahan premium pilihan.';
            document.getElementById('modalHargaText').textContent = 'Rp ' + activeProduct.harga.toLocaleString('id-ID');
            document.getElementById('modalImg').src = gambar;
            document.getElementById('modalStokInfo').textContent = 'Stok: ' + stok;
            
            updateModalTotals();
            document.getElementById('productModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
        }

        function updateQty(delta) {
            let newQty = activeProduct.qty + delta;
            if (newQty >= 1 && (activeProduct.stok === 0 || newQty <= activeProduct.stok)) {
                activeProduct.qty = newQty;
                updateModalTotals();
            }
        }

        function updateModalTotals() {
            document.getElementById('modalQty').textContent = activeProduct.qty;
            let total = activeProduct.harga * activeProduct.qty;
            document.getElementById('modalTotalHarga').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        function orderViaWA() {
            let total = activeProduct.harga * activeProduct.qty;
            let text = `Halo Sweet Cake, saya ingin memesan:\n` +
                       `🍰 *${activeProduct.nama}*\n` +
                       `🔢 Jumlah: ${activeProduct.qty} pax\n` +
                       `💰 Total Harga: Rp ${total.toLocaleString('id-ID')}\n\n` +
                       `Mohon konfirmasi ketersediaan dan metode pengirimannya. Terima kasih!`;
            let url = `https://wa.me/6281234567890?text=${encodeURIComponent(text)}`;
            window.open(url, '_blank');
        }

        // Close Modal on backdrop click
        const productModal = document.getElementById('productModal');
        if (productModal) {
            productModal.addEventListener('click', (e) => {
                if (e.target === productModal) {
                    closeModal();
                }
            });
        }
    </script>
</body>
</html>
