<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

if (isset($_POST["TombolSimpan"])) {
	if (EntriDataMstHardware($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan');
				document.location.href='FormDataMstHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan');
				document.location.href='FormDataMstHardware.php';
			</script>
		";
	}
}

$SQL		= "SELECT max(kode_hardware) AS Kode FROM mst_hardware";
$HasilSQL 	= mysqli_query($Koneksi, $SQL);
$DataSQL 	= mysqli_fetch_array($HasilSQL);
$KodeBaru	= $DataSQL['Kode'];

$NoUrut		= (int) substr($KodeBaru, 6, 5);
$NoUrut++;

$Char		= "KDHW.";
$KodeBaru	= $Char . sprintf("%05s", $NoUrut);

$TampilDataMstKategori = Query("SELECT * FROM mst_kategori ORDER BY kode_kategori ASC");

$TampilDataMstMerk = Query("SELECT * FROM mst_merk ORDER BY kode_merk ASC");

$TampilDataMstTipe = Query("SELECT * FROM mst_tipe ORDER BY kode_tipe ASC");

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
		<h2>Entri Data Master Hardware</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodeHardware" class="col-sm-2 col-form-label">Kode Hardware</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodeHardware" name="kode_hardware" value="<?php echo $KodeBaru ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaHardware" class="col-sm-2 col-form-label">Nama Hardware</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="NamaHardware" name="nama_hardware" placeholder="Masukan Nama Hardware" autocomplete="off" maxlength="150" required oninvalid="this.setCustomValidity('Nama Hardware Harus Diisi.')" oninput="setCustomValidity('')"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeKategori" name="kode_kategori"/>
				<input type="text" class="form-control" id="NamaKategori" name="nama_kategori" placeholder="Nama Kategori" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpKategori" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalKategori">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaMerk" class="col-sm-2 col-form-label">Nama Merk</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeMerk" name="kode_merk"/>
				<input type="text" class="form-control" id="NamaMerk" name="nama_merk" placeholder="Nama Merk" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpMerk" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalMerk">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaTipe" class="col-sm-2 col-form-label">Nama Tipe</label>
			<div class="col-sm-4">
				<input type="hidden" class="form-control" id="KodeTipe" name="kode_tipe"/>
				<input type="text" class="form-control" id="NamaTipe" name="nama_tipe" placeholder="Nama Tipe" readonly/>
			</div>
			<div class="col-sm-1">
				<button type="button" id="TombolLookUpTipe" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalTipe">Cari</button>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolSimpan" name="TombolSimpan" class="btn btn-outline-success">Simpan</button>
				<a href="../master/FormDataMstHardware.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
			</div>
		</div>
	</form>
	<!-- Awal Modal Kategori -->
	<div class="modal fade" id="ModalKategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Kategori</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpKategori" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Kategori</th>
								<th>Nama Kategori</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstKategori as $Baris) : ?>
							<tr class="PilihDataKategori" data-kodekategori="<?php echo $Baris['kode_kategori']; ?>"
								class="PilihDataKategori" data-namakategori="<?php echo $Baris['nama_kategori']; ?>">
								<td><?php echo $Baris["kode_kategori"]; ?></td>
								<td><?php echo $Baris["nama_kategori"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Kategori -->

	<!-- Awal Modal Merk -->
	<div class="modal fade" id="ModalMerk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Merk</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpMerk" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Merk</th>
								<th>Nama Merk</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstMerk as $Baris) : ?>
							<tr class="PilihDataMerk" data-kodemerk="<?php echo $Baris['kode_merk']; ?>"
								class="PilihDataMerk" data-namamerk="<?php echo $Baris['nama_merk']; ?>">
								<td><?php echo $Baris["kode_merk"]; ?></td>
								<td><?php echo $Baris["nama_merk"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Merk -->

	<!-- Awal Modal Tipe -->
	<div class="modal fade" id="ModalTipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Tipe</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpTipe" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Tipe</th>
								<th>Nama Tipe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstTipe as $Baris) : ?>
							<tr class="PilihDataTipe" data-kodetipe="<?php echo $Baris['kode_tipe']; ?>"
								class="PilihDataTipe" data-namatipe="<?php echo $Baris['nama_tipe']; ?>">
								<td><?php echo $Baris["kode_tipe"]; ?></td>
								<td><?php echo $Baris["nama_tipe"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Tipe -->

</div>

<!-- Awal Java Script -->
<script src="../library/jquery/jquery.js"></script>
<script src="../library/popper/popper.js"></script>
<script src="../library/bootstrap/js/bootstrap.min.js"></script>
<script src="../library/datatables/js/jquery.dataTables.min.js"></script>
<script src="../library/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../library/bootstrap4navbar/js/bootstrap-4-navbar.js"></script>

<script type="text/javascript">
	// Modal Kategori
	$(document).on('click', '.PilihDataKategori', function (e) {
        document.getElementById("KodeKategori").value = $(this).attr('data-kodekategori');
        document.getElementById("NamaKategori").value = $(this).attr('data-namakategori');
        $('#ModalKategori').modal('hide');
    });

	$(function(){
		$("#TableLookUpKategori").dataTable();
	});

	
	// Modal Merk
	$(document).on('click', '.PilihDataMerk', function (e) {
        document.getElementById("KodeMerk").value = $(this).attr('data-kodemerk');
        document.getElementById("NamaMerk").value = $(this).attr('data-namamerk');
        $('#ModalMerk').modal('hide');
    });

	$(function(){
		$("#TableLookUpMerk").dataTable();
	});

	// Modal Tipe
	$(document).on('click', '.PilihDataTipe', function (e) {
        document.getElementById("KodeTipe").value = $(this).attr('data-kodetipe');
        document.getElementById("NamaTipe").value = $(this).attr('data-namatipe');
        $('#ModalTipe').modal('hide');
    });

	$(function(){
		$("#TableLookUpTipe").dataTable();
	});

</script>
<!-- Akhir Java Script -->

</body>
</html>