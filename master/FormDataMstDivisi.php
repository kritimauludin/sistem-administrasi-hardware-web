<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilDataMstDivisi = Query("SELECT * FROM mst_divisi ORDER BY kode_divisi ASC");

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
		<h2>Data Master Divisi</h2>
		<hr>
	</div>
</div>

<div class="container-fluid" id="TampilDataMasterDivisi">
	<div class="container-fluid" id="TambahData">
		<a href="../master/EntriDataMstDivisi.php"><button type="button" class=" btn btn-outline-success"><i class="fas fa-plus-circle"></i> Tambah Data
		</button></a>
	</div>
	<hr>
	<!-- Awal Tampil Data -->
	<table class="table table-hover" id="TabelTampilData">
		<thead align="center">
			<tr>
				<th>Aksi</th>
				<th>Kode Divisi</th>
				<th>Nama Divisi</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($TampilDataMstDivisi as $Baris) : ?>
		<tr>
			<td align="center">
				<a href="UbahDataMstDivisi.php?kode_divisi=<?php echo $Baris["kode_divisi"] ?>"data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fas fa-edit"></i></a>
				<a href="HapusDataMstDivisi.php?kode_divisi=<?php echo $Baris["kode_divisi"] ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" onclick="return confirm('Yakin Data Akan Dihapus?');"><i class="fas fa-trash"></i></a>
			</td>
			<td><?php echo $Baris["kode_divisi"] ?></td>
			<td><?php echo $Baris["nama_divisi"] ?></td>
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