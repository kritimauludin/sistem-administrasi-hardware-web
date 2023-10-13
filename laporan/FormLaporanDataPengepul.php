<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilLaporanDataPengepul = Query("SELECT mst_pengepul.kode_pengepul, mst_pengepul.nama_pengepul, mst_pengepul.alamat, mst_kabupaten_kota.nama_kabupaten_kota, mst_pengepul.no_telepon
	FROM mst_pengepul
	INNER JOIN mst_kabupaten_kota ON mst_pengepul.kode_kabupaten_kota = mst_kabupaten_kota.kode_kabupaten_kota
	ORDER BY kode_pengepul ASC");

?>

<html>
<head>
<title><?php include_once("../library/judul.php"); ?></title>

<!-- Awal CSS -->
<link rel="stylesheet" href="../library/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../library/datepicker/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../library/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../library/fontawesome/css/all.css">
<link rel="stylesheet" href="../library/custom.css">
<link rel="stylesheet" href="../library/bootstrap4navbar/css/bootstrap-4-navbar.css">
<!-- Akhir CSS -->

<body>

<!-- Awal Nav Bar -->
<?php include_once ("../library/navbar.php"); ?>
<!-- Akhir Nav Bar-->

<div class="container-fluid" align="center">
	<div id="JudulForm">
		<img src="../gambar/Logo Bintang Motor.png" class="img-fluid" alt="Logo Bintang Motor">
		<h2>Laporan Data Pengepul</h2>
		<hr>
	</div>
</div>

<div>
	<form action="CetakLaporanDataPengepul.php" method="POST" id="FormLaporan" target="_blank">
		<div class="col-sm-2">
			<button type="submit" id="TombolCetak1" name="tombol_cetak_laporan" class="btn btn-outline-info"><i class="fas fa-file-pdf"></i> Cetak ke PDF</button>
		</div>
	</form>
</div>

<div class="container-fluid">
	<hr>
</div>

<div class="container-fluid" id="TampilDataLaporan">

<!-- Awal Tampil Data -->
<table class="table table-hover" id="TabelTampilData">
	<thead align="center">
		<tr>
			<th>Kode Pengepul</th>
			<th>Nama Pengepul</th>
			<th>Alamat</th>
			<th>Kabupaten / Kota</th>
			<th>No Telepon</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($TampilLaporanDataPengepul as $Baris) : ?>
		<tr>
			<td><?php echo $Baris["kode_pengepul"] ?></td>
			<td><?php echo $Baris["nama_pengepul"] ?></td>
			<td><?php echo $Baris["alamat"] ?></td>
			<td><?php echo $Baris["nama_kabupaten_kota"] ?></td>
			<td><?php echo $Baris["no_telepon"] ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<!-- Akhir Tampil Data -->

</div>

<!-- Awal Java Script -->
<script src="../library/jquery/jquery.js"></script>
<script src="../library/datepicker/js/bootstrap-datepicker.js"></script>
<script src="../library/popper/popper.js"></script>
<script src="../library/bootstrap/js/bootstrap.min.js"></script>
<script src="../library/datatables/js/jquery.dataTables.min.js"></script>
<script src="../library/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../library/bootstrap4navbar/js/bootstrap-4-navbar.js"></script>

<script type="text/javascript">
	
	$(function() {
        $('#TabelTampilData').dataTable();
    });

    $(document).ready(function(){
    	$('[data-toggle="tooltip"]').tooltip();   
	});

</script>

<!-- Akhir Java Script -->

</body>
</head>
</html>