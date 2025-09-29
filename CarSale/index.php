<!DOCTYPE html>
<html>

	<?php include "includes/css_header.php" ?>

	<body style="background-color:#2F3235 !important">

		<?php include "includes/header_prelogin.php" ?>

	  	<div id="main_body" class="container">
    		<div class="row">
    			<div class="col-md-8 margin-top50">
    				<h1 class="text-white font-80px text-center"><b>Dapatkan Mobil Terbaik dengan Harga Termurah dari CarSale</b></h1>
    			</div>

    			<div class="col-md-4 margin-top50">
    				<div class="form-card">
    					<h2 class="text-center"> <b>Masuk untuk melanjutkan</b> </h2>
    					<form class="form"  action="login_user.php" method="POST">
    						<div class="form-group">
    							<label>Email:</label>
    							<input type="email" class="form-control" placeholder="Masukkan Email Anda" name="user_email" required>
    						</div>
    						<div class="form-group">
    							<label>Kata Sandi:</label>
    							<input type="password" class="form-control" placeholder="Kata Sandi" name="user_password" required>
    						</div>
    						<input type="submit" class="btn btn-primary btn-lg btn-block" value="Masuk" name="">
    					</form>
    					<p class="text-center"><i>Belum menjadi anggota? <a href="register.php">Daftar Di Sini</a></i></p>
    				</div>
    			</div>
    		</div>
    	</div>
	</body>
</html>