<?php
session_start();
require_once "../includes/auth.php";
require_once "../config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    header("Location: produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Sweet Cake Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body style="background: var(--light-bg); padding: 40px 0;">

<div class="container" style="max-width: 680px;">
    <div style="background: var(--white); border-radius: var(--radius-lg); padding: 40px; box-shadow: var(--shadow-md); border: 1px solid var(--glass-border);">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; border-bottom: 1px solid #eee; padding-bottom: 20px;">
            <div>
                <h1 style="font-size: 1.8rem; color: var(--dark-main); font-weight: 700;">Edit Produk</h1>
                <p style="font-size: 0.9rem; color: var(--muted-text);">Perbarui informasi data kue #<?= $produk['id']; ?></p>
            </div>
            <a href="produk.php" class="btn btn-outline btn-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <?php include "../includes/flash.php"; ?>

        <form action="proses_produk.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="edit">
            <input type="hidden" name="id" value="<?= $produk['id']; ?>">

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 700; font-size: 0.88rem; color: var(--dark-main);">Nama Produk</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($produk['nama']); ?>" required style="margin-top: 6px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 700; font-size: 0.88rem; color: var(--dark-main);">Kategori</label>
                <select name="kategori" required style="margin-top: 6px;">
                    <option value="Cake" <?= $produk['kategori'] == 'Cake' ? 'selected' : ''; ?>>Cake & Tart</option>
                    <option value="Brownies" <?= $produk['kategori'] == 'Brownies' ? 'selected' : ''; ?>>Brownies</option>
                    <option value="Donat" <?= $produk['kategori'] == 'Donat' ? 'selected' : ''; ?>>Donat</option>
                    <option value="Pastry" <?= $produk['kategori'] == 'Pastry' ? 'selected' : ''; ?>>Pastry</option>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: 700; font-size: 0.88rem; color: var(--dark-main);">Deskripsi Produk</label>
                <textarea name="deskripsi" rows="4" required style="margin-top: 6px;"><?= htmlspecialchars($produk['deskripsi']); ?></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="font-weight: 700; font-size: 0.88rem; color: var(--dark-main);">Harga (Rp)</label>
                    <input type="number" name="harga" value="<?= $produk['harga']; ?>" required style="margin-top: 6px;">
                </div>
                <div>
                    <label style="font-weight: 700; font-size: 0.88rem; color: var(--dark-main);">Jumlah Stok</label>
                    <input type="number" name="stok" value="<?= $produk['stok']; ?>" required style="margin-top: 6px;">
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="font-weight: 700; font-size: 0.88rem; color: var(--dark-main);">Ganti Gambar (Opsional)</label>
                <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp" style="margin-top: 6px;">

                <?php if ($produk['gambar']): 
                    $gambar_path = file_exists(__DIR__ . '/../uploads/produk/' . $produk['gambar'])
                        ? '../uploads/produk/' . $produk['gambar']
                        : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=300&q=80';
                ?>
                    <div style="margin-top: 12px;">
                        <p style="font-size: 0.85rem; color: var(--muted-text); margin-bottom: 6px;">Gambar Saat Ini:</p>
                        <img src="<?= $gambar_path; ?>" alt="Gambar Produk" style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 2px solid var(--primary-soft);">
                    </div>
                <?php endif; ?>
            </div>

            <div style="display: flex; gap: 14px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
                <a href="produk.php" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>