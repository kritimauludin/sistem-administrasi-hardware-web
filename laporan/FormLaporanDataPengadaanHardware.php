<?php

session_start();

if (!isset($_SESSION["Login"])) {
	header("Location: ../index.php");
	exit;
}

include_once("../library/modul.php");

$TampilDataMstCabang = Query("SELECT * FROM mst_cabang ORDER BY kode_cabang ASC");

?>

<html>
<head>
<title><?php include_once("../library/judul.php"); ?></title>

<!-- Awal CSS -->
<link rel="stylesheet" href="../library/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../library/datepicker/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="../library/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../library/fontawesome/css/all.css">
<link rel="stylesheet" href="../library/custom.css">
<link rel="stylesheet" href="../library/bootstrap4navbar/css/bootstrap-4-navbar.css">
<!-- Akhir CSS -->

</head>
<body>

<!-- Awal Nav Bar -->
<?php include_once ("../library/navbar.php"); ?>
<!-- Akhir Nav Bar-->

<div class="container-fluid" align="center">
	<div id="JudulForm">
		<img src="../gambar/Logo Bintang Motor.png" class="img-fluid" alt="Logo Bintang Motor">
		<h2>Laporan Pengadaan Hardware IT</h2>
		<hr>
	</div>
</div>

<div class="container-fluid">
	<form method="GET" id="FormLaporan">
		<div class="form-row">
			<div class="form-group col-sm-3">
				<label for="Filter">Filter Berdasarkan:</label>
				<br>
				<select class="form-control" name="Filter" id="Filter">
					<option value="">Pilihan</option>
					<option value="1">Tanggal</option>
					<option value="2">Bulan</option>
					<option value="3">Tahun</option>
					<option value="4">Cabang</option>
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-3 FormTanggal">
				<label for="FilterTanggal">Tanggal:</label>
				<div class="input-group">
					<input type="text" class="form-control" id="FilterTanggal" name="filter_tanggal" placeholder="YYYY-MM-DD" autocomplete="off">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-calendar"></i></span>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-3 FormBulan">
				<label for="PilihBulan">Bulan:</label>
				<select class="form-control" name="filter_bulan" id="PilihBulan">
	                <option value="">Pilihan</option>
	                <option value="1">January</option>
	                <option value="2">February</option>
	                <option value="3">March</option>
	                <option value="4">April</option>
	                <option value="5">May</option>
	                <option value="6">June</option>
	                <option value="7">July</option>
	                <option value="8">August</option>
	                <option value="9">September</option>
	                <option value="10">October</option>
	                <option value="11">November</option>
	                <option value="12">December</option>
            	</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-3 FormTahun">
				<label for="PilihTahun">Tahun:</label>
				<select class="form-control" name="filter_tahun" id="PilihTahun">
	                <option value="">Pilihan</option>
	                <?php
	                	$Query = "SELECT YEAR(tanggal_pengadaan_hardware) AS filter_tahun FROM trx_pengadaan_hardware WHERE status='O' GROUP BY YEAR(tanggal_pengadaan_hardware)";
	                	$SQL = mysqli_query($Koneksi, $Query);

	                	while ($Data = mysqli_fetch_array($SQL)) {
	                		echo '<option value="'.$Data['filter_tahun'].'">'.$Data['filter_tahun'].'</option>';
	                	}
	                ?>
            	</select>
			</div>
		</div>
		<div class="form-row FormCabang">
			<div class="form-group col-sm-3">
				<input type="hidden" class="form-control" id="KodeCabang" name="kode_cabang"/>
				<input type="text" class="form-control" id="NamaCabang" name="nama_cabang" placeholder="Cari Nama Cabang" readonly/>
			</div>
			<div class="form-group col-sm-3">
				<button type="button" id="TombolLookUpCabang" class="btn btn-outline-success" data-toggle="modal" data-target="#ModalCabang">Cari</button>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-3">
				<button type="submit" id="TombolTampilData" class="btn btn-outline-info">Tampil Data</button>
				<a href="FormLaporanDataPengadaanHardware.php"><button type="button" id="TombolReset" class="btn btn-outline-danger">Reset</button></a>
			</div>
		</div>
	</form>
	<div>
	<?php
	if (isset($_GET['Filter']) && ! empty($_GET['Filter'])) {
		$FilterData = $_GET['Filter'];

		if ($FilterData == '1') {
			$FilterDataTanggal = date('d F Y', strtotime($_GET['filter_tanggal']));
			echo '<hr>';
			echo 'Data Transaksi Pengadaan Hardware Tanggal <i style="color: #e74c3c;">'.$FilterDataTanggal.'</i> ';
			echo '<a href="CetakLaporanDataPengadaanHardware.php?Filter=1&filter_tanggal='.$_GET['filter_tanggal'].'" class="text-success"><i class="fas fa-file-pdf"></i> Cetak ke PDF</a></br>';

			$QueryData = "SELECT trx_pengadaan_hardware.tanggal_pengadaan_hardware, date_add(trx_pengadaan_hardware.tanggal_pengadaan_hardware, INTERVAL 1825 DAY) as tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, mst_vendor.nama_vendor FROM trx_pengadaan_hardware
				INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
				INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
				INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
				INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
				INNER JOIN mst_vendor ON trx_pengadaan_hardware.kode_vendor = mst_vendor.kode_vendor
				WHERE DATE(tanggal_pengadaan_hardware)='".$_GET['filter_tanggal']."'
				ORDER BY trx_pengadaan_hardware.tanggal_pengadaan_hardware DESC";

		} else if ($FilterData == '2') {
			$FilterDataBulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			echo '<hr>';
			echo 'Data Transaksi Pengadaan Hardware Bulan <i style="color: #e74c3c;">'.$FilterDataBulan[$_GET['filter_bulan']].' '.$_GET['filter_tahun'].' </i>';
			echo '<a href="CetakLaporanDataPengadaanHardware.php?Filter=2&filter_bulan='.$_GET['filter_bulan'].'&filter_tahun='.$_GET['filter_tahun'].'" class="text-success"><i class="fas fa-file-pdf"></i> Cetak ke PDF</a></br>';

			$QueryData = "SELECT trx_pengadaan_hardware.tanggal_pengadaan_hardware, date_add(trx_pengadaan_hardware.tanggal_pengadaan_hardware, INTERVAL 1825 DAY) as tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, mst_vendor.nama_vendor FROM trx_pengadaan_hardware
				INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
				INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
				INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
				INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
				INNER JOIN mst_vendor ON trx_pengadaan_hardware.kode_vendor = mst_vendor.kode_vendor
				WHERE MONTH(tanggal_pengadaan_hardware)='".$_GET['filter_bulan']."' AND YEAR(tanggal_pengadaan_hardware)='".$_GET['filter_tahun']."'
				ORDER BY trx_pengadaan_hardware.tanggal_pengadaan_hardware DESC";

		} else if ($FilterData == '3') {
			echo '<hr>';
			echo 'Data Transaksi Pengadaan Hardware Tahun <i style="color: #e74c3c;">'.$_GET['filter_tahun'].'</i> ';
	        echo '<a href="CetakLaporanDataPengadaanHardware.php?Filter=3&filter_tahun='.$_GET['filter_tahun'].'" class="text-success"><i class="fas fa-file-pdf"></i> Cetak PDF</a></br>';

	        $QueryData = "SELECT trx_pengadaan_hardware.tanggal_pengadaan_hardware, date_add(trx_pengadaan_hardware.tanggal_pengadaan_hardware, INTERVAL 1825 DAY) as tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, mst_vendor.nama_vendor FROM trx_pengadaan_hardware
				INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
				INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
				INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
				INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
				INNER JOIN mst_vendor ON trx_pengadaan_hardware.kode_vendor = mst_vendor.kode_vendor
				WHERE YEAR(tanggal_pengadaan_hardware)='".$_GET['filter_tahun']."'
				ORDER BY trx_pengadaan_hardware.tanggal_pengadaan_hardware DESC";
		} else {
			echo '<hr>';
			echo 'Data Transaksi Pengadaan Hardware Cabang <i style="color: #e74c3c;">'.$_GET['nama_cabang'].'</i> ';
	        echo '<a href="CetakLaporanDataPengadaanHardware.php?Filter=4&kode_cabang='.$_GET['kode_cabang'].'&nama_cabang='.$_GET['nama_cabang'].'" class="text-success"><i class="fas fa-file-pdf"></i> Cetak ke PDF</a></br>';

	        $KodeCabang = $_GET['kode_cabang'];
			$NamaCabang = $_GET['nama_cabang'];
	        $QueryData = "SELECT trx_pengadaan_hardware.tanggal_pengadaan_hardware, date_add(trx_pengadaan_hardware.tanggal_pengadaan_hardware, INTERVAL 1825 DAY) as tanggal_kadaluwarsa_hardware, mst_cabang.kode_cabang, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, mst_vendor.nama_vendor, trx_pengadaan_hardware.status
				FROM trx_pengadaan_hardware
				INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
				INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
				INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
				INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
				INNER JOIN mst_vendor ON trx_pengadaan_hardware.kode_vendor = mst_vendor.kode_vendor
				WHERE trx_pengadaan_hardware.kode_cabang = '$KodeCabang' AND trx_pengadaan_hardware.status = 'O'
				ORDER BY trx_pengadaan_hardware.tanggal_pengadaan_hardware DESC";
		}
	} else {
		echo '<hr>';
		echo '<i style="color: #e74c3c;">Semua Data Transaksi Pengadaan Hardware</i> ';
	    echo '<a href="CetakLaporanDataPengadaanHardware.php" class="text-success"><i class="fas fa-file-pdf"></i> Cetak ke PDF</a></br>';

	    $QueryData = "SELECT trx_pengadaan_hardware.tanggal_pengadaan_hardware, date_add(trx_pengadaan_hardware.tanggal_pengadaan_hardware, INTERVAL 1825 DAY) as tanggal_kadaluwarsa_hardware, mst_cabang.nama_cabang, mst_divisi.nama_divisi, mst_posession.nama_posession, mst_hardware.nama_hardware, mst_vendor.nama_vendor FROM trx_pengadaan_hardware
			INNER JOIN mst_cabang ON trx_pengadaan_hardware.kode_cabang = mst_cabang.kode_cabang
			INNER JOIN mst_divisi ON trx_pengadaan_hardware.kode_divisi = mst_divisi.kode_divisi
			INNER JOIN mst_posession ON trx_pengadaan_hardware.kode_posession = mst_posession.kode_posession
			INNER JOIN mst_hardware ON trx_pengadaan_hardware.kode_hardware = mst_hardware.kode_hardware
			INNER JOIN mst_vendor ON trx_pengadaan_hardware.kode_vendor = mst_vendor.kode_vendor
			ORDER BY trx_pengadaan_hardware.tanggal_pengadaan_hardware DESC";
	}
	?>
	<hr>
	</div>
	<!-- Awal Modal Cabang -->
	<div class="modal fade" id="ModalCabang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Data Master Cabang</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<table id="TableLookUpCabang" class="table table-bordered table-hover">
						<thead align="center">
							<tr>
								<th>Kode Cabang</th>
								<th>Nama Cabang</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($TampilDataMstCabang as $Baris) : ?>
							<tr class="PilihDataCabang" data-kodecabang="<?php echo $Baris['kode_cabang']; ?>"
								class="PilihDataCabang" data-namacabang="<?php echo $Baris['nama_cabang']; ?>">
								<td><?php echo $Baris["kode_cabang"]; ?></td>
								<td><?php echo $Baris["nama_cabang"]; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Cabang -->
	<div id="TampilDataLaporan">
		<!-- Awal Tampil Data -->
		<table class="table table-hover" id="TabelTampilData">
			<thead align="center">
				<tr>
					<th>Tanggal Pengadaan</th>
					<th>Tanggal Kadaluwarsa</th>
					<th>Cabang</th>
					<th>Divisi</th>
					<th>Posession</th>
					<th>Hardware</th>
					<th>Vendor</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$SQL	= mysqli_query($Koneksi, $QueryData);
				$Baris	= mysqli_num_rows($SQL);

				if ($Baris > 0 ) {
					while ($Data = mysqli_fetch_array($SQL)) {
					$TanggalPengadaan 	= date('d F Y', strtotime($Data["tanggal_pengadaan_hardware"]));
					$TanggalKadaluwarsa = date('d F Y', strtotime($Data["tanggal_kadaluwarsa_hardware"]));

					echo "<tr>";
		            echo "<td>".$TanggalPengadaan."</td>";
		            echo "<td>".$TanggalKadaluwarsa."</td>";
		            echo "<td>".$Data['nama_cabang']."</td>";
		            echo "<td>".$Data['nama_divisi']."</td>";
		            echo "<td>".$Data['nama_posession']."</td>";
		            echo "<td>".$Data['nama_hardware']."</td>";
		            echo "<td>".$Data['nama_vendor']."</td>";
		            echo "</tr>";
					}
				}
			?>
			</tbody>
		</table>
		<!-- Akhir Tampil Data -->
	</div>
</div>

<!-- Awal Java Script -->
<script src="../library/jquery/jquery.js"></script>
<script src="../library/datepicker/js/bootstrap-datepicker.js"></script>
<script src="../library/popper/popper.js"></script>
<script src="../library/bootstrap/js/bootstrap.min.js"></script>
<script src="../library/datatables/js/jquery.dataTables.min.js"></script>
<script src="../library/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../library/bootstrap4navbar/js/bootstrap-4-navbar.js"></script>

<script type="text/javascript">

	$(document).ready(function(){
		$('.FormTanggal, .FormBulan, .FormTahun, .FormCabang').hide();

		$('#Filter').change(function(){
			if ($(this).val() == '1') {
				$('.FormBulan, .FormTahun, .FormCabang').hide();
				$('.FormTanggal').show();
			} else if ($(this).val() == '2') {
				$('.FormTanggal, .FormCabang').hide();
				$('.FormBulan, .FormTahun').show();
			} else if ($(this).val() == '3') {
				$('.FormTanggal, .FormBulan, .FormCabang').hide();
				$('.FormTahun').show();
			} else {
				$('.FormTanggal, .FormBulan, .FormTahun').hide();
				$('.FormCabang').show();
			}
			$('.FormTanggal input, .FormBulan, .FormTahun, .FormCabang').val('');
		})
	})

	$(function() {
        $('#TabelTampilData').dataTable();
    });

    // Modal Cabang
	$(document).on('click', '.PilihDataCabang', function (e) {
		document.getElementById("KodeCabang").value = $(this).attr('data-kodecabang');
        document.getElementById("NamaCabang").value = $(this).attr('data-namacabang');
        $('#ModalCabang').modal('hide');
    });

	$(function(){
		$("#TableLookUpCabang").dataTable();
	});

	$(function(){
		$('.FormTanggal #FilterTanggal').datepicker({
	       'format' : 'yyyy-mm-dd',
	       'todayHighlight' : true,
	       'autoclose' : true
	    });
	});

</script>
<!-- Akhir Java Script -->

</body>
</html>