<?php
include_once("../library/modul.php");

$KodeKabupatenKota = $_GET["kode_kabupaten_kota"];

if (HapusDataMstKabupatenKota($KodeKabupatenKota) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstKabupatenKota.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstKabupatenKota.php';
			</script>
		";
	}
?>