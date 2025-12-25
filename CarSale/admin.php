<?php
session_start();
if (!(isset($_SESSION['name']) && isset($_SESSION['email']))) {
    header('Location: register.php');
    exit;
}
include "includes/dbconnect.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Basic Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Dashboard Admin CarSale | Sistem Manajemen Penjualan Mobil</title>

    <!-- SEO Meta -->
    <meta name="description" content="Dashboard admin CarSale digunakan untuk mengelola produk mobil, permintaan pelanggan, serta data transaksi secara terpusat dan efisien.">

    <!-- Canonical (aman walau localhost) -->
    <link rel="canonical" href="http://localhost/carsale/admin.php">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="admin-body" style="background-color:#f8f9fa;">

<!-- Skip link -->
<a href="#main-content" class="sr-only sr-only-focusable">
    Lewati ke konten utama
</a>

<!-- Sidebar / Header -->
<?php include "includes/header_admin.php"; ?>

<!-- Main Content -->
<main id="main-content" class="container" role="main">

    <header class="row">
        <div class="col-md-12 text-center margin-bottom50">
            <h1>Dashboard Admin CarSale</h1>
            <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['name']); ?>.</p>
        </div>
    </header>

    <?php
    $total_requests = mysqli_fetch_assoc(
        mysqli_query($connection, "SELECT COUNT(*) AS total FROM requests")
    )['total'];

    $pending_requests = mysqli_fetch_assoc(
        mysqli_query($connection, "SELECT COUNT(*) AS total FROM requests WHERE status='pending'")
    )['total'];

    $processing_requests = mysqli_fetch_assoc(
        mysqli_query($connection, "SELECT COUNT(*) AS total FROM requests WHERE status='processing'")
    )['total'];

    $completed_requests = mysqli_fetch_assoc(
        mysqli_query($connection, "SELECT COUNT(*) AS total FROM requests WHERE status='completed'")
    )['total'];
    ?>

    <!-- Statistik -->
    <section class="row margin-bottom50" aria-label="Ringkasan permintaan pelanggan">
        <div class="col-md-3">
            <div class="form-card text-center">
                <h2><?php echo $total_requests; ?></h2>
                <p>Total Request</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-card text-center">
                <h2><?php echo $pending_requests; ?></h2>
                <p>Pending</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-card text-center">
                <h2><?php echo $processing_requests; ?></h2>
                <p>Processing</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-card text-center">
                <h2><?php echo $completed_requests; ?></h2>
                <p>Completed</p>
            </div>
        </div>
    </section>

    <!-- Navigasi -->
    <section class="row margin-bottom50" aria-label="Menu administrasi">
        <div class="col-md-3">
            <a href="add_product.php" class="btn btn-lg btn-success btn-block" role="button">
                <i class="fas fa-plus-circle" aria-hidden="true"></i>
                Tambah Produk
            </a>
        </div>
        <div class="col-md-3">
            <a href="admin_requests.php" class="btn btn-lg btn-primary btn-block" role="button">
                <i class="fas fa-list" aria-hidden="true"></i>
                Lihat Request
            </a>
        </div>
        <div class="col-md-3">
            <a href="products.php" class="btn btn-lg btn-info btn-block" role="button">
                <i class="fas fa-eye" aria-hidden="true"></i>
                Lihat Produk
            </a>
        </div>
        <div class="col-md-3">
            <a href="logout.php" class="btn btn-lg btn-danger btn-block" role="button">
                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                Logout
            </a>
        </div>
    </section>

</main>

</body>
</html>
