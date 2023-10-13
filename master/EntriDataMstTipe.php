<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

if (isset($_POST["TombolSimpan"])) {
	if (EntriDataMstTipe($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan');
				document.location.href='FormDataMstTipe.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan');
				document.location.href='FormDataMstTipe.php';
			</script>
		";
	}
}

$SQL		= "SELECT max(kode_tipe) AS Kode FROM mst_tipe";
$HasilSQL 	= mysqli_query($Koneksi, $SQL);
$DataSQL 	= mysqli_fetch_array($HasilSQL);
$KodeBaru	= $DataSQL['Kode'];

$NoUrut		= (int) substr($KodeBaru, 6, 5);
$NoUrut++;

$Char		= "KDTP.";
$KodeBaru	= $Char . sprintf("%05s", $NoUrut);

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
		<h2>Entri Data Master Tipe Hardware</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodeTipe" class="col-sm-2 col-form-label">Kode Tipe</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodeTipe" name="kode_tipe" value="<?php echo $KodeBaru ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaMerk" class="col-sm-2 col-form-label">Nama Tipe</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="NamaMerk" name="nama_tipe" placeholder="Masukan Nama Tipe" autocomplete="off" maxlength="50" required oninvalid="this.setCustomValidity('Nama Tipe Harus Diisi.')" oninput="setCustomValidity('')"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolSimpan" name="TombolSimpan" class="btn btn-outline-success">Simpan</button>
				<a href="../master/FormDataMstTipe.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
			</div>
		</div>
	</form>
</div>

<!-- Awal Java Script -->
<script src="../library/jquery/jquery.js"></script>
<script src="../library/popper/popper.js"></script>
<script src="../library/bootstrap/js/bootstrap.min.js"></script>
<script src="../library/datatables/js/jquery.dataTables.min.js"></script>
<script src="../library/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../library/bootstrap4navbar/js/bootstrap-4-navbar.js"></script>
<!-- Akhir Java Script -->

</body>
</html>