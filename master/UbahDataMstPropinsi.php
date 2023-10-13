<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$KodePropinsi = $_GET["kode_propinsi"];

$UbahDataMstPropinsi = Query("SELECT * FROM mst_propinsi WHERE kode_propinsi = '$KodePropinsi'")[0];

if (isset($_POST["TombolUbah"])) {
	if (UbahDataMstPropinsi($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Diubah');
				document.location.href='FormDataMstPropinsi.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah');
				document.location.href='FormDataMstPropinsi.php';
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
		<h2>Ubah Data Master Propinsi</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodePropinsi" class="col-sm-2 col-form-label">Kode Propinsi</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodePropinsi" name="kode_propinsi" placeholder="Masukan Kode Propinsi" value="<?php echo $UbahDataMstPropinsi["kode_propinsi"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPropinsi" class="col-sm-2 col-form-label">Nama Propinsi</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="NamaPropinsi" name="nama_propinsi" placeholder="Masukan Nama Propinsi" autocomplete="off" maxlength="30" required oninvalid="this.setCustomValidity('Nama Propinsi Harus Diisi.')" oninput="setCustomValidity('')" value="<?php echo $UbahDataMstPropinsi["nama_propinsi"]; ?>">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolUbah" name="TombolUbah" class="btn btn-outline-success">Ubah</button>
				<a href="../master/FormDataMstPropinsi.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
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