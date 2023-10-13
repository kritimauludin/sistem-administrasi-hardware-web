<?php
include_once("../library/modul.php");

$TampilLaporanDataPengepul = Query("SELECT mst_pengepul.kode_pengepul, mst_pengepul.nama_pengepul, mst_pengepul.alamat, mst_kabupaten_kota.nama_kabupaten_kota, mst_pengepul.no_telepon
	FROM mst_pengepul
	INNER JOIN mst_kabupaten_kota ON mst_pengepul.kode_kabupaten_kota = mst_kabupaten_kota.kode_kabupaten_kota
	ORDER BY kode_pengepul ASC");

$html = '

<html lang="en">
<head>
	<title></title>
</head>
<body style="font-family: Times;">
	<div style="text-align: center;">
		<img src="../gambar/Logo Bintang Motor.png">
	</div>
	<div style="text-align: center;">
		<h2 style="margin: 0px;">Laporan Data Pengepul</h2>
		<h4 style="margin-top: 10px;">Jl. Mayor Oking Jayaatmaja No. 102, Cirimekar, Cibinong, Kab. Bogor</h4>
		<h5 style="margin-top: 0px;">Tlp. 021-8765447 | Fax. 021-8765446 | www.bintangmotor.com</h5>
	</div>
	<hr>
	<br>
	<table class="TabelTampilLaporan" style="table-layout: auto; width: 100%; border-collapse: collapse;">
		<tr style="text-align: center; font-size: 15px;">
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=20px;">No</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=250px;">Nama Pengepul</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=365px;">Alamat</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=200px;">Kabupaten / Kota</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=150px;">Nomor Telepon</th>
		</tr>';
	$Nomor = 1;
	foreach ($TampilLaporanDataPengepul as $Baris) {
		$html .= '<tr>
			<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=20px;">' .$Nomor++. '</td>
			<td style="padding: 5px; border-bottom: 1px solid #ddd; width=250px;">' .$Baris["nama_pengepul"]. '</td>
			<td style="padding: 5px; border-bottom: 1px solid #ddd; width=365px;">' .$Baris["alamat"]. '</td>
			<td style="padding: 5px; border-bottom: 1px solid #ddd; width=200px;">' .$Baris["nama_kabupaten_kota"]. '</td>
			<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=150px;">' .$Baris["no_telepon"]. '</td>
		</tr>';
	}

	$HariIni = date('Y-m-d');
$html .= '

	</table>
	<table class="TabelTandaTangan" style="text-align: center; font-size=15px; margin-left: 850px;">
		<tr>
			<th><p> Cibinong, ' .date('d F Y', strtotime($HariIni)). ' </p></th>
		</tr>
		<tr>
			<td>
				<p><b>Mengetahui,</b></p>
				<br>
				<br>
				<br>
				<br>
				<p>(______________________)</p>
			</td>
		</tr>
	</table>
		
</body>
</html>

';

require_once("../library/html2pdf/html2pdf.class.php");
$html2pdf = new HTML2PDF('L','A4','en');
$html2pdf -> WriteHTML($html);
ob_end_clean();
$html2pdf -> Output();

?>