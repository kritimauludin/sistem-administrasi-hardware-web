<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

if (isset($_POST["TombolSimpan"])) {
	if (EntriDataMstVendor($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan');
				document.location.href='FormDataMstVendor.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan');
				document.location.href='FormDataMstVendor.php';
			</script>
		";
	}
}

$SQL		= "SELECT max(kode_vendor) AS Kode FROM mst_vendor";
$HasilSQL 	= mysqli_query($Koneksi, $SQL);
$DataSQL 	= mysqli_fetch_array($HasilSQL);
$KodeBaru	= $DataSQL['Kode'];

$NoUrut		= (int) substr($KodeBaru, 6, 5);
$NoUrut++;

$Char		= "KDVN.";
$KodeBaru	= $Char . sprintf("%05s", $NoUrut);

$TampilDataMstPropinsi = Query("SELECT * FROM mst_propinsi ORDER BY kode_propinsi ASC");

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

<div class="container">
	<div id="JudulForm">
		<h2>Entri Data Master Vendor</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodeVendor" class="col-sm-3 col-form-label">Kode Vendor</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodeVendor" name="kode_vendor" value="<?php echo $KodeBaru ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaVendor" class="col-sm-3 col-form-label">Nama Vendor</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="NamaVendor" name="nama_vendor" placeholder="Masukan Nama Vendor" autocomplete="off" maxlength="100" required oninvalid="this.setCustomValidity('Nama Vendor Harus Diisi.')" oninput="setCustomValidity('')"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="Alamat" class="col-sm-3 col-form-label">Alamat</label>
			<div class="col-sm-4">
				<textarea class="form-control" name="alamat" id="Alamat" cols="50" rows="4" required oninvalid="this.setCustomValidity('Alamat Harus Diisi.')" oninput="setCustomValidity('')"></textarea>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPropinsi" class="col-sm-3 col-form-label">Nama Propinsi</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodePropinsi" name="kode_propinsi"/>
				<input type="text" class="form-control" id="NamaPropinsi" name="nama_propinsi" placeholder="Nama Propinsi" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpPropinsi" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalPropinsi">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaKabupatenKota" class="col-sm-3 col-form-label">Nama Kabupaten / Kota</label>
			<div class="col-sm-3">
				<input type="hidden" class="form-control" id="KodeKabupatenKota" name="kode_kabupaten_kota"/>
				<input type="text" class="form-control" id="NamaKabupatenKota" name="nama_kabupaten_kota" placeholder="Nama Kabupaten / Kota" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpKabupatenKota" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalKabupatenKota">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="Website" class="col-sm-3 col-form-label">Website</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="Website" name="website" placeholder="Masukan Website" maxlength="100"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NomorTelepon" class="col-sm-3 col-form-label">Nomor Telepon</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="NomorTelepon" name="no_telepon" placeholder="Masukan Nomor Telepon" autocomplete="off" pattern="^\d{0,13}$" title="Nomor Telepon Harus Menggunakan Angka & Tidak Boleh Lebih Dari 13 Digit." required oninvalid="this.setCustomValidity('Nomor Telepon Harus Diisi.')" oninput="setCustomValidity('')"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="AlamatEmail" class="col-sm-3 col-form-label">Alamat Email</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="AlamatEmail" name="alamat_email" placeholder="Masukan Alamat Email" autocomplete="off" maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Format Email: contoh@email.com" required oninvalid="this.setCustomValidity('Alamat Email Harus Diisi.')" oninput="setCustomValidity('')"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolSimpan" name="TombolSimpan" class="btn btn-outline-success">Simpan</button>
				<a href="../master/FormDataMstVendor.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
			</div>
		</div>
	</form>
	<!-- Awal Modal Propinsi -->
	<div class="modal fade" id="ModalPropinsi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Propinsi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpPropinsi" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Propinsi</th>
								<th>Nama Propinsi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstPropinsi as $Baris) : ?>
							<tr class="PilihDataPropinsi" data-kodepropinsi="<?php echo $Baris['kode_propinsi']; ?>"
								class="PilihDataPropinsi" data-namapropinsi="<?php echo $Baris['nama_propinsi']; ?>">
								<td><?php echo $Baris["kode_propinsi"]; ?></td>
								<td><?php echo $Baris["nama_propinsi"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Propinsi -->

	<!-- Awal Modal Kabupaten / Kota -->
	<div class="modal fade" id="ModalKabupatenKota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Kabupaten / Kota</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpKabupatenKota" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Kabupaten / Kota</th>
								<th>Nama Kabupaten / Kota</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstKabupatenKota as $Baris) : ?>
							<tr class="PilihDataKabupatenKota" data-kodekabupatenkota="<?php echo $Baris['kode_kabupaten_kota']; ?>"
								class="PilihDataKabupatenKota" data-namakabupatenkota="<?php echo $Baris['nama_kabupaten_kota']; ?>">
								<td><?php echo $Baris["kode_kabupaten_kota"]; ?></td>
								<td><?php echo $Baris["nama_kabupaten_kota"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Kabupten / Kota -->

</div>

<!-- Awal Java Script -->
<script src="../library/jquery/jquery.js"></script>
<script src="../library/popper/popper.js"></script>
<script src="../library/bootstrap/js/bootstrap.min.js"></script>
<script src="../library/datatables/js/jquery.dataTables.min.js"></script>
<script src="../library/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../library/bootstrap4navbar/js/bootstrap-4-navbar.js"></script>

<script type="text/javascript">
	// Modal Propinsi
	$(document).on('click', '.PilihDataPropinsi', function (e) {
		document.getElementById("KodePropinsi").value = $(this).attr('data-kodepropinsi');
        document.getElementById("NamaPropinsi").value = $(this).attr('data-namapropinsi');
        $('#ModalPropinsi').modal('hide');
    });

	$(function(){
		$("#TableLookUpPropinsi").dataTable();
	});
	
	// Modal Kabupaten Kota
	$(document).on('click', '.PilihDataKabupatenKota', function (e) {
		document.getElementById("KodeKabupatenKota").value = $(this).attr('data-kodekabupatenkota');
        document.getElementById("NamaKabupatenKota").value = $(this).attr('data-namakabupatenkota');
        $('#ModalKabupatenKota').modal('hide');
    });

	$(function(){
		$("#TableLookUpKabupatenKota").dataTable();
	});
</script>
<!-- Akhir Java Script -->

</body>
</html>