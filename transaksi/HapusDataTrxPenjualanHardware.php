<?php
include_once("../library/modul.php");

$KodePenjualan = $_GET["kode_penjualan_hardware"];

if (HapusDataTrxPenjualanHardware($KodePenjualan) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataTrxPenjualanHardware.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataTrxPenjualanHardware.php';
			</script>
		";
	}
?>