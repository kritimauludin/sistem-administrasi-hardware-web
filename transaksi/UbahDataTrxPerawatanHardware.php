<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$KodePerawatan	= $_GET["kode_perawatan_hardware"];

$UbahDataTrxPerawatanHardware = Query("SELECT trx_perawatan_hardware.kode_perawatan_hardware, trx_perawatan_hardware.tanggal_perawatan_hardware, trx_pengadaan_hardware.kode_pengadaan_hardware, trx_pengadaan_hardware.serial_number, mst_cabang.kode_cabang, mst_cabang.nama_cabang, mst_divisi.kode_divisi, mst_divisi.nama_divisi, mst_posession.kode_posession, mst_posession.nama_posession, mst_hardware.kode_hardware, mst_hardware.nama_hardware, trx_perawatan_hardware.keterangan, trx_perawatan_hardware.biaya_perawatan, mst_pic_it.id, mst_pic_it.nama_pic_it
	FROM trx_perawatan_hardware
	INNER JOIN trx_pengadaan_hardware ON trx_perawatan_hardware.kode_pengadaan_hardware = trx_pengadaan_hardware.kode_pengadaan_hardware
	INNER JOIN mst_cabang ON trx_perawatan_hardware.kode_cabang = mst_cabang.kode_cabang
	INNER JOIN mst_divisi ON trx_perawatan_hardware.kode_divisi = mst_divisi.kode_divisi
	INNER JOIN mst_posession ON trx_perawatan_hardware.kode_posession = mst_posession.kode_posession
	INNER JOIN mst_hardware ON trx_perawatan_hardware.kode_hardware = mst_hardware.kode_hardware
	INNER JOIN mst_pic_it ON trx_perawatan_hardware.id = mst_pic_it.id
	WHERE kode_perawatan_hardware = '$KodePerawatan'")[0];

if (isset($_POST["TombolUbah"])) {
	if (UbahDataTrxPerawatanHardware($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Diubah');
				document.location.href='FormDataTrxPerawatanHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah');
				document.location.href='FormDataTrxPerawatanHardware.php';
			</script>
		";
	}
}

$HariIni = date('Y-m-d');
$TampilDataSerialNumber = Query("SELECT trx_pengadaan_hardware.kode_pengadaan_hardware, trx_pengadaan_hardware.serial_number,  mst_cabang.kode_cabang, mst_cabang.nama_cabang, mst_divisi.kode_divisi, mst_divisi.nama_divisi, mst_posession.kode_posession, mst_posession.nama_posession,mst_hardware.kode_hardware, mst_hardware.nama_hardware
	FROM trx_pengadaan_hardware
	INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
	INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
	INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
	INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
	WHERE trx_pengadaan_hardware.status = 'O' ORDER BY kode_pengadaan_hardware ASC");

$TampilDataMstPICIT = Query("SELECT * FROM mst_pic_it ORDER BY id ASC");

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
		<h2>Ubah Data Perawatan Hardware</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodePerawatan" class="col-sm-2 col-form-label">Kode Perawatan</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodePerawatan" name="kode_perawatan_hardware" value="<?php echo $UbahDataTrxPerawatanHardware["kode_perawatan_hardware"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row Tanggal">
			<label for="TanggalPerawatan" class="col-sm-2 col-form-label">Tanggal Perawatan</label>
			<div class="input-group col-sm-4">
				<input type="text" class="form-control" id="TanggalPerawatan" name="tanggal_perawatan_hardware" placeholder="YYYY-MM-DD" value="<?php echo $UbahDataTrxPerawatanHardware["tanggal_perawatan_hardware"]; ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Tanggal Perawatan Harus Diisi.')" oninput="setCustomValidity('')"/>
				<div class="input-group-append">
					<span class="input-group-text"><i class="fas fa-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label for="SerialNumber" class="col-sm-2 col-form-label">Serial Number</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodePengadaan" name="kode_pengadaan_hardware" value="<?php echo $UbahDataTrxPerawatanHardware["kode_pengadaan_hardware"]; ?>"/>
				<input type="text" class="form-control" id="SerialNumber" name="serial_number" placeholder="Serial Number Hardware" value="<?php echo $UbahDataTrxPerawatanHardware["serial_number"]; ?>" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpSerialNumber" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalSerialNumber">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaCabang" class="col-sm-2 col-form-label">Nama Cabang</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeCabang" name="kode_cabang" value="<?php echo $UbahDataTrxPerawatanHardware["kode_cabang"]; ?>"/>
				<input type="text" class="form-control" id="NamaCabang" name="nama_cabang" placeholder="Nama Cabang" value="<?php echo $UbahDataTrxPerawatanHardware["nama_cabang"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaDivisi" class="col-sm-2 col-form-label">Nama Divisi</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeDivisi" name="kode_divisi" value="<?php echo $UbahDataTrxPerawatanHardware["kode_divisi"]; ?>"/>
				<input type="text" class="form-control" id="NamaDivisi" name="nama_divisi" placeholder="Nama Divisi" value="<?php echo $UbahDataTrxPerawatanHardware["nama_divisi"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPosession" class="col-sm-2 col-form-label">Nama Posession</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodePosession" name="kode_posession" value="<?php echo $UbahDataTrxPerawatanHardware["kode_posession"]; ?>"/>
				<input type="text" class="form-control" id="NamaPosession" name="nama_posession" placeholder="Nama Posession" value="<?php echo $UbahDataTrxPerawatanHardware["nama_posession"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaHardware" class="col-sm-2 col-form-label">Nama Hardware</label>
			<div class="col-sm-4"/>
				<input type="hidden" class="form-control" id="KodeHardware" name="kode_hardware" value="<?php echo $UbahDataTrxPerawatanHardware["kode_hardware"]; ?>">
				<input type="text" class="form-control" id="NamaHardware" name="nama_hardware" placeholder="Nama Hardware" value="<?php echo $UbahDataTrxPerawatanHardware["nama_hardware"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label>
			<div class="col-sm-4">
				<textarea class="form-control" name="keterangan" id="Keterangan" cols="50" rows="4" maxlength="200" required oninvalid="this.setCustomValidity('Keterangan Harus Diisi.')" oninput="setCustomValidity('')"><?php echo $UbahDataTrxPerawatanHardware["keterangan"]; ?></textarea>
			</div>
		</div>
		<div class="form-group row">
			<label for="BiayaPerawatan" class="col-sm-2 col-form-label">Biaya Perawatan</label>
			<div class="input-group col-sm-4">
				<div class="input-group-prepend">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="number" class="form-control" id="BiayaPerawatan" name="biaya_perawatan" autocomplete="off" maxlength="30" required oninvalid="this.setCustomValidity('Biaya Perawatan Harus Diisi.')" oninput="setCustomValidity('')" value="<?php echo $UbahDataTrxPerawatanHardware["biaya_perawatan"]; ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPICIT" class="col-sm-2 col-form-label">Nama PIC IT</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodePICIT" name="id" value="<?php echo $UbahDataTrxPerawatanHardware["id"]; ?>"/>
				<input type="text" class="form-control" id="NamaPICIT" name="nama_pic_it" placeholder="Nama PIC IT" value="<?php echo $UbahDataTrxPerawatanHardware["nama_pic_it"]; ?>" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpPICIT" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalPICIT">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolUbah" name="TombolUbah" class="btn btn-outline-success">Ubah</button>
				<a href="../transaksi/FormDataTrxPerawatanHardware.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
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
								<th>Kode Pengadaan</th>
								<th>Serial Number</th>
								<th>Nama Hardware</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataSerialNumber as $Baris) : ?>
							<tr class="PilihDataSerialNumber" data-kodepengadaan="<?php echo $Baris['kode_pengadaan_hardware']; ?>"
								class="PilihDataSerialNumber" data-serialnumber="<?php echo $Baris['serial_number']; ?>"
								class="PilihDataSerialNumber" data-kodehardware="<?php echo $Baris['kode_hardware']; ?>"
								class="PilihDataSerialNumber" data-namahardware="<?php echo $Baris['nama_hardware']; ?>"
								class="PilihDataSerialNumber" data-kodecabang="<?php echo $Baris['kode_cabang']; ?>"
								class="PilihDataSerialNumber" data-namacabang="<?php echo $Baris['nama_cabang']; ?>"
								class="PilihDataSerialNumber" data-kodedivisi="<?php echo $Baris['kode_divisi']; ?>"
								class="PilihDataSerialNumber" data-namadivisi="<?php echo $Baris['nama_divisi']; ?>"
								class="PilihDataSerialNumber" data-kodeposession="<?php echo $Baris['kode_posession']; ?>"
								class="PilihDataSerialNumber" data-namaposession="<?php echo $Baris['nama_posession']; ?>">
								<td><?php echo $Baris["kode_pengadaan_hardware"]; ?></td>
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

	<!-- Awal Modal PIC IT -->
	<div class="modal fade" id="ModalPICIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master PIC IT</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpPICIT" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode PIC IT</th>
								<th>Nama PIC IT</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstPICIT as $Baris) : ?>
							<tr class="PilihDataPICIT" data-kodepicit="<?php echo $Baris['id']; ?>"
								class="PilihDataPICIT" data-namapicit="<?php echo $Baris['nama_pic_it']; ?>">
								<td><?php echo $Baris["id"]; ?></td>
								<td><?php echo $Baris["nama_pic_it"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal PIC IT -->


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
		$('.Tanggal #TanggalPerawatan').datepicker({
	       'format' : 'yyyy-mm-dd',
	       'todayHighlight' : true,
	       'autoclose' : true
	    });
	});

	// Modal Serial Number
	$(document).on('click', '.PilihDataSerialNumber', function (e) {
		document.getElementById("KodePengadaan").value = $(this).attr('data-kodepengadaan');
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

	// Modal PIC IT
	$(document).on('click', '.PilihDataPICIT', function (e) {
		document.getElementById("KodePICIT").value = $(this).attr('data-kodepicit');
        document.getElementById("NamaPICIT").value = $(this).attr('data-namapicit');
        $('#ModalPICIT').modal('hide');
    });

	$(function(){
		$("#TableLookUpPICIT").dataTable();
	});

</script>
<!-- Akhir Java Script -->

</body>
</html>