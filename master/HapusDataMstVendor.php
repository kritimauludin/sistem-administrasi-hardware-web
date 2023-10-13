<?php
include_once("../library/modul.php");

$KodeVendor = $_GET["kode_vendor"];

if (HapusDataMstVendor($KodeVendor) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstVendor.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstVendor.php';
			</script>
		";
	}
?>