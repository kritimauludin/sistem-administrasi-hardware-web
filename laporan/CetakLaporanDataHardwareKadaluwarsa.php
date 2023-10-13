<?php ob_start(); ?>
<html>
<head>
	<title>Laporan Data Hardware Kadaluwarsa</title>
</head>
<body>

<div style="text-align: center;">
	<img src="../gambar/Logo Bintang Motor.png">
</div>
<div style="text-align: center;">
	<h2 style="margin: 0px;">Laporan Data Hardware Kadaluwarsa Bintang Motor Group</h2>
	<h4 style="margin-top: 10px;">Jl. Mayor Oking Jayaatmaja No. 102, Cirimekar, Cibinong, Kab. Bogor</h4>
	<h5 style="margin-top: 0px;">Tlp. 021-8765447 | Fax. 021-8765446 | www.bintangmotor.com</h5>
</div>
<hr>
<div>
<?php
include_once("../library/modul.php");

if (isset($_GET['Filter']) && ! empty($_GET['Filter'])) {
	$FilterData = $_GET['Filter'];

	if ($FilterData == '1') {
		$FilterDataTanggal = date('d F Y', strtotime($_GET['filter_tanggal']));
		echo '<p style="font-size:18px;">Data Hardware Kadaluwarsa Tanggal <i style="color: #e74c3c;">'.$FilterDataTanggal.'</i></p>';

		$QueryData = "SELECT trx_pengadaan_hardware.tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_pengadaan_hardware.serial_number FROM trx_pengadaan_hardware
			INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
			WHERE DATE(tanggal_kadaluwarsa_hardware) = '".$_GET['filter_tanggal']."'";
	} else if ($FilterData == '2') {
		$FilterDataBulan = array('', 'January','February','March','April','May','June','July','August','September','October','November','December');
		echo '<p style="font-size:18px;">Data Hardware Kadaluwarsa Bulan <i style="color: #e74c3c;">'.$FilterDataBulan[$_GET['filter_bulan']].' '.$_GET['filter_tahun'].'</i></p>';

		$QueryData = "SELECT trx_pengadaan_hardware.tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_pengadaan_hardware.serial_number FROM trx_pengadaan_hardware
			INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
			WHERE MONTH(tanggal_kadaluwarsa_hardware)='".$_GET['filter_bulan']."' AND YEAR(tanggal_kadaluwarsa_hardware)='".$_GET['filter_tahun']."'";
	} else if ($FilterData == '3') {
		echo '<p style="font-size:18px;">Data Hardware Kadaluwarsa Tahun <i style="color: #e74c3c;">'.$_GET['filter_tahun'].'</i></p>';

	    $QueryData = "SELECT trx_pengadaan_hardware.tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_pengadaan_hardware.serial_number FROM trx_pengadaan_hardware
			INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
			WHERE YEAR(tanggal_kadaluwarsa_hardware)='".$_GET['filter_tahun']."'";
	} else {
		$KodeCabang = $_GET['kode_cabang'];
		$NamaCabang = $_GET['nama_cabang'];
		echo '<p style="font-size:18px;">Data Hardware Kadaluwarsa Cabang <i style="color: #e74c3c;">'.$_GET['nama_cabang'].'</i></p>';

		$QueryData = "SELECT trx_pengadaan_hardware.tanggal_kadaluwarsa_hardware, mst_cabang.kode_cabang, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_pengadaan_hardware.serial_number
			FROM trx_pengadaan_hardware
			INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
			WHERE trx_pengadaan_hardware.kode_cabang = '$KodeCabang' AND trx_pengadaan_hardware.status = 'O'
			ORDER BY trx_pengadaan_hardware.tanggal_kadaluwarsa_hardware DESC";
	}

}else{
	echo '<p style="font-size:18px;">Semua Data Hardware Kadaluwarsa</p>';

    $HariIni = date('Y-m-d');
    $QueryData = "SELECT trx_pengadaan_hardware.kode_pengadaan_hardware, trx_pengadaan_hardware.tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_pengadaan_hardware.serial_number FROM trx_pengadaan_hardware
		INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
		INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
		INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
		INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
		WHERE trx_pengadaan_hardware.tanggal_kadaluwarsa_hardware < '$HariIni' AND trx_pengadaan_hardware.status = 'O' ORDER BY tanggal_kadaluwarsa_hardware DESC";
}

?>
</div>

<div>
<table id="TabelTampilData" style="table-layout: auto; width: 100%; border-collapse: collapse; margin-top: 10px;">
	<thead align="center">
		<tr style="text-align: center; font-size: 15px;">
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=12px;">No</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=80px;">Tanggal Kadaluwarsa</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=185px;">Cabang</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=100px;">Divisi</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=95px;">Posession</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=190px;">Hardware</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=185px;">Serial Number</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$SQL	= mysqli_query($Koneksi, $QueryData);
		$Baris	= mysqli_num_rows($SQL);
		$Nomor	= 1;

		if ($Baris > 0 ) {
			while ($Data = mysqli_fetch_array($SQL)) {
			$TanggalKadaluwarsa = date('d F Y', strtotime($Data["tanggal_kadaluwarsa_hardware"]));

			echo '<tr>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=12px;">'.$Nomor++.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=80px;">'.$TanggalKadaluwarsa.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; width=185px;">'.$Data["nama_cabang"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=100px;">'.$Data["nama_divisi"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=95px;">'.$Data["nama_posession"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; width=190px;">'.$Data["nama_hardware"].'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; width=185px;">'.$Data["serial_number"].'</td>
				</tr>';
			}
		}
	?>
	</tbody>
</table>
<div>
<table class="TabelTandaTangan" style="text-align: center; font-size=15px; margin-left: 850px;">
	<?php
	$HariIni = date('Y-m-d');

	echo '<tr>
			<th><p> Cibinong, ' .date("d F Y", strtotime($HariIni)). '</p></th>
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
		</tr>';
	?>
</table>
</div>
</div>

</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();
require_once('../library/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','A4','en');
$html2pdf -> setDefaultFont('times');
$html2pdf -> WriteHTML($html);
$html2pdf -> Output('Data Hardware Kadaluwarsa.pdf');
?>