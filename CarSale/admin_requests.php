<?php
session_start();
if(!(isset($_SESSION['name'])&&isset($_SESSION['email']))) {
    header('Location: register.php');
}
include "includes/dbconnect.php";

$query = "SELECT r.*, p.product_name, u.name FROM requests r
          JOIN products p ON r.product_id = p.product_id
          JOIN users u ON r.user_id = u.user_id
          ORDER BY r.created_at DESC";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<?php include "includes/css_header.php"; ?>
<body class="admin-body" style="background-color: #f8f9fa;">
<?php include "includes/header_admin.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center margin-bottom50">
            <h1 class="font-80px">Kelola Request Cek Unit</h1>
        </div>
    </div>
    <?php
    if(isset($_GET['msg'])) {
        if ($_GET['msg'] == 'update_success') {
            echo "<div class='alert alert-success text-center'>Status request berhasil diperbarui.</div>";
        } elseif ($_GET['msg'] == 'update_failed') {
            echo "<div class='alert alert-danger text-center'>Gagal memperbarui status request.</div>";
        }
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Request</th>
                        <th>Produk</th>
                        <th>Pengguna</th>
                        <th>Nomor Telepon</th>
                        <th>Pesan Pengguna</th>
                        <th>Status</th>
                        <th>Tanggal Request</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_message']); ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <form action="update_request_status.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>Pending</option>
                                    <option value="processing" <?php if($row['status']=='processing') echo 'selected'; ?>>Processing</option>
                                    <option value="completed" <?php if($row['status']=='completed') echo 'selected'; ?>>Completed</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
