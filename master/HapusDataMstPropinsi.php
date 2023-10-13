<?php
include_once("../library/modul.php");

$KodePropinsi = $_GET["kode_propinsi"];

if (HapusDataMstPropinsi($KodePropinsi) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstPropinsi.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstPropinsi.php';
			</script>
		";
	}
?>