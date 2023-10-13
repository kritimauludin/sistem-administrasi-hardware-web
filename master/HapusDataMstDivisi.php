<?php
include_once("../library/modul.php");

$KodeDivisi = $_GET["kode_divisi"];

if (HapusDataMstDivisi($KodeDivisi) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstDivisi.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstDivisi.php';
			</script>
		";
	}
?>