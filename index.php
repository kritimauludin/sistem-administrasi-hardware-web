<?php

session_start();

include_once "library/modul.php";

if (isset($_POST["TombolLogin"])) {
	$Username 	= $_POST["username"];
	$Password 	= $_POST["password"];

	$Hasil 	= mysqli_query($Koneksi, "SELECT * FROM mst_user WHERE username = '$Username'");

	// Cek Username
	if (mysqli_num_rows($Hasil) === 1) {
		// Cek Password
		$BarisHasil	= mysqli_fetch_assoc($Hasil);
		if (password_verify($Password, $BarisHasil["password"])) {

			$_SESSION["Login"] = true;

			header("Location:../administrasihardware/library/menuutama.php");
			exit;
		}
	}

	$PesanKesalahan = true;
}

?>

<html>
<head>
<title><?php include_once("library/judul.php"); ?></title>

<!-- Awal CSS -->
<link rel="stylesheet" href="library/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="library/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="library/fontawesome/css/all.css">
<link rel="stylesheet" href="library/custom.css">
<link rel="stylesheet" href="library/bootstrap4navbar/css/bootstrap-4-navbar.css">
<!-- Akhir CSS -->

<style>
.login-form {
		width: 340px;
		margin: 50px auto;
}
.login-form form {        
	margin-bottom: 15px;
    background: #ffffff;
    padding: 30px;
}
.login-form h2 {
    margin: 20px 0 20px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 20px;
}
.input-group-addon .fa {
    font-size: 18px;
}
.btn {        
    font-size: 15px;
}

.InputWithIcon input{
    padding-left: 40px;
}

.InputWithIcon{
    position: relative;
}

.InputWithIcon i{
    position: absolute;
    left: 0;
    top: 8px;
    padding: 2px 15px;
}

.Logo{
    text-align: center;
    position: relative;
    top: 10%;
}

li{
    list-style-type: none;
}

</style>

</head>
<body>
<div class="Logo">
    <img src="gambar/Logo.png" style="height: 11%;">
</div>

<div class="login-form">
    <form action="" method="POST">
        <h2 class="text-center"> Login </h2>
        <?php if (isset($PesanKesalahan)) : ?>
			<p style="color: red; font-style: italic; text-align: center;">Username atau Password Salah . . !</p>
        <?php endif; ?>
        <div class="form-group">
        	<div class="InputWithIcon">
                <input type="text" class="form-control" id="Username" name="username" placeholder="Username" autocomplete="off" required/>
                <i class="fa fa-user"></i>
            </div>
        </div>
		<div class="form-group">
            <div class="InputWithIcon">
                <input type="password" class="form-control" id="Username" name="password" placeholder="Password" required/>
                <i class="fa fa-lock"></i>
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-info btn-block" id="TombolLogin" name="TombolLogin">Log In</i></button>
        </div>
    </form>
</div>

<script src="library/jquery/jquery.js"></script>
<script src="library/popper/popper.js"></script>
<script src="library/bootstrap/js/bootstrap.min.js"></script>
<script src="library/datatables/js/jquery.dataTables.min.js"></script>
<script src="library/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="library/bootstrap4navbar/js/bootstrap-4-navbar.js"></script>

</body>
</html>