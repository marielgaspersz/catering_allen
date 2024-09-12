<?php
include "../inc/config.php";
validate_admin_not_login("login.php");

if (!empty($_GET)) {
	if ($_GET['act'] == 'delete') {
		$q = mysql_query("DELETE FROM kontak WHERE id='$_GET[id]'");
		if ($q) {
			alert("Success");
			redir("kontak.php");
		}
	}
}

include "inc/header.php";
?>

<style>
	.table td.message-col {
		max-width: 300px;
		/* Setel lebar maksimum sesuai kebutuhan */
		word-wrap: break-word;
		/* Bungkus kata jika diperlukan */
		white-space: normal;
		/* Izinkan teks membungkus ke baris berikutnya */
	}
</style>

<div class="container">
	<?php
	$q = mysql_query("SELECT * FROM kontak");
	$j = mysql_num_rows($q);
	?>
	<h4>Daftar Kontak Masuk (<?php echo ($j > 0) ? $j : 0; ?>)</h4>
	<hr>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Nama</th>
				<th>Nomor WA</th> <!-- Tambahkan header untuk Nomor WhatsApp -->
				<th>Pesan</th>
				<th>*</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1; // Inisialisasi nomor urut mulai dari 1
			while ($data = mysql_fetch_object($q)) { ?>
				<tr>
					<th scope="row"><?php echo $no++; ?></th> <!-- Menampilkan nomor urut -->
					<td><?php echo $data->nama; ?></td>
					<td><?php echo $data->nomor_wa; ?></td> <!-- Tampilkan nomor WhatsApp -->
					<td class="message-col"><?php echo $data->pesan; ?></td>
					<td>
						<a class="btn btn-sm btn-danger" href="kontak.php?act=delete&&id=<?php echo $data->id ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div> <!-- /container -->

<?php include "inc/footer.php"; ?>