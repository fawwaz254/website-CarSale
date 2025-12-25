<?php
session_start();
if(!(isset($_SESSION['name'])&&isset($_SESSION['email']))) {
    header('Location: register.php');
}
include "includes/dbconnect.php";
$user_id = $_SESSION['user_id'];

$query = "SELECT r.*, p.product_name FROM requests r
          JOIN products p ON r.product_id = p.product_id
          WHERE r.user_id = '$user_id'
          ORDER BY r.created_at DESC";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<?php include "includes/css_header.php"; ?>
<body class="admin-body" style="background-color: #f8f9fa;">
<?php include "includes/header_postlogin.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center margin-bottom50">
            <h1 class="font-80px">Request Cek Unit Saya</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Request</th>
                        <th>Produk</th>
                        <th>Pesan Anda</th>
                        <th>Nomor Telepon</th>
                        <th>Status</th>
                        <th>Tanggal Request</th>
                        <th>Catatan Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_message']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_phone']); ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo htmlspecialchars($row['admin_notes'] ?? ''); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
