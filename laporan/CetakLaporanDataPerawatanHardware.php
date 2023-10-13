<?php ob_start(); ?>
<html>
<head>
	<title>Laporan Perawatan Hardware</title>
</head>
<body>

<div style="text-align: center;">
	<img src="../gambar/Logo Bintang Motor.png">
</div>
<div style="text-align: center;">
	<h2 style="margin: 0px;">Laporan Perawatan Hardware IT Bintang Motor Group</h2>
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
		echo '<p style="font-size:18px;">Data Transaksi Perawatan Hardware Tanggal <i style="color: #e74c3c;">'.$FilterDataTanggal.'</i></p>';

		$QueryData = "SELECT trx_perawatan_hardware.kode_perawatan_hardware, trx_perawatan_hardware.tanggal_perawatan_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_perawatan_hardware.keterangan, mst_pic_it.nama_pic_it
			FROM trx_perawatan_hardware
			INNER JOIN mst_cabang ON trx_perawatan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_perawatan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_perawatan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_perawatan_hardware.kode_hardware = mst_hardware.kode_hardware
			INNER JOIN mst_pic_it ON trx_perawatan_hardware.id = mst_pic_it.id
			WHERE DATE(tanggal_perawatan_hardware)='".$_GET['filter_tanggal']."'
			ORDER BY trx_perawatan_hardware.tanggal_perawatan_hardware DESC";
	} else if ($FilterData == '2') {
		$FilterDataBulan = array('', 'January','February','March','April','May','June','July','August','September','October','November','December');
		echo '<p style="font-size:18px;">Data Transaksi Perawatan Hardware Bulan <i style="color: #e74c3c;">'.$FilterDataBulan[$_GET['filter_bulan']].' '.$_GET['filter_tahun'].'</i></p>';

		$QueryData = "SELECT trx_perawatan_hardware.kode_perawatan_hardware, trx_perawatan_hardware.tanggal_perawatan_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_perawatan_hardware.keterangan, mst_pic_it.nama_pic_it
			FROM trx_perawatan_hardware
			INNER JOIN mst_cabang ON trx_perawatan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_perawatan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_perawatan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_perawatan_hardware.kode_hardware = mst_hardware.kode_hardware
			INNER JOIN mst_pic_it ON trx_perawatan_hardware.id = mst_pic_it.id
			WHERE MONTH(tanggal_perawatan_hardware)='".$_GET['filter_bulan']."' AND YEAR(tanggal_perawatan_hardware)='".$_GET['filter_tahun']."'
			ORDER BY trx_perawatan_hardware.tanggal_perawatan_hardware DESC";
	} else if ($FilterData == '3') {
		echo '<p style="font-size:18px;">Data Transaksi Perawatan Hardware Tahun <i style="color: #e74c3c;">'.$_GET['filter_tahun'].'</i></p>';

	    $QueryData = "SELECT trx_perawatan_hardware.kode_perawatan_hardware, trx_perawatan_hardware.tanggal_perawatan_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_perawatan_hardware.keterangan, mst_pic_it.nama_pic_it
			FROM trx_perawatan_hardware
			INNER JOIN mst_cabang ON trx_perawatan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_perawatan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_perawatan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_perawatan_hardware.kode_hardware = mst_hardware.kode_hardware
			INNER JOIN mst_pic_it ON trx_perawatan_hardware.id = mst_pic_it.id
			WHERE YEAR(tanggal_perawatan_hardware)='".$_GET['filter_tahun']."'
			ORDER BY trx_perawatan_hardware.tanggal_perawatan_hardware DESC";
	} else {
		$KodeCabang = $_GET['kode_cabang'];
		$NamaCabang = $_GET['nama_cabang'];
		echo '<p style="font-size:18px;">Data Transaksi Perawatan Hardware Cabang <i style="color: #e74c3c;">'.$_GET['nama_cabang'].'</i></p>';

		$QueryData = "SELECT trx_perawatan_hardware.kode_perawatan_hardware, trx_perawatan_hardware.tanggal_perawatan_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_perawatan_hardware.keterangan, mst_pic_it.nama_pic_it
			FROM trx_perawatan_hardware
			INNER JOIN mst_cabang ON trx_perawatan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_perawatan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_perawatan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_perawatan_hardware.kode_hardware = mst_hardware.kode_hardware
			INNER JOIN mst_pic_it ON trx_perawatan_hardware.id = mst_pic_it.id
			WHERE trx_perawatan_hardware.kode_cabang = '$KodeCabang' AND trx_perawatan_hardware.status = 'O'
			ORDER BY trx_perawatan_hardware.tanggal_perawatan_hardware DESC";
	}

}else{
	echo '<p style="font-size:18px;">Semua Data Transaksi Perawatan Hardware</p>';

    $QueryData = "SELECT trx_perawatan_hardware.kode_perawatan_hardware, trx_perawatan_hardware.tanggal_perawatan_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_perawatan_hardware.keterangan, mst_pic_it.nama_pic_it
		FROM trx_perawatan_hardware
		INNER JOIN mst_cabang ON trx_perawatan_hardware.kode_cabang = mst_cabang.kode_cabang
		INNER JOIN mst_divisi ON trx_perawatan_hardware.kode_divisi = mst_divisi.kode_divisi
		INNER JOIN mst_posession ON trx_perawatan_hardware.kode_posession = mst_posession.kode_posession
		INNER JOIN mst_hardware ON trx_perawatan_hardware.kode_hardware = mst_hardware.kode_hardware
		INNER JOIN mst_pic_it ON trx_perawatan_hardware.id = mst_pic_it.id
		ORDER BY trx_perawatan_hardware.tanggal_perawatan_hardware DESC";
}

?>
</div>

<div>
<table id="TabelTampilData" style="table-layout: auto; width: 100%; border-collapse: collapse; margin-top: 10px;">
	<thead align="center">
		<tr style="text-align: center; font-size: 15px;">
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=12px;">No</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=100px;">Tanggal Perawatan</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=180px;">Cabang</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=100px;">Divisi</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=95px;">Posession</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=190px;">Hardware</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=90px;">PIC IT</th>
			<th style="background-color: #444d55; color: #ffffff; padding: 5px; border-bottom: 1px solid #ddd; height: 30px; width=160px;">Keterangan</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$SQL	= mysqli_query($Koneksi, $QueryData);
		$Baris	= mysqli_num_rows($SQL);
		$Nomor	= 1;

		if ($Baris > 0 ) {
			while ($Data = mysqli_fetch_array($SQL)) {
			$TanggalPerawatan 	= date('d F Y', strtotime($Data["tanggal_perawatan_hardware"]));

			echo '<tr>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=12px;">'.$Nomor++.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=80px;">'.$TanggalPerawatan.'</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; width=180px;">' .$Data["nama_cabang"]. '</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=100px;">' .$Data["nama_divisi"]. '</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; text-align: center; width=95px;">' .$Data["nama_posession"]. '</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; width=190px;">' .$Data["nama_hardware"]. '</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; width=90px;">' .$Data["nama_pic_it"]. '</td>
					<td style="padding: 5px; border-bottom: 1px solid #ddd; width=160px;">' .$Data["keterangan"]. '</td>
				</tr>';
			}
		}
	?>
	</tbody>
</table>
</div>

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

</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();
require_once('../library/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('L','A4','en');
$html2pdf -> setDefaultFont('times');
$html2pdf -> WriteHTML($html);
$html2pdf -> Output('Data Perawatan Hardware.pdf');
?>