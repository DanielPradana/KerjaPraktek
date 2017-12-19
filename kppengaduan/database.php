<?php

function connect_database() {
	//konfigurasi database
	define('SERVER', 'localhost');   
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DATABASE', 'pengaduan');
	$koneksi = mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);
	return $koneksi;
}

function add_record($uid, $idcomplaint, $usercomplaint, $numbercomplaint, $complaintdate, $complaintrecord, $complainttitle, $complaintreceived, $complaintmedia, $complainttype, $complaintinformation, $filenameimage, $filenamevideo, $status) {
	$koneksi = connect_database();

	//escape input
	$uid = mysqli_real_escape_string($koneksi, $uid);
	$idcomplaint = mysqli_real_escape_string($koneksi, $idcomplaint);
	$usercomplaint = mysqli_real_escape_string($koneksi, $usercomplaint);
	$numbercomplaint = mysqli_real_escape_string($koneksi, $numbercomplaint);
	$complaintdate = mysqli_real_escape_string($koneksi, $complaintdate);
	$complaintrecord = mysqli_real_escape_string($koneksi, $complaintrecord);
	$complainttitle = mysqli_real_escape_string($koneksi, $complainttitle);
	$complaintreceived = mysqli_real_escape_string($koneksi, $complaintreceived);
	$complaintmedia = mysqli_real_escape_string($koneksi, $complaintmedia);
	$complainttype = mysqli_real_escape_string($koneksi, $complainttype);
	$complaintinformation = mysqli_real_escape_string($koneksi, $complaintinformation);
	$filenameimage = mysqli_real_escape_string($koneksi, $filenameimage);
	$filenamevideo = mysqli_real_escape_string($koneksi, $filenamevideo);
	$status = mysqli_real_escape_string($koneksi, $status);

	$sql = "INSERT INTO complaint (userid, idofcomplaintrecord, usercomplaint, numberofcomplaintrecord, complaintdate, complaintrecord, complainttitle, complaintreceivedby, complaintmedia, complainttype, complaintinformation, photo, video, status) VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "ssssssssssssss", $uid, $idcomplaint, $usercomplaint, $numbercomplaint, $complaintdate, $complaintrecord, $complainttitle, $complaintreceived, $complaintmedia, $complainttype, $complaintinformation, $filenameimage, $filenamevideo, $status);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function edit_record($idcomplaint, $usercomplaint, $numbercomplaint, $complaintdate, $complaintrecord, $complainttitle, $complaintreceived, $complaintmedia, $complainttype, $complaintinformation, $filenameimage, $filenamevideo) {
	$koneksi = connect_database();

	$idcomplaint = mysqli_real_escape_string($koneksi, $idcomplaint);
	$usercomplaint = mysqli_real_escape_string($koneksi, $usercomplaint);
	$numbercomplaint = mysqli_real_escape_string($koneksi, $numbercomplaint);
	$complaintdate = mysqli_real_escape_string($koneksi, $complaintdate);
	$complaintrecord = mysqli_real_escape_string($koneksi, $complaintrecord);
	$complainttitle = mysqli_real_escape_string($koneksi, $complainttitle);
	$complaintreceived = mysqli_real_escape_string($koneksi, $complaintreceived);
	$complaintmedia = mysqli_real_escape_string($koneksi, $complaintmedia);
	$complainttype = mysqli_real_escape_string($koneksi, $complainttype);
	$complaintinformation = mysqli_real_escape_string($koneksi, $complaintinformation);
	$filenameimage = mysqli_real_escape_string($koneksi, $filenameimage);
	$filenamevideo = mysqli_real_escape_string($koneksi, $filenamevideo);

	$sql = "UPDATE complaint SET usercomplaint = ?, numberofcomplaintrecord = ?, complaintdate = ?, complaintrecord = ?, complainttitle = ?, complaintreceivedby = ?, complaintmedia = ?, complainttype = ?, complaintinformation = ?, photo = ?, video = ? WHERE idofcomplaintrecord = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "ssssssssssss", $usercomplaint, $numbercomplaint, $complaintdate, $complaintrecord, $complainttitle, $complaintreceived, $complaintmedia, $complainttype, $complaintinformation, $filenameimage, $filenamevideo, $idcomplaint);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function update_datauser($uid, $username, $divisi, $jabatan) {
	$koneksi = connect_database();

	$username = mysqli_real_escape_string($koneksi, $username);
	$divisi = mysqli_real_escape_string($koneksi, $divisi);
	$jabatan = mysqli_real_escape_string($koneksi, $jabatan);

	$sql = "UPDATE user SET username = ?, divisi = ?, jabatan = ? WHERE iduser = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "ssss", $username, $divisi, $jabatan, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function update_imageprofile($uid, $filenameimage) {
	$koneksi = connect_database();

	$filenameimage = mysqli_real_escape_string($koneksi, $filenameimage);

	$sql = "UPDATE user SET image = ? WHERE iduser = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $filenameimage, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function change_password($uid, $password) {
	$koneksi = connect_database();

	$password = mysqli_real_escape_string($koneksi, $password);

	$sql = "UPDATE user SET password = ? WHERE iduser = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "ss", $password, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function updatecount($idofcomplaintrecord, $count) {
	$koneksi = connect_database();

	$count = mysqli_real_escape_string($koneksi, $count);

	$sql = "UPDATE complaint SET opencount = ? WHERE idofcomplaintrecord = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "is", $count, $idofcomplaintrecord);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function tindakan_penanganan($uid, $idofcomplaintrecord, $tujuan, $keterangan, $tanggal) {
	$koneksi = connect_database();

	$uid = mysqli_real_escape_string($koneksi, $uid);
	$idofcomplaintrecord = mysqli_real_escape_string($koneksi, $idofcomplaintrecord);
	$tujuan = mysqli_real_escape_string($koneksi, $tujuan);
	$keterangan = mysqli_real_escape_string($koneksi, $keterangan);
	$tanggal = mysqli_real_escape_string($koneksi, $tanggal);

	$sql = "INSERT INTO tindakanpenanganan (userid, idofcomplaintrecord, tujuan, keterangan, tanggal) VALUES (?, ? ,?, ?, ?)";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "sssss", $uid, $idofcomplaintrecord, $tujuan, $keterangan, $tanggal);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close();
}

function delete_penanganan($idpenanganan) {
	$koneksi = connect_database();
	$sql = "DELETE FROM tindakanpenanganan WHERE idpenanganan = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "i", $idpenanganan);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function delete_complaint($idofcomplaintrecord) {
	$koneksi = connect_database();
	$sql = "DELETE FROM complaint WHERE idofcomplaintrecord = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "s", $idofcomplaintrecord);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function delete_pengananan_complaint($idofcomplaintrecord) {
	$koneksi = connect_database();

	$sql = "DELETE FROM tindakanpenanganan WHERE idofcomplaintrecord = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "s", $idofcomplaintrecord);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function tambah_onprogress($complaintonprogress, $tahun, $bulan, $uid) {
	$koneksi = connect_database();

	$uid = mysqli_real_escape_string($koneksi, $uid);
	$complaintonprogress = mysqli_real_escape_string($koneksi, $complaintonprogress);
	$tahun = mysqli_real_escape_string($koneksi, $tahun);
	$bulan = mysqli_real_escape_string($koneksi, $bulan);

	$sql = "INSERT INTO report (complaintonprogress, tahun, bulan, userid) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "isss", $complaintonprogress, $tahun, $bulan, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function tambah_complaintdelete($complaintdelete, $tahun, $bulan, $uid) {
	$koneksi = connect_database();

	$uid = mysqli_real_escape_string($koneksi, $uid);
	$complaintdelete = mysqli_real_escape_string($koneksi, $complaintdelete);
	$tahun = mysqli_real_escape_string($koneksi, $tahun);
	$bulan = mysqli_real_escape_string($koneksi, $bulan);

	$sql = "INSERT INTO report (complaintdelete, tahun, bulan, userid) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "isss", $complaintdelete, $tahun, $bulan, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function tambah_complaintfinished($complaintfinished, $tahun, $bulan, $uid) {
	$koneksi = connect_database();

	$uid = mysqli_real_escape_string($koneksi, $uid);
	$complaintfinished = mysqli_real_escape_string($koneksi, $complaintfinished);
	$tahun = mysqli_real_escape_string($koneksi, $tahun);
	$bulan = mysqli_real_escape_string($koneksi, $bulan);

	$sql = "INSERT INTO report (complaintfinished, tahun, bulan, userid) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "isss", $complaintfinished, $tahun, $bulan, $uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function update_onprogress($complaintonprogress, $uid, $bulan, $tahun) {
	$koneksi = connect_database();

	$complaintonprogress = mysqli_real_escape_string($koneksi, $complaintonprogress);

	$sql = "UPDATE report SET complaintonprogress = ? WHERE userid = ? AND bulan = ? AND tahun = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "isss", $complaintonprogress, $uid, $bulan, $tahun);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function update_complaintdelete($complaintdelete, $uid, $bulan, $tahun) {
	$koneksi = connect_database();

	$complaintdelete = mysqli_real_escape_string($koneksi, $complaintdelete);

	$sql = "UPDATE report SET complaintdelete = ? WHERE userid = ? AND bulan = ? AND tahun = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "isss", $complaintdelete, $uid, $bulan, $tahun);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function update_finished($complaintfinished, $uid, $bulan, $tahun) {
	$koneksi = connect_database();

	$complaintfinished = mysqli_real_escape_string($koneksi, $complaintfinished);

	$sql = "UPDATE report SET complaintfinished = ? WHERE userid = ? AND bulan = ? AND tahun = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "isss", $complaintfinished, $uid, $bulan, $tahun);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function update_complaintstatus($idofcomplaintrecord, $status, $nowdate, $totalhari) {
	$koneksi = connect_database();

	$status = mysqli_real_escape_string($koneksi, $status);
	$nowdate = mysqli_real_escape_string($koneksi, $nowdate);
	$$totalhari = mysqli_real_escape_string($koneksi, $totalhari);

	$sql = "UPDATE complaint SET status = ?, datefinished = ?, totalhari = ? WHERE idofcomplaintrecord = ?";
	$stmt = mysqli_prepare($koneksi, $sql);
	mysqli_stmt_bind_param($stmt, "ssis", $status, $nowdate, $totalhari, $idofcomplaintrecord);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($koneksi);
}

function cek_oldPassword($uid, $oldpassword) {
	$koneksi = connect_database();

	$sql = "SELECT * FROM user WHERE iduser = '$uid' and password = '$oldpassword'";
    $result = mysqli_query($koneksi,$sql);
    $count = mysqli_num_rows($result);
	if($count == 1) {
		mysqli_close($koneksi);
		return true;
	}
	else{
		mysqli_close($koneksi);
		return false;
	}
}

?>