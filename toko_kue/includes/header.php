<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' - Sweet Cake' : 'Sweet Cake - Toko Kue Lezat & Premium'; ?></title>
    
    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <!-- Header & Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="brand">
                <i class="fa-solid fa-cake-candles"></i>
                <span>Sweet Cake</span>
            </a>

            <ul class="nav-links" id="navMenu">
                <li>
                    <a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li>
                    <a href="produk.php" class="<?= $current_page == 'produk.php' || $current_page == 'detail.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-store"></i> Katalog Produk
                    </a>
                </li>
                <li>
                    <a href="tentang.php" class="<?= $current_page == 'tentang.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-circle-info"></i> Tentang Kami
                    </a>
                </li>
            </ul>

            <div class="nav-actions">
                <a href="produk.php" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-bag-shopping"></i> Pesan Sekarang
                </a>
                <button class="mobile-toggle" id="menuBtn" aria-label="Menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>
