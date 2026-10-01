    <?php

    session_start();

    require_once __DIR__ . "/../includes/auth.php";
    require_once __DIR__ . "/../config/database.php";

    $keyword = $_GET['keyword'] ?? '';
    $kategori = $_GET['kategori'] ?? '';

    $where = [];

    if ($keyword != '') {
        $keyword_safe = mysqli_real_escape_string($conn, $keyword);
        $where[] = "nama LIKE '%$keyword_safe%'";
    }

    if ($kategori != '') {
        $kategori_safe = mysqli_real_escape_string($conn, $kategori);
        $where[] = "kategori = '$kategori_safe'";
    }

    $where_sql = "";

    if (count($where) > 0) {
        $where_sql = "WHERE " . implode(" AND ", $where);
    }

    /*
    |--------------------------------------------------------------------------
    | PAGINATION
    |--------------------------------------------------------------------------
    */

    $per_page = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    if ($page < 1) {
        $page = 1;
    }

    $offset = ($page - 1) * $per_page;

    $count_query = mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total 
        FROM produk
        $where_sql"
    );

    $count_data = mysqli_fetch_assoc($count_query);
    $total_data = $count_data['total'];
    $total_page = ceil($total_data / $per_page);

    $query = mysqli_query(
        $conn,
        "SELECT * FROM produk
        $where_sql
        ORDER BY id DESC
        LIMIT $per_page OFFSET $offset"
    );

    ?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kelola Produk - Sweet Cake Admin</title>

        <!-- Google Fonts & Font Awesome Icons -->
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

            /* Sidebar Styling */
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

            /* Main Content Layout */
            .main-wrapper {
                margin-left: 280px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            /* Top Header */
            .top-header {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(12px);
                padding: 20px 40px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: sticky;
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

            /* Action & Filter Section */
            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 28px;
                flex-wrap: wrap;
                gap: 16px;
            }

            .page-header h1 {
                font-family: 'Playfair Display', serif;
                font-size: 2rem;
                color: var(--text-dark);
            }

            .btn-primary {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 12px 24px;
                background: var(--primary);
                color: var(--white);
                text-decoration: none;
                font-weight: 700;
                font-size: 0.9rem;
                border-radius: 30px;
                transition: var(--transition);
                box-shadow: 0 8px 16px rgba(230, 57, 70, 0.2);
                border: none;
                cursor: pointer;
            }

            .btn-primary:hover {
                background: var(--primary-hover);
                transform: translateY(-2px);
                box-shadow: 0 12px 20px rgba(230, 57, 70, 0.3);
            }

            .filter-card {
                background: var(--white);
                border-radius: var(--radius-md);
                padding: 24px;
                box-shadow: var(--shadow-sm);
                border: 1px solid rgba(0, 0, 0, 0.04);
                margin-bottom: 28px;
            }

            .filter-form {
                display: flex;
                gap: 16px;
                align-items: flex-end;
                flex-wrap: wrap;
            }

            .filter-group {
                flex: 1;
                min-width: 200px;
            }

            .filter-group label {
                display: block;
                font-size: 0.8rem;
                font-weight: 700;
                color: var(--text-dark);
                margin-bottom: 6px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .form-control {
                width: 100%;
                padding: 10px 16px;
                border: 1.5px solid #e2e8f0;
                border-radius: 12px;
                font-family: inherit;
                font-size: 0.9rem;
                color: var(--text-dark);
                background-color: #f8fafc;
                outline: none;
                transition: var(--transition);
            }

            .form-control:focus {
                border-color: var(--primary);
                background-color: var(--white);
            }

            .btn-secondary {
                padding: 10px 20px;
                background: #e2e8f0;
                color: var(--text-dark);
                text-decoration: none;
                font-weight: 600;
                font-size: 0.9rem;
                border-radius: 12px;
                transition: var(--transition);
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .btn-secondary:hover {
                background: #cbd5e1;
            }

            /* Table Design */
            .table-card {
                background: var(--white);
                border-radius: var(--radius-md);
                box-shadow: var(--shadow-sm);
                border: 1px solid rgba(0, 0, 0, 0.04);
                overflow: hidden;
                margin-bottom: 28px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }

            th {
                background: #f8fafc;
                padding: 16px 20px;
                font-size: 0.8rem;
                font-weight: 700;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-bottom: 1px solid #e2e8f0;
            }

            td {
                padding: 16px 20px;
                border-bottom: 1px solid #f1f5f9;
                vertical-align: middle;
                font-size: 0.9rem;
            }

            tr:last-child td {
                border-bottom: none;
            }

            tr:hover td {
                background: #fdf0ed40;
            }

            .product-img {
                width: 56px;
                height: 56px;
                border-radius: 12px;
                object-fit: cover;
                border: 1px solid #e2e8f0;
            }

            .no-img {
                width: 56px;
                height: 56px;
                border-radius: 12px;
                background: #f1f5f9;
                color: var(--text-muted);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.75rem;
                font-weight: 600;
            }

            .badge-category {
                background: var(--accent);
                color: var(--primary);
                padding: 4px 12px;
                border-radius: 20px;
                font-weight: 700;
                font-size: 0.8rem;
                display: inline-block;
            }

            /* Table Action Buttons */
            .action-btns {
                display: flex;
                gap: 8px;
            }

            .btn-sm {
                padding: 8px 14px;
                border-radius: 8px;
                font-size: 0.8rem;
                font-weight: 600;
                text-decoration: none;
                transition: var(--transition);
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }

            .btn-warning {
                background: #fef3c7;
                color: #d97706;
            }

            .btn-warning:hover {
                background: #fde68a;
            }

            .btn-danger {
                background: #fef2f2;
                color: #dc2626;
            }

            .btn-danger:hover {
                background: #fee2e2;
            }

            /* Pagination Design */
            .pagination {
                display: flex;
                justify-content: center;
                gap: 8px;
                margin-top: 20px;
            }

            .pagination a {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: var(--white);
                color: var(--text-dark);
                text-decoration: none;
                font-weight: 700;
                font-size: 0.9rem;
                border: 1px solid #e2e8f0;
                transition: var(--transition);
            }

            .pagination a:hover,
            .pagination a.active {
                background: var(--primary);
                color: var(--white);
                border-color: var(--primary);
            }

            /* Responsive Design */
            @media (max-width: 992px) {
                .sidebar { width: 80px; }
                .sidebar-brand span, .sidebar-menu span, .admin-info { display: none; }
                .main-wrapper { margin-left: 80px; }
            }
        </style>
    </head>

    <body>

        <!-- Sidebar Menu Navigasi -->
        <aside class="sidebar">
            <a href="index.php" class="sidebar-brand">
                <i class="fa-solid fa-cake-candles"></i> <span>Sweet Cake</span>
            </a>

            <ul class="sidebar-menu">
                <li>
                    <a href="index.php">
                        <i class="fa-solid fa-chart-pie"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="produk.php" class="active">
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

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">

            <!-- Top Header Navigation -->
            <header class="top-header">
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 700;">Manajemen Produk</h3>
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

            <!-- Main Body Content -->
            <main class="content-body">

                <!-- Page Title & Add Button -->
                <div class="page-header">
                    <h1>Daftar Produk</h1>
                    <a href="tambah.php" class="btn-primary">
                        <i class="fa-solid fa-plus"></i> Tambah Produk Baru
                    </a>
                </div>

                <!-- Flash Message Notification -->
                <?php include "../includes/flash.php"; ?>

                <!-- Search & Filter Card -->
                <div class="filter-card">
                    <form method="GET" class="filter-form">
                        <div class="filter-group">
                            <label for="keyword">Cari Produk</label>
                            <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Masukkan nama produk..." value="<?= htmlspecialchars($keyword); ?>">
                        </div>

                        <div class="filter-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Semua Kategori</option>
                                <option value="Cake" <?= $kategori == 'Cake' ? 'selected' : ''; ?>>Cake</option>
                                <option value="Brownies" <?= $kategori == 'Brownies' ? 'selected' : ''; ?>>Brownies</option>
                                <option value="Donat" <?= $kategori == 'Donat' ? 'selected' : ''; ?>>Donat</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-primary" style="padding: 10px 20px; border-radius: 12px;">
                            <i class="fa-solid fa-magnifying-glass"></i> Cari
                        </button>

                        <a href="produk.php" class="btn-secondary">
                            <i class="fa-solid fa-rotate-left"></i> Reset
                        </a>
                    </form>
                </div>

                <!-- Table Products Card -->
                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th width="90">Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th width="160">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = $offset + 1;
                            if (mysqli_num_rows($query) > 0):
                                while ($row = mysqli_fetch_assoc($query)): 
                            ?>
                                <tr>
                                    <td><strong><?= $no++; ?></strong></td>
                                    <td>
                                        <?php if ($row['gambar']): ?>
                                            <img src="../uploads/produk/<?= htmlspecialchars($row['gambar']); ?>" alt="Foto Produk" class="product-img">
                                        <?php else: ?>
                                            <div class="no-img">No Image</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong style="color: var(--text-dark); font-size: 0.95rem;"><?= htmlspecialchars($row['nama']); ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge-category"><?= htmlspecialchars($row['kategori']); ?></span>
                                    </td>
                                    <td>
                                        <strong style="color: var(--primary);">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></strong>
                                    </td>
                                    <td>
                                        <?= $row['stok']; ?> unit
                                    </td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn-sm btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </a>
                                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                                endwhile; 
                            else: 
                            ?>
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                        <i class="fa-solid fa-box-open" style="font-size: 2.5rem; margin-bottom: 12px; display: block; opacity: 0.5;"></i>
                                        Tidak ada data produk yang ditemukan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <?php if ($total_page > 1): ?>
                    <div class="pagination">
                        <?php for ($i = 1; $i <= $total_page; $i++): ?>
                            <a href="?page=<?= $i; ?>&keyword=<?= urlencode($keyword); ?>&kategori=<?= urlencode($kategori); ?>" class="<?= $page == $i ? 'active' : ''; ?>">
                                <?= $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

            </main>

        </div>

    </body>

    </html>