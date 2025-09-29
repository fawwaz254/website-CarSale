<?php
	session_start();	
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
	{
    	header('Location: register.php');
	}
	include "includes/dbconnect.php";
	$product_id=$_GET['product_id'];
	$user_id=$_SESSION['user_id'];
	

?>
<!DOCTYPE html>
<html>
	<?php include "includes/css_header.php" ?>
	<body style="background-color: #EEEEEE;">
		<?php include "includes/header_postlogin.php" ?>
		
		<div class="row">
			<div class="col-md-6">
				<h1 class="text-center"> <b>Silakan masukkan detail pengiriman untuk mobil ini. Terima kasih..</b> </h1><br>
				<i class="text-center"><b>CATATAN: Pembelian mobil dilakukan dengan pembayaran penuh saat pengiriman.</b></i>
			</div>
			<div class="col-md-6">

				<form class="text-center" action="add_to_details.php" method="POST">
					<input type="hidden" name="product_id" value=" <?php echo $product_id; ?>">
					<label><h3><b>Silakan masukkan alamat pengiriman: </b></h3></label>
					<input type="text" name="address" class="form-control" placeholder="Alamat pengiriman..."><br>
					<label><h3><b>Jumlah(Unit): </b></h3></label>
					<input type="number" step="1" name="quantity" class="form-control" placeholder="...Unit"><br>
					<input type="submit" value="Kirim Detail" class="btn btn-danger btn-lg">
				</form>
			</div>
		</div>
	</body>
</html>
