<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilDataMstCabang = Query("SELECT mst_cabang.kode_cabang, mst_cabang.nama_cabang, mst_cabang.alamat, mst_kabupaten_kota.nama_kabupaten_kota, mst_cabang.no_telepon
	FROM mst_cabang
	INNER JOIN mst_kabupaten_kota ON mst_cabang.kode_kabupaten_kota = mst_kabupaten_kota.kode_kabupaten_kota
	ORDER BY kode_cabang ASC");

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
		<h2>Data Master Cabang</h2>
		<hr>
	</div>
</div>

<div class="container-fluid" id="TampilDataMasterCabang">
	<div class="container-fluid" id="TambahData">
		<a href="../master/EntriDataMstCabang.php"><button type="button" class=" btn btn-outline-success"><i class="fa fa-plus-circle"></i> Tambah Data
		</button></a>
	</div>
	<hr>
	<!-- Awal Tampil Data -->
	<table class="table table-hover" id="TabelTampilData">
		<thead align="center">
			<tr>
				<th>Aksi</th>
				<th>Kode Cabang</th>
				<th>Nama Cabang</th>
				<th>Alamat</th>
				<th>Kabupaten / Kota</th>
				<th>No Telepon</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($TampilDataMstCabang as $Baris) : ?>
		<tr>
			<td align="center"> 
				<a href="UbahDataMstCabang.php?kode_cabang=<?php echo $Baris["kode_cabang"]; ?>" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fas fa-edit"></i></a>
				<a href="HapusDataMstCabang.php?kode_cabang=<?php echo $Baris["kode_cabang"]; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" onclick="return confirm('Yakin Data Akan Dihapus?');"><i class="fas fa-trash"></i></a>
			</td>
			<td><?php echo $Baris["kode_cabang"] ?></td>
			<td><?php echo $Baris["nama_cabang"] ?></td>
			<td><?php echo $Baris["alamat"] ?></td>
			<td><?php echo $Baris["nama_kabupaten_kota"] ?></td>
			<td><?php echo $Baris["no_telepon"] ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<!-- Akhir Tampil Data -->
</div>

<div class="modal fade" id="ModalDetailCabang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

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