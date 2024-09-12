<?php
include "inc/config.php";
include "layout/header.php";
?>

<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">

			<?php
			if (!empty($_POST)) {
				extract($_POST);

				// Perbarui query untuk menyertakan nomor WhatsApp
				$q = mysql_query("insert into kontak Values(NULL, '$nama', '$nomor_wa','$pesan')");
				if ($q) {
			?>

					<div class="alert alert-success">Terimakasih, kami akan memeriksa pesanan anda</div>
				<?php } else { ?>
					<div class="alert alert-danger">Terjadi kesalahan dalam pengisian form. Data belum terkirim.</div>
			<?php }
			} ?>
			<h3>Kontak Kami</h3>
			<hr>
			<div class="col-md-8 content-menu" style="margin-top:-20px;">

				<form action="" method="post" enctype="multipart/form-data">
					<label>Nama</label><br>
					<input type="text" class="form-control" name="nama" required><br>
					<label>Nomor WhatsApp</label><br>
					<input type="text" class="form-control" name="nomor_wa" placeholder="contoh : 08123456789 atau +628123456789" required><br>
					<label>Pesan</label><br>
					<textarea class="form-control" name="pesan" required></textarea><br>

					<input type="submit" name="form-input" value="Kirim" class="btn btn-success">
				</form>

			</div>

		</div>
	</div>
</div>
<?php include "layout/footer.php"; ?>