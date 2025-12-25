<!DOCTYPE html>
<html>
	<head>
		<?php
		session_start();
		if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
	  	{
	    	header('Location: register.php');
	  	}
		include "includes/css_header.php"; ?>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="js/error_manager.js"></script>
	</head>
	<body class="admin-body" style="background-color: #f8f9fa;">
		<?php include "includes/header_admin.php"; ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center margin-bottom50">
					<h1 class="font-80px">Tambah Produk</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-card">
						<h3 class="text-center margin-bottom50"> <i class="fas fa-plus-circle"></i> Tambahkan Produk ke Database</h3>
						<form action="upload_product.php" method="POST" enctype="multipart/form-data" onsubmit="return validateProductForm()">
							<div class="custom-form-group">
								<label><i class="fas fa-tag"></i> Nama Produk</label>
								<input type="text" name="product_name" class="custom-form-control" required>
							</div>
							<div class="custom-form-group">
								<label><i class="fas fa-dollar-sign"></i> Harga Produk</label>
								<input type="number" name="product_price" class="custom-form-control" required>
							</div>
							<div class="custom-form-group">
								<label><i class="fas fa-align-left"></i> Deskripsi Produk</label>
								<textarea name="product_description" id="product_description" class="custom-form-control" rows="3" required oninput="limitDescription()"></textarea>
								<small id="word_count">0 / 500 kata</small>
							</div>
							<div class="custom-form-group">
								<label><i class="fas fa-list"></i> Kategori Produk</label>
								<select name="product_category" class="custom-form-control" required>
									<option value="">Pilih Kategori</option>
									<option value="SUV"><i class="fas fa-car"></i> SUV</option>
									<option value="Sedan"><i class="fas fa-car"></i> Sedan</option>
									<option value="Hatchback"><i class="fas fa-car"></i> Hatchback</option>
									<option value="MPV"><i class="fas fa-car"></i> MPV</option>
									<option value="Coupe"><i class="fas fa-car"></i> Coupe</option>
									<option value="Truck"><i class="fas fa-truck"></i> Truck</option>
								</select>
							</div>
							<div class="custom-form-group">
								<label><i class="fas fa-gas-pump"></i> Tipe Bahan Bakar</label><br>
								<input type="radio" name="fuel_type" value="Petrol" required> <i class="fas fa-gas-pump"></i> Bensin<br>
								<input type="radio" name="fuel_type" value="Diesel" required> <i class="fas fa-oil-can"></i> Solar<br>
								<input type="radio" name="fuel_type" value="Electric" required> <i class="fas fa-bolt"></i> Listrik<br>
							</div>
							<div class="custom-form-group">
								<label><i class="fas fa-image"></i> Unggah Gambar</label>
								<input type="file" name="image" class="custom-form-control" required>
							</div>
							<div class="text-center">
								<input type="submit" value="Tambahkan Produk" class="custom-btn custom-btn-success custom-btn-lg">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
