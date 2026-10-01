<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';

// Hitung total produk
$total_produk_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk");
$data_produk = mysqli_fetch_assoc($total_produk_query);

$total_kategori_query = mysqli_query($conn, "SELECT COUNT(DISTINCT kategori) AS total FROM produk");
$data_kategori = mysqli_fetch_assoc($total_kategori_query);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sweet Cake</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #e63946;
            --primary-hover: #c1121f;
            --secondary: #ffb703;
            --accent: #fdf0ed;
            --text-dark: #1d3557;
            --text-muted: #6c757d;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.08);
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Design */
        .sidebar {
            width: 280px;
            background: var(--white);
            border-right: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 28px 24px;
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .sidebar-menu {
            list-style: none;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-grow: 1;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 14px;
            transition: var(--transition);
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--accent);
            color: var(--primary);
        }

        .sidebar-menu a.active {
            font-weight: 700;
        }

        .sidebar-footer {
            padding: 20px 16px;
            border-top: 1px solid rgba(0, 0, 0, 0.04);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            color: #dc2626;
            background: #fef2f2;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            border-radius: 12px;
            transition: var(--transition);
        }

        .btn-logout:hover {
            background: #dc2626;
            color: var(--white);
        }

        .main-wrapper {
            margin-left: 280px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .top-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            padding: 20px 40px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            sticky: top;
            top: 0;
            z-index: 90;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--accent);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .admin-info h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .admin-info p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .content-body {
            padding: 40px;
            flex-grow: 1;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #fff5f5 0%, #fdf0ed 100%);
            border-radius: var(--radius-lg);
            padding: 32px;
            margin-bottom: 32px;
            border: 1px solid rgba(230, 57, 70, 0.1);
        }

        .welcome-banner h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .welcome-banner p {
            color: var(--text-muted);
            font-size: 1rem;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .metric-card {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 28px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .metric-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .metric-icon.red { background: #ffe3e5; color: var(--primary); }
        .metric-icon.yellow { background: #fef9c3; color: #d97706; }
        .metric-icon.green { background: #dcfce7; color: #16a34a; }

        .metric-info h3 {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .metric-info .value {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        /* Action Card */
        .action-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-card-text h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .action-card-text p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            font-weight: 700;
            border-radius: 30px;
            transition: var(--transition);
            box-shadow: 0 8px 16px rgba(230, 57, 70, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(230, 57, 70, 0.3);
        }

        @media (max-width: 992px) {
            .sidebar { width: 80px; }
            .sidebar-brand span, .sidebar-menu span, .admin-info, .action-card-text p { display: none; }
            .main-wrapper { margin-left: 80px; }
            .action-card { flex-direction: column; text-align: center; gap: 16px; }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <a href="index.php" class="sidebar-brand">
            <i class="fa-solid fa-cake-candles"></i> <span>Sweet Cake</span>
        </a>

        <ul class="sidebar-menu">
            <li>
                <a href="index.php" class="active">
                    <i class="fa-solid fa-chart-pie"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="produk.php">
                    <i class="fa-solid fa-box"></i> <span>Kelola Produk</span>
                </a>
            </li>
            <li>
                <a href="../index.php" target="_blank">
                    <i class="fa-solid fa-globe"></i> <span>Lihat Website</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="logout.php" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
            </a>
        </div>
    </aside>

    <div class="main-wrapper">

        <header class="top-header">
            <div>
                <h3 style="font-size: 1.1rem; font-weight: 700;">Dashboard Panel</h3>
            </div>
            <div class="admin-profile">
                <div class="avatar">
                    <?= strtoupper(substr($_SESSION['admin_nama'] ?? 'A', 0, 1)); ?>
                </div>
                <div class="admin-info">
                    <h4><?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Administrator'); ?></h4>
                    <p>Admin Toko Kue</p>
                </div>
            </div>
        </header>

        <main class="content-body">

            <div class="welcome-banner">
                <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Admin'); ?>! 👋</h1>
                <p>Kelola data katalog produk dan pantau ringkasan statistik toko Anda dari panel ini.</p>
            </div>

            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-icon red">
                        <i class="fa-solid fa-cake-candles"></i>
                    </div>
                    <div class="metric-info">
                        <h3>Total Produk</h3>
                        <div class="value"><?= number_format($data_produk['total'] ?? 0); ?></div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon yellow">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div class="metric-info">
                        <h3>Total Kategori</h3>
                        <div class="value"><?= number_format($data_kategori['total'] ?? 0); ?></div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon green">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="metric-info">
                        <h3>Status Sistem</h3>
                        <div class="value" style="font-size: 1.3rem; color: #16a34a;">Aktif</div>
                    </div>
                </div>
            </div>

            <div class="action-card">
                <div class="action-card-text">
                    <h2>Manajemen Katalog Produk</h2>
                    <p>Tambah kue baru, ubah harga, deskripsi, atau hapus produk yang sudah tidak tersedia.</p>
                </div>
                <a href="produk.php" class="btn-primary">
                    <i class="fa-solid fa-boxes-stacked"></i> Kelola Produk
                </a>
            </div>

        </main>

    </div>

</body>

</html>