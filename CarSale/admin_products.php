<?php
session_start();
if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
{
  header('Location: register.php');
}
include "includes/dbconnect.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include "includes/css_header.php"; ?>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="js/error_manager.js"></script>
	</head>
	<body class="admin-body" style="background-color: #f8f9fa;">
		<?php include "includes/header_admin.php"; ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center margin-bottom50">
					<h1 class="font-80px">Manajemen Produk</h1>
					<a href="add_product.php" class="custom-btn custom-btn-lg custom-btn-success margin-bottom50"> <i class="fas fa-plus-circle"></i> Tambah Produk</a>
					<?php
				if (isset($_GET['msg'])) {
					echo '<div class="alert text-center" role="alert" style="margin-top:20px;">';
					switch ($_GET['msg']) {
						case '1':
							echo '<div class="alert alert-success"> Produk berhasil ditambahkan.</div>';
							break;
						case '2':
							echo '<div class="alert alert-warning"> Gagal mengunggah gambar produk. Silakan coba lagi.</div>';
							break;
						case '3':
							echo '<div class="alert alert-danger"> Data produk tidak valid. Mohon periksa kembali kolom isian.</div>';
							break;
						case '4':
    						echo '<div class="alert alert-success"> Produk berhasil diperbarui.</div>';
    						break;
						default:
							echo '<div class="alert alert-secondary"> Terjadi kesalahan yang tidak diketahui.</div>';
							break;
					}
					echo '</div>';
				}
				?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="custom-table custom-table-bordered custom-table-striped">
						<thead>
							<tr>
								<th>ID Produk</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Kategori</th>
								<th>Bahan Bakar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM products ORDER BY product_id DESC";
								$result = mysqli_query($connection, $query);
								while($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>".$row['product_id']."</td>";
									echo "<td>".$row['product_name']."</td>";
									echo "<td>Rp. ".$row['product_price']."</td>";
									echo "<td>".$row['product_category']."</td>";
									echo "<td>".$row['fuel_type']."</td>";
									echo "<td>
											<a href='edit_product.php?product_id=".$row['product_id']."' class='custom-btn custom-btn-primary custom-btn-sm'>Edit</a>
											<a href='delete_product.php?product_id=".$row['product_id']."' class='custom-btn custom-btn-danger custom-btn-sm' onclick='return confirm(\"Yakin ingin menghapus produk ini?\")'>Hapus</a>
										  </td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<script>
		$(document).ready(function () {
			setTimeout(function () {
				$("#alert-box").fadeOut("slow");
			}, 4000); // Alert menghilang setelah 4 detik
		});
	</script>
	</body>
</html>
