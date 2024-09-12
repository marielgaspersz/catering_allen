<?php
include "../inc/config.php";
validate_admin_not_login("login.php");

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Daftar Pembayaran Terverifikasi', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(20, 10, 'No', 1);
$pdf->Cell(50, 10, 'Nama', 1);
$pdf->Cell(40, 10, 'Total', 1);
$pdf->Cell(40, 10, 'Status', 1);
$pdf->Cell(40, 10, 'Tanggal Pesanan', 1);
$pdf->Ln();

$no = 1;

// Ambil data dari database
$q = mysql_query("SELECT p.*, ps.tanggal_pesan FROM pembayaran p 
                  JOIN pesanan ps ON p.id_pesanan = ps.id 
                  WHERE p.status='verified' ORDER BY p.id ASC");
if (!$q) {
    die('Query failed: ' . mysql_error());
}

while ($data = mysql_fetch_object($q)) {
    $katpro = mysql_query("SELECT * FROM user WHERE id='$data->id_user'");
    if (!$katpro) {
        die('Query failed: ' . mysql_error());
    }
    $user = mysql_fetch_array($katpro);

    if ($user === false) {
        $user['nama'] = 'Unknown';
    }

    // Cetak data ke PDF
    $pdf->Cell(20, 10, $no, 1);
    $pdf->Cell(50, 10, $user['nama'], 1);
    $pdf->Cell(40, 10, 'Rp. ' . number_format($data->total, 2, ',', '.'), 1);
    $pdf->Cell(40, 10, $data->status, 1);
    $pdf->Cell(40, 10, date('d-m-Y', strtotime($data->tanggal_pesan)), 1);
    $pdf->Ln();

    $no++; // Increment nomor urut
}
// Output PDF
$pdf->Output('D', 'daftar_pembayaran_terverifikasi.pdf');
