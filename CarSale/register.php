<!DOCTYPE html>
<html>

	<?php include "includes/css_header.php" ?>
	
	<body style="background-color:#2F3235 !important">

    <?php include "includes/header_prelogin.php" ?>

    	<div id="main_body" class="container">
            <?php
                if(isset($_GET['msg']))
                {
                    if($_GET['msg']=='2')
                    {
                        echo "<div class='alert alert-danger text-center margin-top50'><i>Email Pengguna Sudah Digunakan!</i></div>";
                    }
                }
             ?>
    		<div class="row">
    			<div class="col-md-8 margin-top50">
    				<h1 class="text-white font-80px text-center"><b>Dapatkan Mobil Terbaik dengan Harga Termurah dari CarSale</b></h1>
    			</div>

    			<div class="col-md-4 margin-top50">
    				<div class="form-card">
    					<h2 class="text-center"> <b>Buat Akun di Sini</b> </h2>
    					<form class="form" action="register_user.php" method="POST">
                            <div class="form-group">
                                <label>Nama Depan:</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Anda" name="user_name" required>
                            </div>
                            <div class="form-group">
        						<label>Email:</label>
        						<input type="email" class="form-control" placeholder="Masukkan Email Anda" name="user_email" required>
                            </div>
                            <div class="form-group">
        						<label>Kata Sandi:</label>
        						<input type="password" class="form-control" placeholder="Kata Sandi" name="user_password" required>
                            </div>
        					<input type="submit" class="btn btn-primary btn-lg btn-block" value="Daftar" name="">
    					</form>
    					<p class="text-center"><i>Sudah menjadi anggota? <a href="index.php">Masuk di Sini</a></i></p>
    				</div>
    			</div>
    		</div>
    	</div>
	</body>
</html>