<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilDataMstVendor = Query("SELECT mst_vendor.kode_vendor, mst_vendor.nama_vendor, mst_vendor.alamat, mst_kabupaten_kota.nama_kabupaten_kota, mst_vendor.no_telepon
	FROM mst_vendor
	INNER JOIN mst_kabupaten_kota ON mst_vendor.kode_kabupaten_kota = mst_kabupaten_kota.kode_kabupaten_kota
	ORDER BY kode_vendor ASC");

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
		<h2>Data Master Vendor</h2>
		<hr>
	</div>
</div>

<div class="container-fluid" id="TampilDataMasterCabang">
	<div class="container-fluid" id="TambahData">
		<a href="../master/EntriDataMstVendor.php"><button type="button" class=" btn btn-outline-success"><i class="fas fa-plus-circle"></i> Tambah Data
		</button></a>
	</div>
	<hr>
	<!-- Awal Tampil Data -->
	<table class="table table-hover" id="TabelTampilData">
		<thead align="center">
			<tr>
				<th>Aksi</th>
				<th>Kode Vendor</th>
				<th>Nama Vendor</th>
				<th>Alamat</th>
				<th>Kabupaten / Kota</th>
				<th>No Telepon</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($TampilDataMstVendor as $Baris) : ?>
		<tr>
			<td align="center"> 
				<a href="UbahDataMstVendor.php?kode_vendor=<?php echo $Baris["kode_vendor"] ?>" data-toggle="tooltip" data-placement="bottom" title="Ubah Data"><i class="fas fa-edit"></i></a>
				<a href="HapusDataMstVendor.php?kode_vendor=<?php echo $Baris["kode_vendor"] ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" onclick="return confirm('Yakin Data Akan Dihapus?');"><i class="fas fa-trash"></i></a>
			</td>
			<td><?php echo $Baris["kode_vendor"] ?></td>
			<td><?php echo $Baris["nama_vendor"] ?></td>
			<td><?php echo $Baris["alamat"] ?></td>
			<td><?php echo $Baris["nama_kabupaten_kota"] ?></td>
			<td><?php echo $Baris["no_telepon"] ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<!-- Akhir Tampil Data -->

	<!-- Awal Modal Detail Vendor -->
	<div class="modal fade" id="ModalDetailVendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Detail Vendor</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpDetailVendor" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Nama Propinsi</th>
								<th>Nama Kabupaten / Kota</th>
								<th>Website</th>
								<th>Nomor Telepon</th>
								<th>Alamat Email</th>
							</tr>
						</thead>
						<tbody>
						<?php while ($BarisVendor = mysqli_fetch_assoc($TampilDataDetailMstVendor)) { ?>
							<tr>
								<td><?php echo $BarisVendor["nama_propinsi"] ?></td>
								<td><?php echo $BarisVendor["nama_kabupaten_kota"] ?></td>
								<td><?php echo $BarisVendor["website"] ?></td>
								<td><?php echo $BarisVendor["no_telepon"] ?></td>
								<td><?php echo $BarisVendor["alamat_email"] ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Detail Vendor -->

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