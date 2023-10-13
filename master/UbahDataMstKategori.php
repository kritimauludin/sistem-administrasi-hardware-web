<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$KodeKategori = $_GET["kode_kategori"];

$UbahDataMstKategori = Query("SELECT * FROM mst_kategori WHERE kode_kategori = '$KodeKategori'")[0];

if (isset($_POST["TombolUbah"])) {
	if (UbahDataMstKategori($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Diubah');
				document.location.href='FormDataMstKategori.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah');
				document.location.href='FormDataMstKategori.php';
			</script>
		";
	}
}
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
		<h2>Ubah Data Master Kategori</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodeKategori" class="col-sm-2 col-form-label">Kode Kategori</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodeKategori" name="kode_kategori" value="<?php echo $UbahDataMstKategori["kode_kategori"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaKategori" class="col-sm-2 col-form-label">Nama Kategori</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="NamaKategori" name="nama_kategori" placeholder="Masukan Nama Kategori" maxlength="50" required oninvalid="this.setCustomValidity('Nama Kategori Harus Diisi.')" oninput="setCustomValidity('')" value="<?php echo $UbahDataMstKategori["nama_kategori"]; ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolUbah" name="TombolUbah" class="btn btn-outline-success">Ubah</button>
				<a href="../master/FormDataMstKategori.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
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