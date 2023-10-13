<?php
include_once("../library/modul.php");

$KodePengepul = $_GET["kode_pengepul"];

if (HapusDataMstPengepul($KodePengepul) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstPengepul.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstPengepul.php';
			</script>
		";
	}
?>