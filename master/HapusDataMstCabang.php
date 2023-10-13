<?php

include_once("../library/modul.php");

$KodeCabang = $_GET["kode_cabang"];

if (HapusDataMstCabang($KodeCabang) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstCabang.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstCabang.php';
			</script>
		";
	}
?>