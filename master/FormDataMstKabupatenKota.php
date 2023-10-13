<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilDataMstKabupatenKota = Query("SELECT * FROM mst_kabupaten_kota ORDER BY kode_kabupaten_kota ASC");

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
		<h2>Data Master Kabupaten / Kota</h2>
		<hr>
	</div>
</div>

<div class="container-fluid" id="TampilDataMasterKabupatenKota">
	<div class="container-fluid" id="TambahData">
		<a href="../master/EntriDataMstKabupatenKota.php"><button type="button" class=" btn btn-outline-success"><i class="fas fa-plus-circle"></i> Tambah Data
		</button></a>
	</div>
	<hr>
	<!-- Awal Tampil Data -->
	<table class="table table-hover" id="TabelTampilData">
		<thead align="center">
			<tr>
				<th>Aksi</th>
				<th>Kode Kabupaten / Kota</th>
				<th>Nama Kabupaten / Kota</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($TampilDataMstKabupatenKota as $Baris) : ?>
		<tr>
			<td align="center">
				<a href="UbahDataMstKabupatenKota.php?kode_kabupaten_kota=<?php echo $Baris["kode_kabupaten_kota"] ?>" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fas fa-edit"></i></a>
				<a href="HapusDataMstKabupatenKota.php?kode_kabupaten_kota=<?php echo $Baris["kode_kabupaten_kota"] ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" onclick="return confirm('Yakin Data Akan Dihapus?');"><i class="fas fa-trash"></i></a>
			</td>
			<td><?php echo $Baris["kode_kabupaten_kota"] ?></td>
			<td><?php echo $Baris["nama_kabupaten_kota"] ?></td>
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