<!DOCTYPE html>
<html>
	<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/css_header.php"; ?>
<body style="background-color: #f8f9fa;">
	<?php include "includes/header_admin.php"; ?>
	<div class="container">

		<div class="row">
			<div class="col-md-12 text-center margin-bottom50">
				<h1 class="font-80px">Admin Panel</h1>
			</div>
		</div>

		<div class="row margin-bottom50">
			<div class="col-md-12">
				<a href="admin_orders.php" class="btn btn-lg btn-success"> <i class="fas fa-list"></i> Lihat Semua Pesanan</a>
			</div>
		</div>

		<?php
		if(isset($_GET['msg']))
        {
          if ($_GET['msg']==1)
          {
            echo "<div class='alert alert-success text-center'><i class='fas fa-check-circle'></i> Produk telah ditambahkan</div>";
          }
          elseif ($_GET['msg']==2)
          {
            echo "<div class='alert alert-danger text-center'><i class='fas fa-times-circle'></i> Produk tidak dapat ditambahkan</div>";
          }
          elseif ($_GET['msg']==11)
          {
            echo "<div class='alert alert-success text-center'><i class='fas fa-check-circle'></i> Produk telah dihapus</div>";
          }
          elseif ($_GET['msg']==22)
          {
            echo "<div class='alert alert-danger text-center'><i class='fas fa-times-circle'></i> Produk tidak dapat dihapus</div>";
          }
        }
        ?>

		<div class="row">
			<div class="col-md-12">
				<div class="form-card">
					<h3 class="text-center margin-bottom50"> <i class="fas fa-plus-circle"></i> Tambahkan Produk ke Database</h3>
					<form action="upload_product.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label><i class="fas fa-tag"></i> Nama Produk</label>
							<input type="text" name="product_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label><i class="fas fa-dollar-sign"></i> Harga Produk</label>
							<input type="number" name="product_price" class="form-control" required>
						</div>
						<div class="form-group">
							<label><i class="fas fa-align-left"></i> Deskripsi Produk</label>
							<textarea name="product_description" class="form-control" rows="3" required></textarea>
						</div>
						<div class="form-group">
							<label><i class="fas fa-list"></i> Kategori Produk</label><br>
							<div class="row">
								<div class="col-md-6">
									<input type="radio" name="product_category" value="SUV" required> <i class="fas fa-car"></i> SUV<br>
									<input type="radio" name="product_category" value="Sedan" required> <i class="fas fa-car"></i> Sedan<br>
									<input type="radio" name="product_category" value="Hatchback" required> <i class="fas fa-car"></i> Hatchback<br>
								</div>
								<div class="col-md-6">
									<input type="radio" name="product_category" value="MPV" required> <i class="fas fa-car"></i> MPV<br>
									<input type="radio" name="product_category" value="Coupe" required> <i class="fas fa-car"></i> Coupe<br>
									<input type="radio" name="product_category" value="Truck" required> <i class="fas fa-truck"></i> Truck<br>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label><i class="fas fa-image"></i> Unggah Gambar</label>
							<input type="file" name="image" class="form-control" required>
						</div>
						<div class="text-center">
							<input type="submit" value="Tambahkan Produk" class="btn btn-success btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-card">
					<h3 class="text-center margin-bottom50"> <i class="fas fa-trash"></i> Hapus Produk dari Database</h3>
					<form action="delete_product.php" method="POST">
						<div class="form-group">
							<label><i class="fas fa-id-badge"></i> ID Produk</label>
							<input type="number" name="product_id" class="form-control" required>
						</div>
						<div class="text-center">
							<input type="submit" value="Hapus Produk" class="btn btn-danger btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</body>
</html>
