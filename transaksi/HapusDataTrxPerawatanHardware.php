<?php
include_once("../library/modul.php");

$KodePerawatan = $_GET["kode_perawatan_hardware"];

if (HapusDataTrxPerawatanHardware($KodePerawatan) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataTrxPerawatanHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataTrxPerawatanHardware.php';
			</script>
		";
	}
?>