<?php
include "../inc/config.php";
validate_admin_not_login("login.php");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pembayaran_terverifikasi.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Modified query to include the order date from the pesanan table
$q = mysql_query("SELECT p.*, ps.tanggal_pesan FROM pembayaran p 
                  JOIN pesanan ps ON p.id_pesanan = ps.id 
                  WHERE p.status='verified' ORDER BY p.status ASC");

// Updated header to include Tanggal Pesanan
echo "No\tNama\tTotal\tStatus\tTanggal Pesanan\n";

$no = 1;
while ($data = mysql_fetch_object($q)) {
    $katpro = mysql_query("SELECT * FROM user WHERE id='$data->id_user'");
    $user = mysql_fetch_array($katpro);

    echo "$no\t";
    echo @$user['nama'] . "\t";
    echo 'Rp.' . number_format($data->total, 2, ',', '.') . "\t";
    echo $data->status . "\t";
    echo date('Y-m-d', strtotime($data->tanggal_pesan)) . "\n";

    $no++;
}
