<?php
include_once("../library/modul.php");

$KodePengadaan = $_GET["kode_pengadaan_hardware"];

if (HapusDataTrxPengadaanHardware($KodePengadaan) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataTrxPengadaanHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataTrxPengadaanHardware.php';
			</script>
		";
	}
?>