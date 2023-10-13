<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilDataTrxPenjualanHardware = Query("SELECT trx_penjualan_hardware.kode_penjualan_hardware, trx_penjualan_hardware.tanggal_penjualan_hardware, mst_cabang.nama_cabang, mst_posession.nama_posession, mst_hardware.nama_hardware, mst_pengepul.nama_pengepul, trx_penjualan_hardware.harga_jual_hardware
	FROM trx_penjualan_hardware
	INNER JOIN mst_cabang ON trx_penjualan_hardware.kode_cabang = mst_cabang.kode_cabang
	INNER JOIN mst_posession ON trx_penjualan_hardware.kode_posession = mst_posession.kode_posession
	INNER JOIN mst_hardware ON trx_penjualan_hardware.kode_hardware = mst_hardware.kode_hardware
	INNER JOIN mst_pengepul ON trx_penjualan_hardware.kode_pengepul = mst_pengepul.kode_pengepul
	ORDER BY trx_penjualan_hardware.tanggal_penjualan_hardware DESC");

?>

<html>
<head>
<title><?php include_once("../library/judul.php"); ?></title>

<!-- Awal CSS -->
<link rel="stylesheet" href="../library/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../library/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../library/fontawesome/css/all.css">
<link rel="stylesheet" href="../library/custom.css">
<link rel="stylesheet" href="../library/bootstrap4navbar/css/bootstrap-4-navbar.css">
<!-- Akhir CSS -->

</head>
<body>

<!-- Awal Nav Bar -->
<?php include_once ("../library/navbar.php"); ?>
<!-- Akhir Nav Bar-->

<div class="container-fluid">
	<div id="JudulForm">
		<h2>Data Penjualan Hardware</h2>
		<hr>
	</div>
</div>

<div class="container-fluid" id="TampilDataTransaksiPenjualan">
	<div class="container-fluid" id="TambahData">
		<a href="../transaksi/EntriDataTrxPenjualanHardware.php"><button type="button" class=" btn btn-outline-success"><i class="fas fa-plus-circle"></i> Tambah Data
		</button></a>
	</div>
	<hr>
	<!-- Awal Tampil Data -->
	<table class="table table-hover" id="TabelTampilData">
		<thead align="center">
			<tr>
				<th>Aksi</th>
				<th>Kode Penjualan</th>
				<th>Tanggal Penjualan</th>
				<th>Cabang</th>
				<th>Posession</th>
				<th>Hardware</th>
				<th>Pengepul</th>
				<th>Harga Jual</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($TampilDataTrxPenjualanHardware as $Baris) : ?>
		<tr>
			<td align="center"> 
				<a href="UbahDataTrxPenjualanHardware.php?kode_penjualan_hardware=<?php echo $Baris["kode_penjualan_hardware"] ?>"  data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fas fa-edit"></i></a>
				<a href="HapusDataTrxPenjualanHardware.php?kode_penjualan_hardware=<?php echo $Baris["kode_penjualan_hardware"] ?>"  data-toggle="tooltip" data-placement="bottom" title="Hapus Data" onclick="return confirm('Yakin Data Akan Dihapus?');"><i class="fas fa-trash"></i></a>
			</td>
			<td><?php echo $Baris["kode_penjualan_hardware"] ?></td>
			<td><?php echo date('d F Y', strtotime($Baris["tanggal_penjualan_hardware"])); ?></td>
			<td><?php echo $Baris["nama_cabang"] ?></td>
			<td><?php echo $Baris["nama_posession"] ?></td>
			<td><?php echo $Baris["nama_hardware"] ?></td>
			<td><?php echo $Baris["nama_pengepul"] ?></td>
			<td><?php echo number_format($Baris['harga_jual_hardware'], 0, ',', '.'); ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<!-- Akhir Tampil Data -->

</div>

<!-- Awal Java Script -->
<script src="../library/jquery/jquery.js"></script>
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
</html>