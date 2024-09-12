<?php
include "inc/config.php";

if (!empty($_SESSION['iam_user'])) {
	redir("index.php");
}

include "layout/header.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">

			<?php
			if (!empty($_POST)) {
				extract($_POST);

				$password = md5($password);
				$q = mysql_query("insert into user Values(NULL,'$nama','$email','$telephone','$alamat','$password','user')");
				if ($q) {
			?>

					<div class="alert alert-success">Register Berhasil.<br>
						<a href="<?php echo $url . "login.php"; ?>">Silahkan Login</a>
					</div>
				<?php } else { ?>
					<div class="alert alert-danger">Terjadi kesalahan dalam pengisian form. Silahkan Coba Lagi</div>
			<?php }
			} ?>
			<h3>Register User</h3>
			<hr>
			<div class="col-md-7 content-menu" style="margin-top:-20px;">
				<form action="" method="post" enctype="multipart/form-data">
					<label>Nama</label><br>
					<input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama"><br>
					<label>Email</label><br>
					<input type="email" class="form-control" name="email" required placeholder="Masukkan Email"><br>
					<label>Telephone</label><br>
					<input type="text" class="form-control" name="telephone" required placeholder="Masukkan Nomor Telp"><br>
					<label>Alamat</label><br>
					<input type="text" class="form-control" name="alamat" required placeholder="Masukkan Alamat"><br>
					<label>Password</label><br>
					<div class="input-group">
						<input type="password" class="form-control" name="password" id="password" required placeholder="Masukkan Password">
						<div class="input-group-append">
							<span class="input-group-text" onclick="togglePassword()">
								<i class="fa fa-eye" id="toggleIcon"></i>
							</span>
						</div>
					</div><br>

					<input type="submit" name="form-input" value="Register" class="btn btn-success">
				</form>

				<br />Sudah Punya Akun ? <a href="login.php">Login Sekarang !</a>
			</div>

			<script>
				function togglePassword() {
					var passwordField = document.getElementById("password");
					var toggleIcon = document.getElementById("toggleIcon");

					if (passwordField.type === "password") {
						passwordField.type = "text";
						toggleIcon.className = "fa fa-eye-slash";
					} else {
						passwordField.type = "password";
						toggleIcon.className = "fa fa-eye";
					}
				}
			</script>
		</div>
	</div>
</div>
<?php include "layout/footer.php"; ?>