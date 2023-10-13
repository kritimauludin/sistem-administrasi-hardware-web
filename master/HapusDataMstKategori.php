<?php
include_once("../library/modul.php");

$KodeKategori = $_GET["kode_kategori"];

if (HapusDataMstKategori($KodeKategori) > 0) {
	echo "
			<script>
				alert('Data Berhasil Dihapus');
				document.location.href='FormDataMstKategori.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Dihapus');
				document.location.href='FormDataMstKategori.php';
			</script>
		";
	}
?>