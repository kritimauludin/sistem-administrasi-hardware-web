<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$KodePIC = $_GET["id"];

$UbahDataMstPIC = Query("SELECT * FROM mst_pic_it WHERE id = '$KodePIC'")[0];

if (isset($_POST["TombolUbah"])) {
	if (UbahDataMstPIC($_POST) > 0) {
		echo "
			<script>
				alert('Data Berhasil Diubah');
				document.location.href='FormDataMstPIC.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah');
				document.location.href='FormDataMstPIC.php';
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
		<h2>Ubah Data Master PIC</h2>
		<hr>
	</div>
</div>

<div class="container">
	<form action="" method="POST" id="FormEntri">
		<div class="form-group row">
			<label for="KodePIC" class="col-sm-2 col-form-label">Kode PIC IT</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="KodePIC" name="id" placeholder="Masukan Kode PIC" value="<?php echo $UbahDataMstPIC["id"]; ?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NamaPIC" class="col-sm-2 col-form-label">Nama PIC IT</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="NamaPIC" name="nama_pic_it" placeholder="Masukan Nama PIC" autocomplete="off" maxlength="150" required oninvalid="this.setCustomValidity('Nama PIC IT Harus Diisi.')" oninput="setCustomValidity('')" value="<?php echo $UbahDataMstPIC["nama_pic_it"]; ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="NomorTelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
			<div class="col-sm-4">
				<input type="phone" class="form-control" id="NomorTelepon" name="no_telepon" placeholder="Masukan Nomor Telepon" autocomplete="off" pattern="^\d{0,13}$" title="Nomor Telepon Harus Menggunakan Angka & Tidak Boleh Lebih Dari 13 Digit." required oninvalid="this.setCustomValidity('Nomor Telepon Harus Diisi.')" oninput="setCustomValidity('')" value="<?php echo $UbahDataMstPIC["no_telepon"]; ?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label for="AlamatEmail" class="col-sm-2 col-form-label">Alamat Email</label>
			<div class="col-sm-4">
				<input type="email" class="form-control" id="AlamatEmail" name="alamat_email" placeholder="Masukan Alamat Email" autocomplete="off"maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Format Email: contoh@email.com" required oninvalid="this.setCustomValidity('Alamat Email Harus Diisi.')" oninput="setCustomValidity('')" value="<?php echo $UbahDataMstPIC["alamat_email"]; ?>">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-4">
				<button type="submit" id="TombolUbah" name="TombolUbah" class="btn btn-outline-success">Ubah</button>
				<a href="../master/FormDataMstPIC.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
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