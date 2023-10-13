<?php
include_once("../library/modul.php");

$KodeMerk = $_GET["kode_merk"];

if (HapusDataMstMerk($KodeMerk) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstMerk.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstMerk.php';
			</script>
		";
	}
?>