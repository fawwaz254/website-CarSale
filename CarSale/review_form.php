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
				<h1 class="text-center"> <b>Terima Kasih telah berbelanja di CarSale.com. Silakan tambahkan ulasan untuk mobil ini.</b> </h1>
			</div>
			<div class="col-md-6">

				<form class="text-center" action="add_to_review.php" method="POST">
					<input type="hidden" name="product_id" value=" <?php echo $product_id; ?>">
					<label><h3><b>Judul Ulasan</b></h3></label>
					<input type="text" name="review_heading" class="form-control" placeholder="Tambahkan judul di sini..." required><br>
					<label><h3><b>Rating</b></h3></label><br>
					<div class="rating">
						<input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
						<input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
						<input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
						<input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
						<input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
					</div><br>
					<label><h3><b>Ulasan</b></h3></label>
					<textarea name="review_text" class="form-control" placeholder="Tambahkan ulasan di sini..." rows="4" required></textarea><br>
					<input type="submit" value="Kirim Ulasan" class="btn btn-primary btn-lg">
				</form>
			</div>
		</div>
	</body>
</html>
