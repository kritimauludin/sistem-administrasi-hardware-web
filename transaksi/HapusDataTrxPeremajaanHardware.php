<?php
include_once("../library/modul.php");

$KodePeremajaan = $_GET["kode_peremajaan_hardware"];

if (HapusDataTrxPeremajaanHardware($KodePeremajaan) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataTrxPeremajaanHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataTrxPeremajaanHardware.php';
			</script>
		";
	}
?>