<?php

session_start();

require_once "../includes/auth.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk - Sweet Cake Admin</title>

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

        /* ==============================
           SIDEBAR
        ============================== */

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

        /* ==============================
           MAIN
        ============================== */

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
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .top-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
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

        /* ==============================
           PAGE HEADER
        ============================== */

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

        .page-header p {
            margin-top: 6px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* ==============================
           FORM CARD
        ============================== */

        .form-card {
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 32px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.04);
            max-width: 900px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .required {
            color: var(--primary);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
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
            box-shadow: 0 0 0 3px rgba(230, 57, 70, 0.08);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
        }

        select.form-control {
            cursor: pointer;
        }

        /* ==============================
           FILE INPUT
        ============================== */

        .file-wrapper {
            position: relative;
        }

        .file-input {
            width: 100%;
            padding: 11px;
            border: 1.5px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.85rem;
        }

        .file-input:hover {
            border-color: var(--primary);
            background: var(--accent);
        }

        .file-info {
            margin-top: 7px;
            color: var(--text-muted);
            font-size: 0.75rem;
        }

        /* ==============================
           BUTTON
        ============================== */

        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: var(--primary);
            color: var(--white);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            border-radius: 12px;
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

        .btn-secondary {
            padding: 12px 22px;
            background: #e2e8f0;
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 12px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 992px) {

            .sidebar {
                width: 80px;
            }

            .sidebar-brand span,
            .sidebar-menu span,
            .admin-info {
                display: none;
            }

            .main-wrapper {
                margin-left: 80px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }
        }

        @media (max-width: 600px) {

            .content-body {
                padding: 20px;
            }

            .top-header {
                padding: 16px 20px;
            }

            .form-card {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
            }
        }

    </style>

</head>

<body>

    <!-- ==============================
         SIDEBAR
    ============================== -->

    <aside class="sidebar">

        <a href="index.php" class="sidebar-brand">
            <i class="fa-solid fa-cake-candles"></i>
            <span>Sweet Cake</span>
        </a>

        <ul class="sidebar-menu">

            <li>
                <a href="index.php">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="produk.php" class="active">
                    <i class="fa-solid fa-box"></i>
                    <span>Kelola Produk</span>
                </a>
            </li>

            <li>
                <a href="../index.php" target="_blank">
                    <i class="fa-solid fa-globe"></i>
                    <span>Lihat Website</span>
                </a>
            </li>

        </ul>

        <div class="sidebar-footer">

            <a href="logout.php" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>

        </div>

    </aside>


    <!-- ==============================
         MAIN CONTENT
    ============================== -->

    <div class="main-wrapper">

        <!-- TOP HEADER -->

        <header class="top-header">

            <div>
                <h3>Manajemen Produk</h3>
            </div>

            <div class="admin-profile">

                <div class="avatar">
                    <?= strtoupper(substr($_SESSION['admin_nama'] ?? 'A', 0, 1)); ?>
                </div>

                <div class="admin-info">

                    <h4>
                        <?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Administrator'); ?>
                    </h4>

                    <p>Admin Toko Kue</p>

                </div>

            </div>

        </header>


        <!-- CONTENT -->

        <main class="content-body">

            <div class="page-header">

                <div>

                    <h1>Tambah Produk</h1>

                    <p>
                        Tambahkan produk baru ke dalam daftar produk Sweet Cake.
                    </p>

                </div>

            </div>


            <!-- FORM CARD -->

            <div class="form-card">

                <form
                    action="proses_produk.php"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    <input
                        type="hidden"
                        name="aksi"
                        value="tambah"
                    >


                    <div class="form-grid">

                        <!-- NAMA -->

                        <div class="form-group full">

                            <label for="nama">
                                Nama Produk
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="form-control"
                                placeholder="Masukkan nama produk"
                                required
                            >

                        </div>


                        <!-- KATEGORI -->

                        <div class="form-group">

                            <label for="kategori">
                                Kategori
                                <span class="required">*</span>
                            </label>

                            <select
                                name="kategori"
                                id="kategori"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    Pilih kategori
                                </option>

                                <option value="Cake">
                                    Cake
                                </option>

                                <option value="Brownies">
                                    Brownies
                                </option>

                                <option value="Donat">
                                    Donat
                                </option>

                            </select>

                        </div>


                        <!-- HARGA -->

                        <div class="form-group">

                            <label for="harga">
                                Harga
                                <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                id="harga"
                                name="harga"
                                class="form-control"
                                min="0"
                                placeholder="Contoh: 50000"
                                required
                            >

                        </div>


                        <!-- STOK -->

                        <div class="form-group">

                            <label for="stok">
                                Stok
                                <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                id="stok"
                                name="stok"
                                class="form-control"
                                min="0"
                                placeholder="Jumlah stok"
                                required
                            >

                        </div>


                        <!-- GAMBAR -->

                        <div class="form-group">

                            <label for="gambar">
                                Gambar Produk
                            </label>

                            <div class="file-wrapper">

                                <input
                                    type="file"
                                    id="gambar"
                                    name="gambar"
                                    class="file-input"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                            </div>

                            <div class="file-info">
                                Format: JPG, JPEG, PNG atau WEBP
                            </div>

                        </div>


                        <!-- DESKRIPSI -->

                        <div class="form-group full">

                            <label for="deskripsi">
                                Deskripsi
                                <span class="required">*</span>
                            </label>

                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                class="form-control"
                                rows="5"
                                placeholder="Masukkan deskripsi produk..."
                                required
                            ></textarea>

                        </div>

                    </div>


                    <!-- ACTION BUTTON -->

                    <div class="form-actions">

                        <button
                            type="submit"
                            class="btn-primary"
                        >

                            <i class="fa-solid fa-floppy-disk"></i>

                            Simpan Produk

                        </button>


                        <a
                            href="produk.php"
                            class="btn-secondary"
                        >

                            <i class="fa-solid fa-arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </main>

    </div>

</body>

</html>
