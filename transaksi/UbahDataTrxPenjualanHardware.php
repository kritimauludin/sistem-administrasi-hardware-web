<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$KodePenjualan	= $_GET["kode_penjualan_hardware"];

$UbahDataTrxPenjualanHardware = Query("SELECT trx_penjualan_hardware.kode_penjualan_hardware, trx_penjualan_hardware.tanggal_penjualan_hardware, trx_peremajaan_hardware.kode_peremajaan_hardware, trx_peremajaan_hardware.serial_number, mst_cabang.kode_cabang, mst_cabang.nama_cabang, mst_divisi.kode_divisi, mst_divisi.nama_divisi, mst_posession.kode_posession, mst_posession.nama_posession, mst_hardware.kode_hardware, mst_hardware.nama_hardware, mst_pengepul.kode_pengepul, mst_pengepul.nama_pengepul, trx_penjualan_hardware.harga_jual_hardware
	FROM trx_penjualan_hardware
	INNER JOIN trx_peremajaan_hardware ON trx_penjualan_hardware.kode_peremajaan_hardware = trx_peremajaan_hardware.kode_peremajaan_hardware
	INNER JOIN mst_cabang ON trx_penjualan_hardware.kode_cabang = mst_cabang.kode_cabang
	INNER JOIN mst_divisi ON trx_penjualan_hardware.kode_divisi = mst_divisi.kode_divisi
	INNER JOIN mst_posession ON trx_penjualan_hardware.kode_posession = mst_posession.kode_posession
	INNER JOIN mst_hardware ON trx_penjualan_hardware.kode_hardware = mst_hardware.kode_hardware
	INNER JOIN mst_pengepul ON trx_penjualan_hardware.kode_pengepul = mst_pengepul.kode_pengepul
	WHERE kode_penjualan_hardware = '$KodePenjualan'")[0];

if (isset($_POST["TombolUbah"])) {
	if (UbahDataTrxPenjualanHardware($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Diubah');
				document.location.href='FormDataTrxPenjualanHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah');
				document.location.href='FormDataTrxPenjualanHardware.php';
			</script>
		";
	}
}

$TampilDataSerialNumber = Query("SELECT trx_peremajaan_hardware.kode_peremajaan_hardware, trx_peremajaan_hardware.serial_number, mst_cabang.kode_cabang, mst_cabang.nama_cabang, mst_divisi.kode_divisi, mst_divisi.nama_divisi, mst_posession.kode_posession, mst_posession.nama_posession, mst_hardware.kode_hardware, mst_hardware.nama_hardware, mst_vendor.kode_vendor, mst_vendor.nama_vendor
	FROM trx_peremajaan_hardware
	INNER JOIN mst_hardware ON trx_peremajaan_hardware.kode_hardware = mst_hardware.kode_hardware
	INNER JOIN mst_cabang ON trx_peremajaan_hardware.kode_cabang = mst_cabang.kode_cabang
	INNER JOIN mst_divisi ON trx_peremajaan_hardware.kode_divisi = mst_divisi.kode_divisi
	INNER JOIN mst_posession ON trx_peremajaan_hardware.kode_posession = mst_posession.kode_posession
	INNER JOIN mst_vendor ON trx_peremajaan_hardware.kode_vendor = mst_vendor.kode_vendor
	WHERE trx_peremajaan_hardware.status = 'O' ORDER BY kode_peremajaan_hardware ASC");

$TampilDataMstPengepul = Query("SELECT * FROM mst_pengepul ORDER BY kode_pengepul ASC");

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
		<h2>Ubah Data Penjualan Hardware</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodePenjualan" class="col-sm-2 col-form-label">Kode Penjualan</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodePenjualan" name="kode_penjualan_hardware" value="<?php echo $UbahDataTrxPenjualanHardware["kode_penjualan_hardware"] ?>" readonly/>
			</div>
		</div>
		<div class="form-group row Tanggal">
			<label for="TanggalPenjualan" class="col-sm-2 col-form-label">Tanggal Penjualan</label>
			<div class="input-group col-sm-4">
				<input type="text" class="form-control" id="TanggalPenjualan" name="tanggal_penjualan_hardware" value="<?php echo $UbahDataTrxPenjualanHardware["tanggal_penjualan_hardware"] ?>" placeholder="YYYY-MM-DD" autocomplete="off" required oninvalid="this.setCustomValidity('Tanggal Penjualan Harus Diisi.')" oninput="setCustomValidity('')"/>
				<div class="input-group-append">
					<span class="input-group-text"><i class="fas fa-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label for="SerialNumber" class="col-sm-2 col-form-label">Serial Number</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodePeremajaan" name="kode_peremajaan_hardware" value="<?php echo $UbahDataTrxPenjualanHardware["kode_peremajaan_hardware"] ?>"/>
				<input type="text" class="form-control" id="SerialNumber" name="serial_number" placeholder="Serial Number Hardware" value="<?php echo $UbahDataTrxPenjualanHardware["serial_number"] ?>" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpSerialNumber" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalSerialNumber">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaCabang" class="col-sm-2 col-form-label">Nama Cabang</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeCabang" name="kode_cabang" value="<?php echo $UbahDataTrxPenjualanHardware["kode_cabang"] ?>"/>
				<input type="text" class="form-control" id="NamaCabang" name="nama_cabang" placeholder="Nama Cabang" value="<?php echo $UbahDataTrxPenjualanHardware["nama_cabang"] ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaDivisi" class="col-sm-2 col-form-label">Nama Divisi</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeDivisi" name="kode_divisi" value="<?php echo $UbahDataTrxPenjualanHardware["kode_divisi"] ?>"/>
				<input type="text" class="form-control" id="NamaDivisi" name="nama_divisi" placeholder="Nama Divisi" value="<?php echo $UbahDataTrxPenjualanHardware["nama_divisi"] ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPosession" class="col-sm-2 col-form-label">Nama Posession</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodePosession" name="kode_posession" value="<?php echo $UbahDataTrxPenjualanHardware["kode_posession"] ?>"/>
				<input type="text" class="form-control" id="NamaPosession" name="nama_posession" placeholder="Nama Posession" value="<?php echo $UbahDataTrxPenjualanHardware["nama_posession"] ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaHardware" class="col-sm-2 col-form-label">Nama Hardware</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeHardware" name="kode_hardware" value="<?php echo $UbahDataTrxPenjualanHardware["kode_hardware"] ?>"/>
				<input type="text" class="form-control" id="NamaHardware" name="nama_hardware" placeholder="Nama Hardware" value="<?php echo $UbahDataTrxPenjualanHardware["nama_hardware"] ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPengepul" class="col-sm-2 col-form-label">Nama Pengepul</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodePengepul" name="kode_pengepul" value="<?php echo $UbahDataTrxPenjualanHardware["kode_pengepul"] ?>"/>
				<input type="text" class="form-control" id="NamaPengepul" name="nama_pengepul" placeholder="Pilih Nama Pengepul" value="<?php echo $UbahDataTrxPenjualanHardware["nama_pengepul"] ?>" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpPengepul" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalPengepul">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="HargaJualHardware" class="col-sm-2 col-form-label">Harga Jual Hardware</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="HargaJualHardware" name="harga_jual_hardware" placeholder="Harga Jual Hardware" autocomplete="off" required oninvalid="this.setCustomValidity('Harga Jual Hardware Harus Diisi.')" oninput="setCustomValidity('')" value="<?php echo $UbahDataTrxPenjualanHardware["harga_jual_hardware"] ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolUbah" name="TombolUbah" class="btn btn-outline-success">Ubah</button>
				<a href="../transaksi/FormDataTrxPenjualanHardware.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
			</div>
		</div>
	</form>

	<!-- Awal Modal Serial Number -->
	<div class="modal fade" id="ModalSerialNumber" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Serial Number Hardware</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpSerialNumber" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Peremajaan</th>
								<th>Serial Number</th>
								<th>Nama Hardware</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataSerialNumber as $Baris) : ?>
							<tr class="PilihDataSerialNumber" data-kodeperemajaan="<?php echo $Baris['kode_peremajaan_hardware']; ?>"
								class="PilihDataSerialNumber" data-serialnumber="<?php echo $Baris['serial_number']; ?>"
								class="PilihDataSerialNumber" data-kodehardware="<?php echo $Baris['kode_hardware']; ?>"
								class="PilihDataSerialNumber" data-namahardware="<?php echo $Baris['nama_hardware']; ?>"
								class="PilihDataSerialNumber" data-kodecabang="<?php echo $Baris['kode_cabang']; ?>"
								class="PilihDataSerialNumber" data-namacabang="<?php echo $Baris['nama_cabang']; ?>"
								class="PilihDataSerialNumber" data-kodedivisi="<?php echo $Baris['kode_divisi']; ?>"
								class="PilihDataSerialNumber" data-namadivisi="<?php echo $Baris['nama_divisi']; ?>"
								class="PilihDataSerialNumber" data-kodeposession="<?php echo $Baris['kode_posession']; ?>"
								class="PilihDataSerialNumber" data-namaposession="<?php echo $Baris['nama_posession']; ?>">
								<td><?php echo $Baris["kode_peremajaan_hardware"]; ?></td>
								<td><?php echo $Baris["serial_number"]; ?></td>
								<td><?php echo $Baris["nama_hardware"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Serial Number -->

	<!-- Awal Modal Pengepul -->
	<div class="modal fade" id="ModalPengepul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Pengepul</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpPengepul" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Pengepul</th>
								<th>Nama Pengepul</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstPengepul as $Baris) : ?>
							<tr class="PilihDataPengepul" data-kodepengepul="<?php echo $Baris['kode_pengepul']; ?>"
								class="PilihDataPengepul" data-namapengepul="<?php echo $Baris['nama_pengepul']; ?>">
								<td><?php echo $Baris["kode_pengepul"]; ?></td>
								<td><?php echo $Baris["nama_pengepul"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Pengepul -->

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
		$('.Tanggal #TanggalPenjualan').datepicker({
	       'format' : 'yyyy-mm-dd',
	       'todayHighlight' : true,
	       'autoclose' : true
	    });
	});

	// Modal Serial Number
	$(document).on('click', '.PilihDataSerialNumber', function (e) {
		document.getElementById("KodePeremajaan").value = $(this).attr('data-kodeperemajaan');
        document.getElementById("SerialNumber").value = $(this).attr('data-serialnumber');
        document.getElementById("KodeHardware").value = $(this).attr('data-kodehardware');
        document.getElementById("NamaHardware").value = $(this).attr('data-namahardware');
        document.getElementById("KodeCabang").value = $(this).attr('data-kodecabang');
        document.getElementById("NamaCabang").value = $(this).attr('data-namacabang');
        document.getElementById("KodeDivisi").value = $(this).attr('data-kodedivisi');
        document.getElementById("NamaDivisi").value = $(this).attr('data-namadivisi');
        document.getElementById("KodePosession").value = $(this).attr('data-kodeposession');
        document.getElementById("NamaPosession").value = $(this).attr('data-namaposession');
        $('#ModalSerialNumber').modal('hide');
    });

	$(function(){
		$("#TableLookUpSerialNumber").dataTable();
	});

	// Modal Pengepul
	$(document).on('click', '.PilihDataPengepul', function (e) {
		document.getElementById("KodePengepul").value = $(this).attr('data-kodepengepul');
        document.getElementById("NamaPengepul").value = $(this).attr('data-namapengepul');
        $('#ModalPengepul').modal('hide');
    });

	$(function(){
		$("#TableLookUpPengepul").dataTable();
	});

</script>
<!-- Akhir Java Script -->

</body>
</html>