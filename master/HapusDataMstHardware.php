<?php
include_once("../library/modul.php");

$KodeHardware = $_GET["kode_hardware"];

if (HapusDataMstHardware($KodeHardware) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstHardware.php';
			</script>
		";
	}
?>