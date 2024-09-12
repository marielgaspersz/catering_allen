<?php
include "inc/config.php";
include "layout/header.php";
?>

<div class="col-md-9">
	<div class="row">
		<div class="col-md-12">
			<img src="<?php echo $url . 'assets/img/1.png'; ?>" width="100%">
		</div>
		<div class="col-md-12">
			<div style="background:#ffffff; width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px;">
				<h4>Favorite Menu</h4>
			</div>

			<?php
			$k = mysql_query("SELECT * FROM produk ORDER BY id ASC limit 3");
			while ($data = mysql_fetch_array($k)) {
			?>
				<div class="col-md-4 content-menu">
					<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>">
						<img src="<?php echo $url; ?>uploads/<?php echo $data['gambar'] ?>" width="100%">
						<h4><?php echo $data['nama'] ?></h4>
					</a>
					<p><?php echo $data['deskripsi'] ?></p>
					<p style="font-size:18px">Harga :<?php echo number_format($data['harga'], 2, ',', '.') ?></p>
					<p>
						<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>" class="btn btn-success btn-sm" href="#" role="button">Lihat Detail</a>
						<a href="<?php echo $url; ?>keranjang.php?act=beli&&produk_id=<?php echo $data['id'] ?>" class="btn btn-info btn-sm" href="#" role="button">Pesan</a>
					</p>
				</div>
			<?php } ?>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<br />
			<div style="background:#ffffff; width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px;">
				<h4>Menu Terbaru</h4>
			</div>
			<?php
			$k = mysql_query("SELECT * FROM produk ORDER BY id DESC limit 3");
			while ($data = mysql_fetch_array($k)) {
			?>
				<div class="col-md-4 content-menu">
					<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>">
						<img src="<?php echo $url; ?>uploads/<?php echo $data['gambar'] ?>" width="100%">
						<h4><?php echo $data['nama'] ?></h4>
					</a>
					<p style="font-size:18px">Harga :<?php echo number_format($data['harga'], 2, ',', '.') ?></p>
					<p>
						<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>" class="btn btn-success btn-sm" href="#" role="button">Lihat Detail</a>
						<a href="<?php echo $url; ?>keranjang.php?act=beli&&produk_id=<?php echo $data['id'] ?>" class="btn btn-info btn-sm" href="#" role="button">Pesan</a>
					</p>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

<?php include "layout/footer.php"; ?>