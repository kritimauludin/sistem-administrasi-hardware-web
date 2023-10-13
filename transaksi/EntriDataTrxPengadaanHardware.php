<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

if (isset($_POST["TombolSimpan"])) {
	if (EntriDataTrxPengadaanHardware($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan');
				document.location.href='FormDataTrxPengadaanHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan');
				document.location.href='FormDataTrxPengadaanHardware.php';
			</script>
		";
	}
}

$SQL		= "SELECT max(kode_pengadaan_hardware) AS Kode FROM trx_pengadaan_hardware";
$HasilSQL 	= mysqli_query($Koneksi, $SQL);
$DataSQL 	= mysqli_fetch_array($HasilSQL);
$KodeBaru	= $DataSQL['Kode'];

$NoUrut		= (int) substr($KodeBaru, 8, 7);
$NoUrut++;

$Char		= "PNG.HW.";
$KodeBaru	= $Char . sprintf("%07s", $NoUrut);

$TampilDataMstCabang = Query("SELECT * FROM mst_cabang ORDER BY kode_cabang ASC");

$TampilDataMstDivisi = Query("SELECT * FROM mst_divisi ORDER BY kode_divisi ASC");

$TampilDataMstPosession = Query("SELECT * FROM mst_posession ORDER BY kode_posession ASC");

$TampilDataMstHardware = Query("SELECT * FROM mst_hardware ORDER BY kode_hardware ASC");

$TampilDataMstVendor = Query("SELECT * FROM mst_vendor ORDER BY kode_vendor ASC");


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

</head>
<body>

<!-- Awal Nav Bar -->
<?php include_once ("../library/navbar.php"); ?>
<!-- Akhir Nav Bar-->

<div class="container">
	<div id="JudulForm">
		<h2>Entri Data Pengadaan Hardware</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodePengadaan" class="col-sm-2 col-form-label">Kode Pengadaan</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodePengadaan" name="kode_pengadaan_hardware" value="<?php echo $KodeBaru ?>" readonly/>
			</div>
		</div>
		<div class="form-group row Tanggal">
			<label for="TanggalPengadaan" class="col-sm-2 col-form-label">Tanggal Pengadaan</label>
			<div class="input-group col-sm-4">
				<input type="text" class="form-control" id="TanggalPengadaan" name="tanggal_pengadaan_hardware" placeholder="YYYY-MM-DD" autocomplete="off" require oninvalid="this.setCustomValidity('Tanggal Pengadaan Harus Diisi.')" oninput="setCustomValidity('')"/>
				<div class="input-group-append">
					<span class="input-group-text"><i class="fas fa-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaCabang" class="col-sm-2 col-form-label">Nama Cabang</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodeCabang" name="kode_cabang"/>
				<input type="text" class="form-control" id="NamaCabang" name="nama_cabang" placeholder="Nama Cabang" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpCabang" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalCabang">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaDivisi" class="col-sm-2 col-form-label">Nama Divisi</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodeDivisi" name="kode_divisi"/>
				<input type="text" class="form-control" id="NamaDivisi" name="nama_divisi" placeholder="Nama Divisi" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpDivisi" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalDivisi">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPosession" class="col-sm-2 col-form-label">Nama Posession</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodePosession" name="kode_posession"/>
				<input type="text" class="form-control" id="NamaPosession" name="nama_posession" placeholder="Nama Posession" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpPosession" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalPosession">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaHardware" class="col-sm-2 col-form-label">Nama Hardware</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodeHardware" name="kode_hardware"/>
				<input type="text" class="form-control" id="NamaHardware" name="nama_hardware" placeholder="Nama Hardware" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpHardware" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalHardware">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="SerialNumber" class="col-sm-2 col-form-label">Serial Number</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="SerialNumber" name="serial_number" placeholder="Masukan Serial Number Hardware" autocomplete="off" maxlength="30" required oninvalid="this.setCustomValidity('Serial Number Harus Diisi.')" oninput="setCustomValidity('')"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label>
			<div class="col-sm-4">
				<textarea class="form-control" name="keterangan" id="Keterangan" cols="50" rows="4" maxlength="200" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi.')" oninput="setCustomValidity('')"></textarea>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaVendor" class="col-sm-2 col-form-label">Nama Vendor</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodeVendor" name="kode_vendor"/>
				<input type="text" class="form-control" id="NamaVendor" name="nama_vendor" placeholder="Nama Vendor" readonly/>
				<input type="hidden" class="form-control" id="Status" name="status" value="O"/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpVendor" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalVendor">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="HargaHardware" class="col-sm-2 col-form-label">Harga Hardware</label>
			<div class="input-group col-sm-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="number" class="form-control" id="HargaHardware" name="harga_hardware" autocomplete="off" maxlength="30" required oninvalid="this.setCustomValidity('Harga Hardware Harus Diisi.')" oninput="setCustomValidity('')"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolSimpan" name="TombolSimpan" class="btn btn-outline-success">Simpan</button>
				<a href="../transaksi/FormDataTrxPengadaanHardware.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
			</div>
		</div>
	</form>

	<!-- Awal Modal Cabang -->
	<div class="modal fade" id="ModalCabang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Cabang</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpCabang" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Cabang</th>
								<th>Nama Cabang</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstCabang as $Baris) : ?>
							<tr class="PilihDataCabang" data-kodecabang="<?php echo $Baris['kode_cabang']; ?>"
								class="PilihDataCabang" data-namacabang="<?php echo $Baris['nama_cabang']; ?>">
								<td><?php echo $Baris["kode_cabang"]; ?></td>
								<td><?php echo $Baris["nama_cabang"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Cabang -->

	<!-- Awal Modal Divisi -->
	<div class="modal fade" id="ModalDivisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Divisi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpDivisi" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Divisi</th>
								<th>Nama Divisi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstDivisi as $Baris) : ?>
							<tr class="PilihDataDivisi" data-kodedivisi="<?php echo $Baris['kode_divisi']; ?>"
								class="PilihDataDivisi" data-namadivisi="<?php echo $Baris['nama_divisi']; ?>">
								<td><?php echo $Baris["kode_divisi"]; ?></td>
								<td><?php echo $Baris["nama_divisi"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Divisi -->

	<!-- Awal Modal Posession -->
	<div class="modal fade" id="ModalPosession" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Posession</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpPosession" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Posession</th>
								<th>Nama Posession</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstPosession as $Baris) : ?>
							<tr class="PilihDataPosession" data-kodeposession="<?php echo $Baris['kode_posession']; ?>"
								class="PilihDataPosession" data-namaposession="<?php echo $Baris['nama_posession']; ?>">
								<td><?php echo $Baris["kode_posession"]; ?></td>
								<td><?php echo $Baris["nama_posession"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Posession -->

	<!-- Awal Modal Hardware -->
	<div class="modal fade" id="ModalHardware" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Hardware</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpHardware" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Hardware</th>
								<th>Nama Hardware</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstHardware as $Baris) : ?>
							<tr class="PilihDataHardware" data-kodehardware="<?php echo $Baris['kode_hardware']; ?>"
								class="PilihDataHardware" data-namahardware="<?php echo $Baris['nama_hardware']; ?>">
								<td><?php echo $Baris["kode_hardware"]; ?></td>
								<td><?php echo $Baris["nama_hardware"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Hardware -->

	<!-- Awal Modal Vendor -->
	<div class="modal fade" id="ModalVendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Vendor</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpVendor" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Vendor</th>
								<th>Nama Vendor</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstVendor as $Baris) : ?>
							<tr class="PilihDataVendor" data-kodevendor="<?php echo $Baris['kode_vendor']; ?>"
								class="PilihDataVendor" data-namavendor="<?php echo $Baris['nama_vendor']; ?>">
								<td><?php echo $Baris["kode_vendor"]; ?></td>
								<td><?php echo $Baris["nama_vendor"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Vendor -->

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
	$(function(){
		$('.Tanggal #TanggalPengadaan').datepicker({
	       'format' : 'yyyy-mm-dd',
	       'todayHighlight' : true,
	       'autoclose' : true
	    });
	});
		
	// Modal Cabang
	$(document).on('click', '.PilihDataCabang', function (e) {
		document.getElementById("KodeCabang").value = $(this).attr('data-kodecabang');
        document.getElementById("NamaCabang").value = $(this).attr('data-namacabang');
        $('#ModalCabang').modal('hide');
    });

	$(function(){
		$("#TableLookUpCabang").dataTable();
	});

	// Modal Divisi
	$(document).on('click', '.PilihDataDivisi', function (e) {
		document.getElementById("KodeDivisi").value = $(this).attr('data-kodedivisi');
        document.getElementById("NamaDivisi").value = $(this).attr('data-namadivisi');
        $('#ModalDivisi').modal('hide');
    });

    $(function(){
		$("#TableLookUpDivisi").dataTable();
	});

    // Modal Posession
	$(document).on('click', '.PilihDataPosession', function (e) {
		document.getElementById("KodePosession").value = $(this).attr('data-kodeposession');
        document.getElementById("NamaPosession").value = $(this).attr('data-namaposession');
        $('#ModalPosession').modal('hide');
    });

	$(function(){
		$("#TableLookUpPosession").dataTable();
	});

	// Modal Hardware
	$(document).on('click', '.PilihDataHardware', function (e) {
		document.getElementById("KodeHardware").value = $(this).attr('data-kodehardware');
        document.getElementById("NamaHardware").value = $(this).attr('data-namahardware');
        $('#ModalHardware').modal('hide');
    });

	$(function(){
		$("#TableLookUpHardware").dataTable();
	});

	// Modal Vendor
	$(document).on('click', '.PilihDataVendor', function (e) {
		document.getElementById("KodeVendor").value = $(this).attr('data-kodevendor');
        document.getElementById("NamaVendor").value = $(this).attr('data-namavendor');
        $('#ModalVendor').modal('hide');
    });

	$(function(){
		$("#TableLookUpVendor").dataTable();
	});

</script>
<!-- Akhir Java Script -->

</body>
</html>