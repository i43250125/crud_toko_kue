<?php

require_once __DIR__ . '/../config/database.php';

/*
|--------------------------------------------------------------------------
| DATA ADMIN
|--------------------------------------------------------------------------
*/

$nama = "Administrator";
$username = "admin";
$password = "admin123";

$berhasil = false;
$sudahAda = false;
$error = "";


/*
|--------------------------------------------------------------------------
| CEK DATABASE
|--------------------------------------------------------------------------
*/

if (!$conn) {
    $error = "Koneksi database gagal.";
} else {

    /*
    |--------------------------------------------------------------------------
    | CEK APAKAH USERNAME SUDAH ADA
    |--------------------------------------------------------------------------
    */

    $cek = mysqli_prepare(
        $conn,
        "SELECT id FROM admin WHERE username = ? LIMIT 1"
    );

    if (!$cek) {

        $error = "Gagal melakukan pengecekan username.";

    } else {

        mysqli_stmt_bind_param(
            $cek,
            "s",
            $username
        );

        mysqli_stmt_execute($cek);

        mysqli_stmt_store_result($cek);

        if (mysqli_stmt_num_rows($cek) > 0) {

            $sudahAda = true;

        } else {

            /*
            |--------------------------------------------------------------------------
            | HASH PASSWORD
            |--------------------------------------------------------------------------
            */

            $password_hash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            /*
            |--------------------------------------------------------------------------
            | INSERT ADMIN
            |--------------------------------------------------------------------------
            */

            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO admin (nama, username, password)
                 VALUES (?, ?, ?)"
            );

            if (!$stmt) {

                $error = "Gagal menyiapkan data admin.";

            } else {

                mysqli_stmt_bind_param(
                    $stmt,
                    "sss",
                    $nama,
                    $username,
                    $password_hash
                );


                if (mysqli_stmt_execute($stmt)) {

                    $berhasil = true;

                } else {

                    $error = "Gagal membuat admin: " .
                             mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            }
        }

        mysqli_stmt_close($cek);
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Buat Admin - Sweet Cake</title>


    <!-- GOOGLE FONT -->

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >


    <!-- FONT AWESOME -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {

            font-family: 'Plus Jakarta Sans', sans-serif;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #fff5f3 0%,
                    #ffffff 50%,
                    #fff8ef 100%
                );

            color: #1d3557;

        }


        /*
        |--------------------------------------------------------------------------
        | BACKGROUND DECORATION
        |--------------------------------------------------------------------------
        */

        .background-circle {

            position: fixed;

            width: 300px;

            height: 300px;

            border-radius: 50%;

            background: rgba(230, 57, 70, 0.06);

            top: -100px;

            left: -100px;

        }


        .background-circle-2 {

            position: fixed;

            width: 350px;

            height: 350px;

            border-radius: 50%;

            background: rgba(255, 183, 3, 0.08);

            bottom: -150px;

            right: -100px;

        }


        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .admin-card {

            position: relative;

            z-index: 10;

            width: 100%;

            max-width: 520px;

            margin: 30px;

            padding: 42px;

            background: #ffffff;

            border-radius: 24px;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.08);

            border: 1px solid rgba(0, 0, 0, 0.04);

        }


        /*
        |--------------------------------------------------------------------------
        | LOGO
        |--------------------------------------------------------------------------
        */

        .logo {

            text-align: center;

            margin-bottom: 30px;

        }


        .logo-icon {

            width: 70px;

            height: 70px;

            margin: 0 auto 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 20px;

            background: #fdf0ed;

            color: #e63946;

            font-size: 30px;

        }


        .logo h1 {

            font-family: 'Playfair Display', serif;

            font-size: 30px;

            color: #e63946;

            margin-bottom: 5px;

        }


        .logo p {

            color: #6c757d;

            font-size: 13px;

        }


        /*
        |--------------------------------------------------------------------------
        | TITLE
        |--------------------------------------------------------------------------
        */

        .page-title {

            text-align: center;

            margin-bottom: 25px;

        }


        .page-title h2 {

            font-size: 20px;

            color: #1d3557;

            margin-bottom: 7px;

        }


        .page-title p {

            font-size: 13px;

            color: #6c757d;

            line-height: 1.6;

        }


        /*
        |--------------------------------------------------------------------------
        | ALERT
        |--------------------------------------------------------------------------
        */

        .alert {

            padding: 18px;

            border-radius: 14px;

            margin-bottom: 20px;

            display: flex;

            gap: 14px;

            align-items: flex-start;

        }


        .alert-icon {

            width: 40px;

            height: 40px;

            min-width: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            font-size: 17px;

        }


        .alert h3 {

            font-size: 15px;

            margin-bottom: 6px;

        }


        .alert p {

            font-size: 13px;

            line-height: 1.6;

        }


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        .alert-success {

            background: #ecfdf3;

            border: 1px solid #a7f3d0;

            color: #065f46;

        }


        .alert-success .alert-icon {

            background: #d1fae5;

            color: #059669;

        }


        /*
        |--------------------------------------------------------------------------
        | WARNING
        |--------------------------------------------------------------------------
        */

        .alert-warning {

            background: #fff8e1;

            border: 1px solid #ffe082;

            color: #795500;

        }


        .alert-warning .alert-icon {

            background: #ffecb3;

            color: #f59e0b;

        }


        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        .alert-error {

            background: #fff1f2;

            border: 1px solid #fecdd3;

            color: #9f1239;

        }


        .alert-error .alert-icon {

            background: #ffe4e6;

            color: #e11d48;

        }


        /*
        |--------------------------------------------------------------------------
        | ACCOUNT INFORMATION
        |--------------------------------------------------------------------------
        */

        .account-info {

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            border-radius: 15px;

            padding: 20px;

            margin-top: 18px;

            margin-bottom: 22px;

        }


        .account-info-title {

            font-size: 13px;

            font-weight: 700;

            margin-bottom: 15px;

            color: #1d3557;

        }


        .info-row {

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 10px 0;

            border-bottom: 1px solid #e2e8f0;

            font-size: 13px;

        }


        .info-row:last-child {

            border-bottom: none;

            padding-bottom: 0;

        }


        .info-row:first-of-type {

            padding-top: 0;

        }


        .info-label {

            color: #6c757d;

        }


        .info-value {

            font-weight: 700;

            color: #1d3557;

        }


        /*
        |--------------------------------------------------------------------------
        | BUTTON
        |--------------------------------------------------------------------------
        */

        .btn {

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            padding: 14px 20px;

            border-radius: 12px;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            transition: all 0.3s ease;

        }


        .btn-primary {

            background: #e63946;

            color: #ffffff;

            box-shadow:
                0 8px 18px rgba(230, 57, 70, 0.22);

        }


        .btn-primary:hover {

            background: #c1121f;

            transform: translateY(-2px);

        }


        .btn-secondary {

            background: #f1f5f9;

            color: #1d3557;

            margin-top: 10px;

        }


        .btn-secondary:hover {

            background: #e2e8f0;

        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer {

            text-align: center;

            margin-top: 25px;

            color: #94a3b8;

            font-size: 11px;

        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 600px) {

            .admin-card {

                margin: 20px;

                padding: 28px 22px;

            }


            .logo h1 {

                font-size: 26px;

            }


            .page-title h2 {

                font-size: 18px;

            }

        }

    </style>

</head>


<body>


    <div class="background-circle"></div>

    <div class="background-circle-2"></div>


    <div class="admin-card">


        <!-- LOGO -->

        <div class="logo">

            <div class="logo-icon">

                <i class="fa-solid fa-cake-candles"></i>

            </div>

            <h1>Sweet Cake</h1>

            <p>Administrator Panel</p>

        </div>


        <?php if ($berhasil): ?>

            <!-- SUCCESS -->

            <div class="alert alert-success">

                <div class="alert-icon">

                    <i class="fa-solid fa-check"></i>

                </div>

                <div>

                    <h3>Admin berhasil dibuat!</h3>

                    <p>
                        Akun administrator berhasil ditambahkan
                        ke dalam database.
                    </p>

                </div>

            </div>


            <div class="account-info">

                <div class="account-info-title">

                    <i class="fa-solid fa-user-shield"></i>

                    Informasi Akun

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Nama
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($nama); ?>
                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Username
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($username); ?>
                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Password
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($password); ?>
                    </span>

                </div>

            </div>


            <a
                href="login.php"
                class="btn btn-primary"
            >

                <i class="fa-solid fa-right-to-bracket"></i>

                Login ke Admin

            </a>


        <?php elseif ($sudahAda): ?>

            <!-- USERNAME SUDAH ADA -->

            <div class="alert alert-warning">

                <div class="alert-icon">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>

                <div>

                    <h3>Admin sudah terdaftar</h3>

                    <p>
                        Username
                        <strong><?= htmlspecialchars($username); ?></strong>
                        sudah terdapat di database.
                    </p>

                </div>

            </div>


            <div class="account-info">

                <div class="account-info-title">

                    <i class="fa-solid fa-shield-halved"></i>

                    Informasi Login

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Username
                    </span>

                    <span class="info-value">
                        <?= htmlspecialchars($username); ?>
                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Status
                    </span>

                    <span class="info-value">
                        Sudah terdaftar
                    </span>

                </div>

            </div>


            <a
                href="login.php"
                class="btn btn-primary"
            >

                <i class="fa-solid fa-right-to-bracket"></i>

                Ke Halaman Login

            </a>


        <?php else: ?>

            <!-- ERROR -->

            <div class="alert alert-error">

                <div class="alert-icon">

                    <i class="fa-solid fa-xmark"></i>

                </div>

                <div>

                    <h3>Terjadi kesalahan</h3>

                    <p>
                        <?= htmlspecialchars($error); ?>
                    </p>

                </div>

            </div>


            <a
                href="buat_admin.php"
                class="btn btn-primary"
            >

                <i class="fa-solid fa-rotate-right"></i>

                Coba Lagi

            </a>

        <?php endif; ?>


        <div class="footer">

            Sweet Cake &copy; <?= date('Y'); ?>

        </div>


    </div>


</body>

</html>