<!DOCTYPE html>
<html lang="id">
	<head>
		<?php include "includes/css_header.php"; ?>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="js/error_manager.js"></script>
	</head>
	<body style="background-color:#2F3235 !important;">
		<div id="main_body" class="container">
			<div class="row">
				<div class="col-md-12 margin-top50">
					<div class="modern-form-card">
						<h2 class="text-center modern-form-title"> <b>Buat Akun di Sini</b> </h2>
						<form class="form" action="register_user.php" method="POST" onsubmit="return validateRegisterForm()">
							<div class="custom-form-group">
								<label class="modern-label">Nama Depan:</label>
								<input type="text" class="custom-form-control modern-input" placeholder="Masukkan Nama Anda" name="user_name" id="user_name">
							</div>
							<div class="custom-form-group">
								<label class="modern-label">Email:</label>
								<input type="text" class="custom-form-control modern-input" placeholder="Masukkan Email Anda" name="user_email" id="user_email">
							</div>
							<div class="custom-form-group">
								<label class="modern-label">Kata Sandi:</label>
								<input type="password" class="custom-form-control modern-input" placeholder="Kata Sandi" name="user_password" id="user_password">
							</div>
							<div class="custom-form-group">
								<label class="modern-label">Konfirmasi Kata Sandi:</label>
								<input type="password" class="custom-form-control modern-input" placeholder="Konfirmasi Kata Sandi" name="user_confirm_password" id="user_confirm_password">
							</div>
							<input type="submit" class="custom-btn custom-btn-primary custom-btn-lg custom-btn-block modern-btn" value="Daftar">
						</form>
						<p class="text-center modern-link"><i>Sudah menjadi anggota? <a href="index.php" class="modern-link-a">Masuk di Sini</a></i></p>
					</div>
				</div>
			</div>
		</div>
		<script>
			// Error messages will be handled automatically by error_manager.js
		</script>
	</body>
</html>
