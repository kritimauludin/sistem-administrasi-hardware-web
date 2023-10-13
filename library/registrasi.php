<?php

session_start();

if (!isset($_SESSION["Login"])) {
    header("Location: index.php");
    exit;
}

include_once("modul.php");

if (isset($_POST["TombolRegistrasi"])) {
    if (EntriDataRegistrasi($_POST) > 0) {
        echo "
            <script>
                alert('User Baru Berhasil Ditambahkan');
                document.location.href='MenuUtama.php';
            </script>
        ";
    } else {
        echo mysqli_error($Koneksi);
    }
}
?>
<html>
<head>
<title><?php include_once("judul.php"); ?></title>

<!-- Awal CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="fontawesome/css/all.css">
<link rel="stylesheet" href="custom.css">
<link rel="stylesheet" href="bootstrap4navbar/css/bootstrap-4-navbar.css">
<!-- Akhir CSS -->

</head>
<body>

<!-- Awal Nav Bar -->
<?php include_once ("navbar.php"); ?>
<!-- Akhir Nav Bar-->

<div class="container">
    <div id="JudulForm">
        <h2>Registrasi User</h2>
        <hr>
    </div>
</div>

<div class="container">
    <form action="" method="POST" id="FormEntri">
        <div class="form-group row">
            <label for="Username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Username" name="username" placeholder="Username" autocomplete="off" maxlength="50" required oninvalid="this.setCustomValidity('Username Harus Diisi.')" oninput="setCustomValidity('')"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="Password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="Password" name="password" placeholder="Password" autocomplete="off" required oninvalid="this.setCustomValidity('Password Harus Diisi.')" oninput="setCustomValidity('')"/>
            </div>
        </div>
         <div class="form-group row">
            <label for="Password2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="Password2" name="password2" placeholder="Konfirmasi Password" autocomplete="off" required oninvalid="this.setCustomValidity('Konfirmasi Passord Harus Diisi.')" oninput="setCustomValidity('')"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="NamaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="NamaLengkap" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off" maxlength="150" required oninvalid="this.setCustomValidity('Nama Lengkap Harus Diisi.')" oninput="setCustomValidity('')"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="AlamatEmail" class="col-sm-2 col-form-label">Alamat Email</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="AlamatEmail" name="alamat_email" placeholder="Alamat Email" autocomplete="off" maxlength="100" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Format Email: contoh@email.com" required oninvalid="this.setCustomValidity('Alamat Email Harus Diisi.')" oninput="setCustomValidity('')"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="NomorTelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="NomorTelepon" name="no_telepon" placeholder="Nomor Telepon" autocomplete="off" pattern="^\d{0,13}$" title="Nomor Telepon Harus Menggunakan Angka & Tidak Boleh Lebih Dari 13 Digit." required oninvalid="this.setCustomValidity('Nomor Telepon Harus Diisi.')" oninput="setCustomValidity('')"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-4">
                <button type="submit" id="TombolRegistrasi" name="TombolRegistrasi" class="btn btn-outline-success">Registrasi</button>
                <a href="MenuUtama.php"><button type="button" id="TombolBatal" name="TombolBatal" class="btn btn-outline-secondary">Batal</button></a>
            </div>
        </div>
    </form>
</div>

<!-- Awal Java Script -->
<script src="jquery/jquery.js"></script>
<script src="popper/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="bootstrap4navbar/js/bootstrap-4-navbar.js"></script>
<!-- Akhir Java Script -->

</body>
</html>