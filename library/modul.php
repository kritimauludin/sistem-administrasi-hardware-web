<?php

// Koneksi ke Database
$Koneksi = mysqli_connect("localhost", "root", "", "db_hardware") or die (mysqli_error());

function Query($Query){
	global $Koneksi;
	$HasilQuery	= mysqli_query($Koneksi, $Query);

	$Wadah = [];
	while($Baris = mysqli_fetch_assoc($HasilQuery)){
		$Wadah[] = $Baris;
	}
	return $Wadah;
}



// Function Entri Data
function EntriDataMstCabang($Data){
	global $Koneksi;

	$KodeCabang			= htmlspecialchars($Data["kode_cabang"]);
	$NamaCabang			= htmlspecialchars($Data["nama_cabang"]);
	$Alamat 			= htmlspecialchars($Data["alamat"]);
	$KodePropinsi 		= htmlspecialchars($Data["kode_propinsi"]);
	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$NomorTelepon 		= htmlspecialchars($Data["no_telepon"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggaPembaruan	= date('Y-m-d');

	$Query = "INSERT INTO mst_cabang VALUES ('$KodeCabang', '$NamaCabang', '$Alamat', '$KodePropinsi', '$KodeKabupatenKota', '$NomorTelepon', '$TanggalEntri', '$TanggaPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstDivisi($Data){
	global $Koneksi;

	$KodeDivisi			= htmlspecialchars($Data["kode_divisi"]);
	$NamaDivisi			= htmlspecialchars($Data["nama_divisi"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "INSERT INTO mst_divisi VALUES ('$KodeDivisi', '$NamaDivisi', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstPosession($Data){
	global $Koneksi;

	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$NamaPosession 		= htmlspecialchars($Data["nama_posession"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "INSERT INTO mst_posession VALUES ('$KodePosession', '$NamaPosession', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstPIC($Data){
	global $Koneksi;

	$KodePIC 			= htmlspecialchars($Data["id"]);
	$NamaPIC 			= htmlspecialchars($Data["nama_pic_it"]);
	$NomorTelepon 		= htmlspecialchars($Data["no_telepon"]);
	$AlamatEmail 		= htmlspecialchars($Data["alamat_email"]);
	$TanggalEntri 		= date('Y-m-s');
	$TanggalPembaruan	= date('Y-m-s');

	$Query = "INSERT INTO mst_pic_it VALUES ('$KodePIC', '$NamaPIC', '$NomorTelepon', '$AlamatEmail', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstKategori($Data){
	global $Koneksi;

	$KodeKategori 		= htmlspecialchars($Data["kode_kategori"]);
	$NamaKategori		= htmlspecialchars($Data["nama_kategori"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "INSERT INTO mst_kategori VALUES ('$KodeKategori', '$NamaKategori', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);
	
	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstMerk($Data){
	global $Koneksi;

	$KodeMerk			= htmlspecialchars($Data["kode_merk"]);
	$NamaMerk			= htmlspecialchars($Data["nama_merk"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "INSERT INTO mst_merk VALUES ('$KodeMerk', '$NamaMerk', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstTipe($Data){
	global $Koneksi;

	$KodeTipe 			= htmlspecialchars($Data["kode_tipe"]);
	$NamaTipe 			= htmlspecialchars($Data["nama_tipe"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "INSERT INTO mst_tipe VALUES ('$KodeTipe', '$NamaTipe', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstVendor($Data){
	global $Koneksi;

	$KodeVendor			= htmlspecialchars($Data["kode_vendor"]);
	$NamaVendor			= htmlspecialchars($Data["nama_vendor"]);
	$Alamat 			= htmlspecialchars($Data["alamat"]);
	$KodePropinsi 		= htmlspecialchars($Data["kode_propinsi"]);
	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$Website			= htmlspecialchars($Data["website"]);
	$NomorTelepon 		= htmlspecialchars($Data["no_telepon"]);
	$AlamatEmail		= htmlspecialchars($Data["alamat_email"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan	= date('Y-m-d');

	$Query = "INSERT INTO mst_vendor VALUES ('$KodeVendor', '$NamaVendor', '$Alamat', '$KodePropinsi', '$KodeKabupatenKota', '$Website', '$NomorTelepon', '$AlamatEmail', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstPengepul($Data){
	global $Koneksi;

	$KodePengepul 		= htmlspecialchars($Data["kode_pengepul"]);
	$NamaPengepul 		= htmlspecialchars($Data["nama_pengepul"]);
	$Alamat 			= htmlspecialchars($Data["alamat"]);
	$KodePropinsi   	= htmlspecialchars($Data["kode_propinsi"]);
	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$NomorTelepon		= htmlspecialchars($Data["no_telepon"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan	= date('Y-m-d');

	$Query = "INSERT INTO mst_pengepul VALUES ('$KodePengepul', '$NamaPengepul', '$Alamat', '$KodePropinsi', '$KodeKabupatenKota', '$NomorTelepon', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstPropinsi($Data){
	global $Koneksi;

	$KodePropinsi 		= htmlspecialchars($Data["kode_propinsi"]);
	$NamaPropinsi 		= htmlspecialchars($Data["nama_propinsi"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "INSERT INTO mst_propinsi VALUES ('$KodePropinsi', '$NamaPropinsi','$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstKabupatenKota($Data){
	global $Koneksi;

	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$NamaKabupatenKota 	= htmlspecialchars($Data["nama_kabupaten_kota"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan	= date('Y-m-d');

	$Query = "INSERT INTO mst_kabupaten_kota VALUES ('$KodeKabupatenKota', '$NamaKabupatenKota','$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataMstHardware($Data){
	global $Koneksi;

	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$NamaHardware 		= htmlspecialchars($Data["nama_hardware"]);
	$KodeKategori 		= htmlspecialchars($Data["kode_kategori"]);
	$KodeMerk 			= htmlspecialchars($Data["kode_merk"]);
	$KodeTipe 			= htmlspecialchars($Data["kode_tipe"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "INSERT INTO mst_hardware VALUES ('$KodeHardware', '$NamaHardware', '$KodeKategori', '$KodeMerk', '$KodeTipe', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataTrxPengadaanHardware($Data){
	global $Koneksi;

	$KodePengadaan 		= htmlspecialchars($Data["kode_pengadaan_hardware"]);
	$TanggalPengadaan	= $Data["tanggal_pengadaan_hardware"];
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$SerialNumber 		= htmlspecialchars($Data["serial_number"]);
	$Keterangan 		= htmlspecialchars($Data["keterangan"]);
	$KodeVendor 		= htmlspecialchars($Data["kode_vendor"]);
	$HargaHardware 		= htmlspecialchars($Data["harga_hardware"]);
	$Status		 		= htmlspecialchars($Data["status"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan	= date('Y-m-d');

	$Query 	= "INSERT INTO trx_pengadaan_hardware VALUES ('$KodePengadaan', '$TanggalPengadaan', date_add('$TanggalPengadaan', INTERVAL 1825 DAY), '$KodeCabang', '$KodeDivisi', '$KodePosession', '$KodeHardware', '$SerialNumber', '$Keterangan', '$KodeVendor', '$HargaHardware', '$Status', '$TanggalEntri', '$TanggalPembaruan')";
	
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataTrxPeremajaanHardware($Data){
	global $Koneksi;

	$KodePeremajaan		= htmlspecialchars($Data["kode_peremajaan_hardware"]);
	$TanggalPeremajaan	= $Data["tanggal_peremajaan_hardware"];
	$KodePengadaan 		= htmlspecialchars($Data["kode_pengadaan_hardware"]);
	$SerialNumber 		= htmlspecialchars($Data["serial_number"]);
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$KodeVendor 		= htmlspecialchars($Data["kode_vendor"]);
	$Status		 		= htmlspecialchars($Data["status"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan	= date('Y-m-d');

	$QueryInsert 	= "INSERT INTO trx_peremajaan_hardware VALUES ('$KodePeremajaan', '$TanggalPeremajaan', '$KodePengadaan', '$SerialNumber', '$KodeCabang', '$KodeDivisi', '$KodePosession', '$KodeHardware', '$KodeVendor', '$Status', '$TanggalEntri', '$TanggalPembaruan')";

	$QueryUpdate	= "UPDATE trx_pengadaan_hardware SET status = 'C' WHERE kode_pengadaan_hardware = '$KodePengadaan'";

	$Insert = mysqli_query($Koneksi, $QueryInsert);

	$Update = mysqli_query($Koneksi, $QueryUpdate);


	return mysqli_affected_rows($Koneksi);
}

function EntriDataTrxPerawatanHardware($Data){
	global $Koneksi;

	$KodePerawatan		= htmlspecialchars($Data["kode_perawatan_hardware"]);
	$TanggalPerawatan	= $Data["tanggal_perawatan_hardware"];
	$KodePengadaan 		= htmlspecialchars($Data["kode_pengadaan_hardware"]);
	$SerialNumber 		= htmlspecialchars($Data["serial_number"]);
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$Keterangan 		= htmlspecialchars($Data["keterangan"]);
	$BiayaPerawatan		= htmlspecialchars($Data["biaya_perawatan"]);
	$KodePICIT	 		= htmlspecialchars($Data["id"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan	= date('Y-m-d');

	$Query 	= "INSERT INTO trx_perawatan_hardware VALUES ('$KodePerawatan', '$TanggalPerawatan', '$KodePengadaan', '$SerialNumber', '$KodeCabang', '$KodeDivisi', '$KodePosession', '$KodeHardware', '$Keterangan', '$BiayaPerawatan', '$KodePICIT', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataTrxPenjualanHardware($Data){
	global $Koneksi;

	$KodePenjualan		= htmlspecialchars($Data["kode_penjualan_hardware"]);
	$TanggalPenjualan	= $Data["tanggal_penjualan_hardware"];
	$KodePeremajaan 	= htmlspecialchars($Data["kode_peremajaan_hardware"]);
	$SerialNumber 		= htmlspecialchars($Data["serial_number"]);
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$KodePengepul		= htmlspecialchars($Data["kode_pengepul"]);
	$HargaJualHardware	= htmlspecialchars($Data["harga_jual_hardware"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan	= date('Y-m-d');

	$QueryInsert 	= "INSERT INTO trx_penjualan_hardware VALUES ('$KodePenjualan', '$TanggalPenjualan', '$KodePeremajaan', '$SerialNumber', '$KodeCabang', '$KodeDivisi', '$KodePosession', '$KodeHardware', '$KodePengepul', '$HargaJualHardware', '$TanggalEntri', '$TanggalPembaruan')";

	$QueryUpdate 	= "UPDATE trx_peremajaan_hardware SET status = 'C' WHERE kode_peremajaan_hardware = '$KodePeremajaan'";

	$Insert = mysqli_query($Koneksi, $QueryInsert);

	$Update = mysqli_query($Koneksi, $QueryUpdate);

	return mysqli_affected_rows($Koneksi);
}

function EntriDataRegistrasi($Data){
	global $Koneksi;

	$Username			= strtolower(stripcslashes($Data["username"]));
	$Password			= mysqli_real_escape_string($Koneksi, $Data["password"]);
	$Password2			= mysqli_real_escape_string($Koneksi, $Data["password2"]);
	$NamaLengkap		= htmlspecialchars($Data["nama_lengkap"]);
	$AlamatEmail 		= htmlspecialchars($Data["alamat_email"]);
	$NomorTelepon		= htmlspecialchars($Data["no_telepon"]);
	$TanggalEntri 		= date('Y-m-d');
	$TanggalPembaruan 	= date('Y-m-d');

	//Cek Username
	$Hasil 	= mysqli_query($Koneksi, "SELECT username FROM mst_user WHERE username = '$Username'");

	if (mysqli_fetch_assoc($Hasil)) {
		echo "
            <script>
                alert('Username Sudah Terdaftar');
            </script>
        ";

        return false;

	}

	// Cek Konfirmasi Password
	if ($Password !== $Password2) {
		echo "
            <script>
                alert('Konfirmasi Password Tidak Sesuai');
            </script>
        ";

        return false;

	}

	// Enkripsi Password
	$Password 	= password_hash($Password, PASSWORD_DEFAULT);

	$Query 	= "INSERT INTO mst_user VALUES('', '$Username', '$Password', '$NamaLengkap', '$AlamatEmail', 'NomorTelepon', '$TanggalEntri', '$TanggalPembaruan')";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);

}



// Function Hapus Data
function HapusDataMstCabang($KodeCabang){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_cabang WHERE kode_cabang = '$KodeCabang'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstDivisi($KodeDivisi){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_divisi WHERE kode_divisi = '$KodeDivisi'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstPosession($KodePosession){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_posession WHERE kode_posession = '$KodePosession'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstPIC($KodePIC){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_pic_it WHERE id = '$KodePIC'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstKategori($KodeKategori){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_kategori WHERE kode_kategori = '$KodeKategori'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstMerk($KodeMerk){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_merk WHERE kode_merk = '$KodeMerk'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstTipe($KodeTipe){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_tipe WHERE kode_tipe = '$KodeTipe'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstVendor($KodeVendor){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_vendor WHERE kode_vendor = '$KodeVendor'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstPengepul($KodePengepul){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_pengepul WHERE kode_pengepul = '$KodePengepul'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstPropinsi($KodePropinsi){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_propinsi WHERE kode_propinsi = '$KodePropinsi'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstKabupatenKota($KodeKabupatenKota){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_kabupaten_kota WHERE kode_kabupaten_kota = '$KodeKabupatenKota'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataMstHardware($KodeHardware){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM mst_hardware WHERE kode_hardware = '$KodeHardware'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataTrxPengadaanHardware($KodePengadaan){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM trx_pengadaan_hardware WHERE kode_pengadaan_hardware = '$KodePengadaan'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataTrxPeremajaanHardware($KodePeremajaan){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM trx_peremajaan_hardware WHERE kode_peremajaan_hardware = '$KodePeremajaan'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataTrxPerawatanHardware($KodePerawatan){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM trx_perawatan_hardware WHERE kode_perawatan_hardware = '$KodePerawatan'");

	return mysqli_affected_rows($Koneksi);
}

function HapusDataTrxPenjualanHardware($KodePenjualan){
	global $Koneksi;

	mysqli_query($Koneksi, "DELETE FROM trx_penjualan_hardware WHERE kode_penjualan_hardware = '$KodePenjualan'");

	return mysqli_affected_rows($Koneksi);
}



// Function Ubah Data
function UbahDataMstCabang($Data){
	global $Koneksi;

	$KodeCabang			= htmlspecialchars($Data["kode_cabang"]);
	$NamaCabang			= htmlspecialchars($Data["nama_cabang"]);
	$Alamat 			= htmlspecialchars($Data["alamat"]);
	$KodePropinsi 		= htmlspecialchars($Data["kode_propinsi"]);
	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$NomorTelepon 		= htmlspecialchars($Data["no_telepon"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "UPDATE mst_cabang SET
				kode_cabang = '$KodeCabang',
				nama_cabang = '$NamaCabang',
				alamat = '$Alamat',
				kode_propinsi = '$KodePropinsi',
				kode_kabupaten_kota = '$KodeKabupatenKota',
				no_telepon = '$NomorTelepon',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_cabang = '$KodeCabang'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstDivisi($Data){
	global $Koneksi;

	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$NamaDivisi 		= htmlspecialchars($Data["nama_divisi"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "UPDATE mst_divisi SET
				kode_divisi = '$KodeDivisi',
				nama_divisi = '$NamaDivisi',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_divisi = '$KodeDivisi'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstPosession($Data){
	global $Koneksi;

	$KodePosession 	= htmlspecialchars($Data["kode_posession"]);
	$NamaPosession 	= htmlspecialchars($Data["nama_posession"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "UPDATE mst_posession SET
				kode_posession = '$KodePosession',
				nama_posession = '$NamaPosession', 
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_posession = '$KodePosession'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstPIC($Data){
	global $Koneksi;

	$KodePIC 			= htmlspecialchars($Data["id"]);
	$NamaPIC 			= htmlspecialchars($Data["nama_pic_it"]);
	$NomorTelepon 		= htmlspecialchars($Data["no_telepon"]);
	$AlamatEmail 		= htmlspecialchars($Data["alamat_email"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "UPDATE mst_pic_it SET
				id = '$KodePIC',
				nama_pic_it = '$NamaPIC',
				no_telepon = '$NomorTelepon',
				alamat_email = '$AlamatEmail',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE id = '$KodePIC'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstKategori($Data){
	global $Koneksi;

	$KodeKategori 		= htmlspecialchars($Data["kode_kategori"]);
	$NamaKategori 		= htmlspecialchars($Data["nama_kategori"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "UPDATE mst_kategori SET
				kode_kategori = '$KodeKategori',
				nama_kategori = '$NamaKategori',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_kategori = '$KodeKategori'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstMerk($Data){
	global $Koneksi;

	$KodeMerk 			= htmlspecialchars($Data["kode_merk"]);
	$NamaMerk 			= htmlspecialchars($Data["nama_merk"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "UPDATE mst_merk SET
				kode_merk = '$KodeMerk',
				nama_merk = '$NamaMerk',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_merk = '$KodeMerk'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstTipe($Data){
	global $Koneksi;

	$KodeTipe 			= htmlspecialchars($Data["kode_tipe"]);
	$NamaTipe 			= htmlspecialchars($Data["nama_tipe"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query = "UPDATE mst_tipe SET
				kode_tipe = '$KodeTipe',
				nama_tipe = '$NamaTipe',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_tipe = '$KodeTipe'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstVendor($Data){
	global $Koneksi;

	$KodeVendor 		= htmlspecialchars($Data["kode_vendor"]);
	$NamaVendor 		= htmlspecialchars($Data["nama_vendor"]);
	$Alamat 			= htmlspecialchars($Data["alamat"]);
	$KodePropinsi 		= htmlspecialchars($Data["kode_propinsi"]);
	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$Website 			= htmlspecialchars($Data["website"]);
	$NomorTelepon 		= htmlspecialchars($Data["no_telepon"]);
	$AlamatEmail 		= htmlspecialchars($Data["alamat_email"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "UPDATE mst_vendor SET
				kode_vendor = '$KodeVendor',
				nama_vendor = '$NamaVendor',
				alamat = '$Alamat',
				kode_propinsi = '$KodePropinsi',
				kode_kabupaten_kota = '$KodeKabupatenKota',
				website = '$Website',
				no_telepon = '$NomorTelepon',
				alamat_email = '$AlamatEmail',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_vendor = '$KodeVendor'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstPengepul($Data){
	global $Koneksi;

	$KodePengepul 		= htmlspecialchars($Data["kode_pengepul"]);
	$NamaPengepul 		= htmlspecialchars($Data["nama_pengepul"]);
	$Alamat 			= htmlspecialchars($Data["alamat"]);
	$KodePropinsi 		= htmlspecialchars($Data["kode_propinsi"]);
	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$NomorTelepon 		= htmlspecialchars($Data["no_telepon"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "UPDATE mst_pengepul SET 
				kode_pengepul = '$KodePengepul',
				nama_pengepul = '$NamaPengepul',
				alamat = '$Alamat',
				kode_propinsi = '$KodePropinsi',
				kode_kabupaten_kota = '$KodeKabupatenKota',
				no_telepon = '$NomorTelepon',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_pengepul = '$KodePengepul'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstPropinsi($Data){
	global $Koneksi;

	$KodePropinsi 		= htmlspecialchars($Data["kode_propinsi"]);
	$NamaPropinsi 		= htmlspecialchars($Data["nama_propinsi"]);
	$TanggalPembaruan	= date('Y-m-d');

	$Query = "UPDATE mst_propinsi SET
				kode_propinsi = '$KodePropinsi',
				nama_propinsi = '$NamaPropinsi',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_propinsi = $KodePropinsi
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstKabupatenKota($Data){
	global $Koneksi;

	$KodeKabupatenKota 	= htmlspecialchars($Data["kode_kabupaten_kota"]);
	$NamaKabupatenKota 	= htmlspecialchars($Data["nama_kabupaten_kota"]);
	$TanggalPembaruan	= date('Y-m-d');

	$Query = "UPDATE mst_kabupaten_kota SET
				kode_kabupaten_kota = '$KodeKabupatenKota',
				nama_kabupaten_kota = '$NamaKabupatenKota',
				tanggal_pembaruan 		= '$TanggalPembaruan'
				WHERE kode_kabupaten_kota = $KodeKabupatenKota
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataMstHardware($Data){
	global $Koneksi;

	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$NamaHardware 		= htmlspecialchars($Data["nama_hardware"]);
	$KodeKategori 		= htmlspecialchars($Data["kode_kategori"]);
	$KodeMerk 			= htmlspecialchars($Data["kode_merk"]);
	$KodeTipe 			= htmlspecialchars($Data["kode_tipe"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "UPDATE mst_hardware SET
				kode_hardware = '$KodeHardware',
				nama_hardware = '$NamaHardware',
				kode_kategori = '$KodeKategori',
				kode_merk = '$KodeMerk',
				kode_tipe = '$KodeTipe',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_hardware = '$KodeHardware'
				";
	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataTrxPengadaanHardware($Data){
	global $Koneksi;

	$KodePengadaan 		= htmlspecialchars($Data["kode_pengadaan_hardware"]);
	$TanggalPengadaan	= $Data["tanggal_pengadaan_hardware"];
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$SerialNumber 		= htmlspecialchars($Data["serial_number"]);
	$Keterangan 		= htmlspecialchars($Data["keterangan"]);
	$KodeVendor 		= htmlspecialchars($Data["kode_vendor"]);
	$HargaHardware 		= htmlspecialchars($Data["harga_hardware"]);
	$Status 	 		= htmlspecialchars($Data["status"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "UPDATE trx_pengadaan_hardware SET
				kode_pengadaan_hardware = '$KodePengadaan',
				tanggal_pengadaan_hardware = '$TanggalPengadaan',
				tanggal_kadaluwarsa_hardware = date_add('$TanggalPengadaan', INTERVAL 1825 DAY),
				kode_cabang = '$KodeCabang',
				kode_divisi = '$KodeDivisi',
				kode_posession = '$KodePosession',
				kode_hardware = '$KodeHardware',
				serial_number = '$SerialNumber',
				keterangan = '$Keterangan',
				kode_vendor = '$KodeVendor',
				harga_hardware = '$HargaHardware',
				status = '$Status',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_pengadaan_hardware = '$KodePengadaan'
				";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataTrxPeremajaanHardware($Data){
	global $Koneksi;

	$KodePeremajaan 	= htmlspecialchars($Data["kode_peremajaan_hardware"]);
	$TanggalPeremajaan 	= $Data["tanggal_peremajaan_hardware"];
	$KodePengadaan 		= htmlspecialchars($Data["kode_pengadaan_hardware"]);
	$SerialNumber 		= htmlspecialchars($Data["serial_number"]);
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$KodeVendor 		= htmlspecialchars($Data["kode_vendor"]);
	$Status 	 		= htmlspecialchars($Data["status"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "UPDATE trx_peremajaan_hardware SET
				kode_peremajaan_hardware = '$KodePeremajaan',
				tanggal_peremajaan_hardware = '$TanggalPeremajaan',
				kode_pengadaan_hardware = '$KodePengadaan',
				serial_number = '$SerialNumber',
				kode_cabang = '$KodeCabang',
				kode_divisi = '$KodeDivisi',
				kode_posession = '$KodePosession',
				kode_hardware = '$KodeHardware',
				kode_vendor = '$KodeVendor',
				status = '$Status',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_peremajaan_hardware = '$KodePeremajaan'
				";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataTrxPerawatanHardware($Data){
	global $Koneksi;

	$KodePerawatan 		= htmlspecialchars($Data["kode_perawatan_hardware"]);
	$TanggalPerawatan 	= $Data["tanggal_perawatan_hardware"];
	$KodePengadaan 		= htmlspecialchars($Data["kode_pengadaan_hardware"]);
	$SerialNumber 		= htmlspecialchars($Data["serial_number"]);
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$Keterangan 		= htmlspecialchars($Data["keterangan"]);
	$BiayaPerawatan		= htmlspecialchars($Data["biaya_perawatan"]);
	$KodePICIT 			= htmlspecialchars($Data["id"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "UPDATE trx_perawatan_hardware SET
				kode_perawatan_hardware = '$KodePerawatan',
				tanggal_perawatan_hardware = '$TanggalPerawatan',
				kode_pengadaan_hardware = '$KodePengadaan',
				serial_number = '$SerialNumber',
				kode_cabang = '$KodeCabang',
				kode_divisi = '$KodeDivisi',
				kode_posession = '$KodePosession',
				kode_hardware = '$KodeHardware',
				keterangan = '$Keterangan',
				biaya_perawatan = '$BiayaPerawatan',
				id = '$KodePICIT',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_perawatan_hardware = '$KodePerawatan'
				";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

function UbahDataTrxPenjualanHardware($Data){
	global $Koneksi;

	$KodePenjualan		= htmlspecialchars($Data["kode_penjualan_hardware"]);
	$TanggalPenjualan	= $Data["tanggal_penjualan_hardware"];
	$KodeCabang 		= htmlspecialchars($Data["kode_cabang"]);
	$KodeDivisi 		= htmlspecialchars($Data["kode_divisi"]);
	$KodePosession 		= htmlspecialchars($Data["kode_posession"]);
	$KodeHardware 		= htmlspecialchars($Data["kode_hardware"]);
	$KodePengepul		= htmlspecialchars($Data["kode_pengepul"]);
	$HargaJualHardware	= htmlspecialchars($Data["harga_jual_hardware"]);
	$TanggalPembaruan 	= date('Y-m-d');

	$Query 	= "UPDATE trx_penjualan_hardware SET
				kode_penjualan_hardware = '$KodePenjualan',
				tanggal_penjualan_hardware = '$TanggalPenjualan',
				kode_cabang = '$KodeCabang',
				kode_divisi = '$KodeDivisi',
				kode_posession = '$KodePosession',
				kode_hardware = '$KodeHardware',
				kode_pengepul = '$KodePengepul',
				harga_jual_hardware = '$HargaJualHardware',
				tanggal_pembaruan = '$TanggalPembaruan'
				WHERE kode_penjualan_hardware = '$KodePenjualan'
				";

	mysqli_query($Koneksi, $Query);

	return mysqli_affected_rows($Koneksi);
}

?>