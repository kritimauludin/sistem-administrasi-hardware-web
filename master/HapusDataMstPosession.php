<?php
include_once("../library/modul.php");

$KodePosession = $_GET["kode_posession"];

if (HapusDataMstPosession($KodePosession) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstPosession.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstPosession.php';
			</script>
		";
	}
?>