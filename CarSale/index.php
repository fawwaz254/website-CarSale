<!DOCTYPE html>
<html>
	<head>
		<?php include "includes/css_header.php"; ?>
		<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="js/error_manager.js"></script>
	</head>
	<body style="background-color:#2F3235 !important;">
		<div id="main_body" class="container">
			<div class="row">
				<div class="col-md-12 margin-top50">
					<div class="modern-form-card">
						<h2 class="text-center modern-form-title"> <b>Masuk untuk melanjutkan</b> </h2>
						<form class="form" action="login_user.php" method="POST" onsubmit="return validateLoginForm()">
							<div class="custom-form-group">
								<label class="modern-label">Email:</label>
								<input type="email" class="custom-form-control modern-input" placeholder="Masukkan Email Anda" name="user_email" id="user_email">
							</div>
							<div class="custom-form-group">
								<label class="modern-label">Kata Sandi:</label>
								<input type="password" class="custom-form-control modern-input" placeholder="Kata Sandi" name="user_password" id="user_password">
							</div>
							<input type="submit" class="custom-btn custom-btn-primary custom-btn-lg custom-btn-block modern-btn" value="Masuk" name="" onclick="return validateLoginForm()">
						</form>
						<p class="text-center modern-link"><i>Belum menjadi anggota? <a href="register.php" class="modern-link-a">Daftar Di Sini</a></i></p>
					</div>
				</div>
			</div>
		</div>
		<script>
			// Error messages will be handled automatically by error_manager.js
		</script>
	</body>
</html>
