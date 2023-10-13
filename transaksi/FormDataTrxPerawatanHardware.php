<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilDataTrxPerawatanHardware = Query("SELECT trx_perawatan_hardware.kode_perawatan_hardware, trx_perawatan_hardware.tanggal_perawatan_hardware, trx_pengadaan_hardware.serial_number, mst_cabang.nama_cabang, mst_posession.nama_posession, mst_hardware.nama_hardware, trx_perawatan_hardware.keterangan, trx_perawatan_hardware.biaya_perawatan, mst_pic_it.nama_pic_it
	FROM trx_perawatan_hardware
	INNER JOIN trx_pengadaan_hardware ON trx_perawatan_hardware.kode_pengadaan_hardware = trx_pengadaan_hardware.kode_pengadaan_hardware
	INNER JOIN mst_cabang ON trx_perawatan_hardware.kode_cabang = mst_cabang.kode_cabang
	INNER JOIN mst_posession ON trx_perawatan_hardware.kode_posession = mst_posession.kode_posession
	INNER JOIN mst_hardware ON trx_perawatan_hardware.kode_hardware = mst_hardware.kode_hardware
	INNER JOIN mst_pic_it ON trx_perawatan_hardware.id = mst_pic_it.id
	WHERE trx_pengadaan_hardware.status = 'O' ORDER BY trx_perawatan_hardware.tanggal_perawatan_hardware DESC");

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
		<h2>Data Perawatan Hardware</h2>
		<hr>
	</div>
</div>

<div class="container-fluid" id="TampilDataTransaksiPerawatan">
	<div class="container-fluid" id="TambahData">
		<a href="../transaksi/EntriDataTrxPerawatanHardware.php"><button type="button" class=" btn btn-outline-success"><i class="fas fa-plus-circle"></i> Tambah Data
		</button></a>
	</div>
	<hr>
	<!-- Awal Tampil Data -->
	<table class="table table-hover" id="TabelTampilData">
		<thead align="center">
			<tr>
				<th>Aksi</th>
				<th>Kode Perawatan</th>
				<th>Tanggal Perawatan</th>
				<th>Cabang</th>
				<th>Posession</th>
				<th>Hardware</th>
				<th>Serial Number</th>
				<th>Keterangan</th>
				<th>Biaya Perawatan</th>
				<th>PIC IT</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($TampilDataTrxPerawatanHardware as $Baris) : ?>
		<tr>
			<td align="center"> 
				<a href="UbahDataTrxPerawatanHardware.php?kode_perawatan_hardware=<?php echo $Baris["kode_perawatan_hardware"] ?>"  data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fas fa-edit"></i></a>
				<a href="HapusDataTrxPerawatanHardware.php?kode_perawatan_hardware=<?php echo $Baris["kode_perawatan_hardware"] ?>"  data-toggle="tooltip" data-placement="bottom" title="Hapus Data" onclick="return confirm('Yakin Data Akan Dihapus?');"><i class="fas fa-trash"></i></a>
			</td>
			<td><?php echo $Baris["kode_perawatan_hardware"] ?></td>
			<td><?php echo date('d F Y', strtotime($Baris["tanggal_perawatan_hardware"])); ?></td>
			<td><?php echo $Baris["nama_cabang"] ?></td>
			<td><?php echo $Baris["nama_posession"] ?></td>
			<td><?php echo $Baris["nama_hardware"] ?></td>
			<td><?php echo $Baris["serial_number"] ?></td>
			<td><?php echo $Baris["keterangan"] ?></td>
			<td><?php echo number_format($Baris['biaya_perawatan'], 0, ',', '.'); ?></td>
			<td><?php echo $Baris["nama_pic_it"] ?></td>
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