<?php
$page_title = "Tentang Kami - Sweet Cake";
include_once __DIR__ . '/includes/header.php';
?>

<!-- Header Banner -->
<section style="background: linear-gradient(135deg, #fff5f5 0%, #ffe3e5 100%); padding: 70px 0; border-radius: 0 0 50px 50px; text-align: center;">
    <div class="container">
        <span class="badge badge-primary" style="margin-bottom: 14px;">
            <i class="fa-solid fa-heart" style="color: var(--primary);"></i> Cerita & Autentisitas
        </span>
        <h1 style="font-size: 3.2rem; color: var(--dark-main); margin-bottom: 16px;">Mengenal Lebih Dekat Sweet Cake</h1>
        <p style="color: var(--muted-text); font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">
            Dedikasi kami dalam menghadirkan kelezatan kue berkualitas tinggi dari resep rahasia keluarga sejak tahun 2018.
        </p>
    </div>
</section>

<!-- Brand Story & Values -->
<section style="padding: 80px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div style="position: relative;">
                <div style="border-radius: 30px; overflow: hidden; box-shadow: var(--shadow-lg); border: 8px solid var(--white);">
                    <img src="uploads/produk/brownies.jpg" alt="Dapur Sweet Cake" style="width: 100%; height: 440px; object-fit: cover; display: block;" onerror="this.src='https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=800&q=80'">
                </div>
                <div style="position: absolute; bottom: -20px; right: -20px; background: var(--primary); color: var(--white); padding: 24px 30px; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                    <h3 style="font-size: 2.2rem; font-weight: 800; font-family: 'Playfair Display', serif;">6+ Tahun</h3>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Pengalaman Memanggang</p>
                </div>
            </div>

            <div>
                <span class="badge badge-primary" style="margin-bottom: 12px;">Filosofi Kami</span>
                <h2 style="font-size: 2.6rem; color: var(--dark-main); margin-bottom: 20px; font-family: 'Playfair Display', serif;">
                    Dibuat Sepenuh Hati, Disajikan Dengan Cinta
                </h2>
                <p style="color: var(--muted-text); line-height: 1.8; margin-bottom: 24px; font-size: 1.05rem;">
                    <strong>Sweet Cake</strong> lahir dari kecintaan kami akan kelezatan kue buatan rumah yang lembut, harum, dan autentik. Setiap kue dipanggang dengan standar kebersihan tertinggi menggunakan mentega murni, coklat belgia, dan buah-buahan segar tanpa bahan pengawet sintetis.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="background: var(--white); padding: 20px; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); border-left: 4px solid var(--primary);">
                        <h4 style="font-size: 1.1rem; color: var(--dark-main); margin-bottom: 6px;">100% Organik</h4>
                        <p style="font-size: 0.88rem; color: var(--muted-text);">Bahan-bahan alami tanpa pemanis buatan.</p>
                    </div>
                    <div style="background: var(--white); padding: 20px; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); border-left: 4px solid var(--secondary);">
                        <h4 style="font-size: 1.1rem; color: var(--dark-main); margin-bottom: 6px;">Resep Autentik</h4>
                        <p style="font-size: 0.88rem; color: var(--muted-text);">Formulasi rahasia chef pastry berlisensi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Baking Process -->
<section style="padding: 70px 0; background: var(--primary-light);">
    <div class="container">
        <div class="section-header">
            <span class="badge badge-primary">Proses Pembuatan</span>
            <h2>Bagaimana Kami Menciptakan Kelezatan Terbaik</h2>
            <p>Empat tahapan utama untuk memastikan setiap pesanan kue Anda terasa sempurna.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 28px;">
            <div style="background: var(--white); padding: 32px 24px; border-radius: var(--radius-lg); text-align: center; box-shadow: var(--shadow-sm); position: relative;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary); color: var(--white); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 20px;">
                    1
                </div>
                <h3 style="font-size: 1.2rem; color: var(--dark-main); margin-bottom: 10px;">Seleksi Bahan</h3>
                <p style="font-size: 0.9rem; color: var(--muted-text);">Memilih telur segar, mentega murni, dan bahan impor berkualitas teratas setiap pagi.</p>
            </div>

            <div style="background: var(--white); padding: 32px 24px; border-radius: var(--radius-lg); text-align: center; box-shadow: var(--shadow-sm); position: relative;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary); color: var(--white); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 20px;">
                    2
                </div>
                <h3 style="font-size: 1.2rem; color: var(--dark-main); margin-bottom: 10px;">Pencampuran Presisi</h3>
                <p style="font-size: 0.9rem; color: var(--muted-text);">Mengaduk adonan dengan rasio timbangan mikro untuk tekstur lembut konsisten.</p>
            </div>

            <div style="background: var(--white); padding: 32px 24px; border-radius: var(--radius-lg); text-align: center; box-shadow: var(--shadow-sm); position: relative;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary); color: var(--white); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 20px;">
                    3
                </div>
                <h3 style="font-size: 1.2rem; color: var(--dark-main); margin-bottom: 10px;">Pemanggangan Oven</h3>
                <p style="font-size: 0.9rem; color: var(--muted-text);">Dipanggang pada suhu terukur hingga matang sempurna dan harum menggugah selera.</p>
            </div>

            <div style="background: var(--white); padding: 32px 24px; border-radius: var(--radius-lg); text-align: center; box-shadow: var(--shadow-sm); position: relative;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary); color: var(--white); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; margin: 0 auto 20px;">
                    4
                </div>
                <h3 style="font-size: 1.2rem; color: var(--dark-main); margin-bottom: 10px;">Hiasan & Pengemasan</h3>
                <p style="font-size: 0.9rem; color: var(--muted-text);">Dihias indah oleh pastry chef kami dan dikemas rapat untuk menjaga kesegaran.</p>
            </div>
        </div>
    </div>
</section>

<!-- Location & Contact Info Section -->
<section style="padding: 80px 0;">
    <div class="container">
        <div style="background: var(--white); border-radius: var(--radius-lg); padding: 40px; box-shadow: var(--shadow-md); border: 1px solid var(--glass-border); display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
            <div>
                <span class="badge badge-primary" style="margin-bottom: 12px;">Kunjungi Outlet Kami</span>
                <h2 style="font-size: 2.2rem; color: var(--dark-main); margin-bottom: 16px; font-family: 'Playfair Display', serif;">
                    Siap Melayani Pesanan Anda Setiap Hari
                </h2>
                <p style="color: var(--muted-text); margin-bottom: 28px; line-height: 1.7;">
                    Datang langsung ke toko kami untuk menikmati aroma harum kue segar atau lakukan pemesanan secara online via WhatsApp untuk pengiriman kilat area Jabodetabek.
                </p>

                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="display: flex; gap: 16px; align-items: center;">
                        <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; color: var(--dark-main);">Alamat Outlet:</h4>
                            <p style="font-size: 0.9rem; color: var(--muted-text);">Jl. Mawar Indah No. 88, Kebayoran Baru, Jakarta Selatan</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 16px; align-items: center;">
                        <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1rem; color: var(--dark-main);">Telepon / WhatsApp:</h4>
                            <p style="font-size: 0.9rem; color: var(--muted-text);">+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 32px;">
                    <a href="https://wa.me/6281234567890?text=Halo%20Sweet%20Cake,%20saya%20ingin%20bertanya" target="_blank" class="btn btn-wa">
                        <i class="fa-brands fa-whatsapp"></i> Hubungi Customer Support
                    </a>
                </div>
            </div>

            <div style="border-radius: var(--radius-md); overflow: hidden; height: 360px; background: #e2e8f0; position: relative;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.290514658145!2d106.801648!3d-6.225387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d3ca75471%3A0xe5435943b8117765!2sKabayoran%20Baru!5e0!3m2!1sid!2sid!4v1680000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

<?php include_once __DIR__ . '/includes/footer.php'; ?>