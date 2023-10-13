<?php
include_once("../library/modul.php");

$KodeTipe = $_GET["kode_tipe"];

if (HapusDataMstTipe($KodeTipe) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstTipe.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstTipe.php';
			</script>
		";
	}
?>